<?php

namespace App\Services;

use App\Repositories\Interfaces\TrainerAvailabilityRepositoryInterface;
use App\Repositories\Interfaces\SessionRepositoryInterface;
use App\Services\Interfaces\ScheduleServiceInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ScheduleService implements ScheduleServiceInterface
{
    /**
     * @var TrainerAvailabilityRepositoryInterface
     */
    protected $availabilityRepository;
    
    /**
     * @var SessionRepositoryInterface
     */
    protected $sessionRepository;
    
    /**
     * ScheduleService constructor.
     *
     * @param TrainerAvailabilityRepositoryInterface $availabilityRepository
     * @param SessionRepositoryInterface $sessionRepository
     */
    public function __construct(
        TrainerAvailabilityRepositoryInterface $availabilityRepository,
        SessionRepositoryInterface $sessionRepository
    ) {
        $this->availabilityRepository = $availabilityRepository;
        $this->sessionRepository = $sessionRepository;
    }
    
    /**
     * Get all availabilities for a trainer
     *
     * @param int $trainerId
     * @return array
     */
    public function getTrainerAvailabilities(int $trainerId): array
    {
        try {
            $availabilities = $this->availabilityRepository->getAllForTrainer($trainerId);
            
            return [
                'success' => true,
                'availabilities' => $availabilities
            ];
        } catch (\Exception $e) {
            // Log the error
            Log::error('Failed to get trainer availabilities: ' . $e->getMessage());
            
            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
    }
    
    /**
     * Create a new availability slot
     *
     * @param array $data
     * @param int $trainerId
     * @return \App\Models\TrainerAvailability
     */
    public function createAvailability(array $data, int $trainerId)
    {
        try {
            // Start a transaction
            DB::beginTransaction();
            
            // Check if the new availability overlaps with any existing ones
            if ($this->availabilityRepository->hasOverlappingSlots(
                $trainerId,
                $data['day_of_week'],
                $data['start_time'],
                $data['end_time']
            )) {
                throw new \Exception('This time slot overlaps with an existing availability slot.');
            }
            
            // Add trainer_id to the data
            $data['trainer_id'] = $trainerId;
            
            // Create the new availability slot
            $availability = $this->availabilityRepository->create($data);
            
            // Commit the transaction
            DB::commit();
            
            return $availability;
        } catch (\Exception $e) {
            // Rollback the transaction
            DB::rollBack();
            
            // Log the error
            Log::error('Failed to create availability: ' . $e->getMessage());
            
            throw $e;
        }
    }
    
    /**
     * Update an existing availability slot
     *
     * @param int $availabilityId
     * @param array $data
     * @param int $trainerId
     * @return \App\Models\TrainerAvailability
     */
    public function updateAvailability(int $availabilityId, array $data, int $trainerId)
    {
        try {
            // Verify this availability belongs to the trainer
            if (!$this->availabilityRepository->belongsToTrainer($availabilityId, $trainerId)) {
                throw new \Exception('You are not authorized to update this availability');
            }
            
            // Start a transaction
            DB::beginTransaction();
            
            // Check if the updated availability overlaps with any existing ones
            if ($this->availabilityRepository->hasOverlappingSlots(
                $trainerId,
                $data['day_of_week'],
                $data['start_time'],
                $data['end_time'],
                $availabilityId
            )) {
                throw new \Exception('This time slot overlaps with an existing availability slot.');
            }
            
            // Check if there are any sessions scheduled during this time slot
            // Only if marking as unavailable
            if (isset($data['is_available']) && !$data['is_available']) {
                if ($this->availabilityRepository->hasSessionsDuringSlot(
                    $trainerId,
                    $data['day_of_week'],
                    $data['start_time'],
                    $data['end_time']
                )) {
                    throw new \Exception('You have sessions scheduled during this time slot. Please reschedule them before marking yourself as unavailable.');
                }
            }
            
            // Update the availability
            $availability = $this->availabilityRepository->update($availabilityId, $data);
            
            // Commit the transaction
            DB::commit();
            
            return $availability;
        } catch (\Exception $e) {
            // Rollback the transaction
            DB::rollBack();
            
            // Log the error
            Log::error('Failed to update availability: ' . $e->getMessage());
            
            throw $e;
        }
    }
    
    /**
     * Delete an availability slot
     *
     * @param int $availabilityId
     * @param int $trainerId
     * @return bool
     */
    public function deleteAvailability(int $availabilityId, int $trainerId): bool
    {
        try {
            // Verify this availability belongs to the trainer
            if (!$this->availabilityRepository->belongsToTrainer($availabilityId, $trainerId)) {
                throw new \Exception('You are not authorized to delete this availability');
            }
            
            // Get the availability to check its time slot
            $availability = $this->availabilityRepository->findById($availabilityId);
            
            // Check if there are any sessions scheduled during this time slot
            if ($this->availabilityRepository->hasSessionsDuringSlot(
                $trainerId,
                $availability->day_of_week,
                $availability->start_time,
                $availability->end_time
            )) {
                throw new \Exception('You have sessions scheduled during this time slot. Please reschedule them before deleting this availability.');
            }
            
            // Start a transaction
            DB::beginTransaction();
            
            // Delete the availability
            $result = $this->availabilityRepository->delete($availabilityId);
            
            // Commit the transaction
            DB::commit();
            
            return $result;
        } catch (\Exception $e) {
            // Rollback the transaction
            DB::rollBack();
            
            // Log the error
            Log::error('Failed to delete availability: ' . $e->getMessage());
            
            throw $e;
        }
    }
    
    /**
     * Get calendar data for a trainer
     *
     * @param int $trainerId
     * @return array
     */
    public function getCalendarData(int $trainerId): array
    {
        try {
            // Get all availabilities
            $availabilities = $this->availabilityRepository->getAllForTrainer($trainerId);
            
            // Get upcoming sessions for the next 4 weeks
            $startDate = now()->startOfWeek();
            $endDate = now()->addWeeks(4)->endOfWeek();
            
            $sessions = \App\Models\Session::where('trainer_id', $trainerId)
                ->whereBetween('date', [$startDate, $endDate])
                ->with('attendances')
                ->orderBy('date')
                ->orderBy('start_time')
                ->get();
            
            // Group sessions by date for easier rendering
            $sessionsByDate = [];
            foreach ($sessions as $session) {
                $date = $session->date->format('Y-m-d');
                if (!isset($sessionsByDate[$date])) {
                    $sessionsByDate[$date] = [];
                }
                $sessionsByDate[$date][] = $session;
            }
            
            // Generate calendar weeks
            $weeks = [];
            $currentDate = $startDate->copy();
            
            while ($currentDate <= $endDate) {
                $week = [];
                for ($i = 0; $i < 7; $i++) {
                    $week[] = [
                        'date' => $currentDate->copy(),
                        'sessions' => $sessionsByDate[$currentDate->format('Y-m-d')] ?? [],
                        'isAvailable' => $this->isDayAvailable($availabilities, $currentDate->dayOfWeek),
                    ];
                    $currentDate->addDay();
                }
                $weeks[] = $week;
            }
            
            return [
                'success' => true,
                'weeks' => $weeks,
                'availabilities' => $availabilities
            ];
        } catch (\Exception $e) {
            // Log the error
            Log::error('Failed to get calendar data: ' . $e->getMessage());
            
            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
    }
    
    /**
     * Check if a specific day has any availability slots.
     *
     * @param  \Illuminate\Database\Eloquent\Collection  $availabilities
     * @param  int  $dayOfWeek
     * @return bool
     */
    private function isDayAvailable($availabilities, $dayOfWeek)
    {
        foreach ($availabilities as $availability) {
            if ($availability->day_of_week == $dayOfWeek && $availability->is_available) {
                return true;
            }
        }
        return false;
    }
}