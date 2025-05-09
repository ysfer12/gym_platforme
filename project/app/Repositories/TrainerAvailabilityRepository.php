<?php

namespace App\Repositories;

use App\Models\TrainerAvailability;
use App\Models\Session;
use App\Repositories\Interfaces\TrainerAvailabilityRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class TrainerAvailabilityRepository implements TrainerAvailabilityRepositoryInterface
{
    /**
     * @var TrainerAvailability
     */
    protected $model;

    /**
     * TrainerAvailabilityRepository constructor.
     *
     * @param TrainerAvailability $model
     */
    public function __construct(TrainerAvailability $model)
    {
        $this->model = $model;
    }

    /**
     * Get all availabilities for a trainer
     *
     * @param int $trainerId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllForTrainer(int $trainerId)
    {
        return $this->model->where('trainer_id', $trainerId)
            ->orderBy('day_of_week')
            ->orderBy('start_time')
            ->get();
    }
    
    /**
     * Find an availability by ID
     *
     * @param int $id
     * @return \App\Models\TrainerAvailability|null
     */
    public function findById(int $id)
    {
        return $this->model->findOrFail($id);
    }
    
    /**
     * Create a new availability
     *
     * @param array $data
     * @return \App\Models\TrainerAvailability
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }
    
    /**
     * Update an existing availability
     *
     * @param int $id
     * @param array $data
     * @return \App\Models\TrainerAvailability
     */
    public function update(int $id, array $data)
    {
        $availability = $this->findById($id);
        $availability->update($data);
        return $availability;
    }
    
    /**
     * Delete an availability
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id)
    {
        return $this->findById($id)->delete();
    }
    
    /**
     * Check if an availability time slot overlaps with existing ones
     *
     * @param int $trainerId
     * @param int $dayOfWeek
     * @param string $startTime
     * @param string $endTime
     * @param int|null $excludeId
     * @return bool
     */
    public function hasOverlappingSlots(int $trainerId, int $dayOfWeek, string $startTime, string $endTime, ?int $excludeId = null)
    {
        // Convert time strings to Carbon objects for comparison
        $startTimeObj = Carbon::parse($startTime);
        $endTimeObj = Carbon::parse($endTime);
        
        // Get existing availabilities for the trainer on the given day
        $query = $this->model->where('trainer_id', $trainerId)
            ->where('day_of_week', $dayOfWeek);
            
        // Exclude the current availability if updating
        if ($excludeId) {
            $query->where('id', '!=', $excludeId);
        }
        
        $existingAvailabilities = $query->get();
        
        // Check for overlaps
        foreach ($existingAvailabilities as $existing) {
            $existingStart = Carbon::parse($existing->start_time);
            $existingEnd = Carbon::parse($existing->end_time);
            
            if ($startTimeObj < $existingEnd && $endTimeObj > $existingStart) {
                return true; // There is an overlap
            }
        }
        
        return false; // No overlaps found
    }
    
    /**
     * Check if there are any sessions scheduled during this time slot
     * 
     * @param int $trainerId
     * @param int $dayOfWeek
     * @param string $startTime
     * @param string $endTime
     * @return bool
     */
    public function hasSessionsDuringSlot(int $trainerId, int $dayOfWeek, string $startTime, string $endTime)
    {
        // Convert time strings to Carbon objects for comparison
        $startTimeObj = Carbon::parse($startTime);
        $endTimeObj = Carbon::parse($endTime);
        
        // Get sessions for this trainer on this day of week
        $sessions = Session::where('trainer_id', $trainerId)
            ->where(DB::raw('DAYOFWEEK(date)'), '=', $dayOfWeek + 1) // MySQL's DAYOFWEEK starts from 1 (Sunday)
            ->where('date', '>=', now()->format('Y-m-d')) // Only check future sessions
            ->get();
        
        foreach ($sessions as $session) {
            $sessionStart = Carbon::parse($session->start_time);
            $sessionEnd = Carbon::parse($session->end_time);
            
            if ($startTimeObj <= $sessionEnd && $endTimeObj >= $sessionStart) {
                return true; // There is a session during this slot
            }
        }
        
        return false; // No sessions during this slot
    }
    
    /**
     * Check if an availability belongs to a trainer
     * 
     * @param int $availabilityId
     * @param int $trainerId
     * @return bool
     */
    public function belongsToTrainer(int $availabilityId, int $trainerId)
    {
        $availability = $this->findById($availabilityId);
        return $availability->trainer_id === $trainerId;
    }
}