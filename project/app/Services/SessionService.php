<?php

namespace App\Services;

use App\Repositories\Interfaces\SessionRepositoryInterface;
use App\Repositories\Interfaces\AttendanceRepositoryInterface;
use App\Repositories\Interfaces\TrainerAvailabilityRepositoryInterface;
use App\Services\Interfaces\SessionServiceInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SessionService implements SessionServiceInterface
{
    /**
     * @var SessionRepositoryInterface
     */
    protected $sessionRepository;
    
    /**
     * @var AttendanceRepositoryInterface
     */
    protected $attendanceRepository;
    
    /**
     * @var TrainerAvailabilityRepositoryInterface
     */
    protected $availabilityRepository;
    
    /**
     * SessionService constructor.
     *
     * @param SessionRepositoryInterface $sessionRepository
     * @param AttendanceRepositoryInterface $attendanceRepository
     * @param TrainerAvailabilityRepositoryInterface $availabilityRepository
     */
    public function __construct(
        SessionRepositoryInterface $sessionRepository,
        AttendanceRepositoryInterface $attendanceRepository,
        TrainerAvailabilityRepositoryInterface $availabilityRepository
    ) {
        $this->sessionRepository = $sessionRepository;
        $this->attendanceRepository = $attendanceRepository;
        $this->availabilityRepository = $availabilityRepository;
    }
    
    /**
     * Get filtered sessions with pagination and related data
     *
     * @param int $trainerId
     * @param array $filters
     * @return array
     */
    public function getFilteredSessions(int $trainerId, array $filters): array
    {
        // Prepare filters
        $filters['trainer_id'] = $trainerId;
        
        // Get paginated sessions with filters
        $sessions = $this->sessionRepository->getAllWithPagination($filters);
        
        // Get session types for filter dropdown
        $sessionTypes = $this->sessionRepository->getSessionTypes($trainerId);
        
        // Get cities for filter dropdown
        $cities = $this->sessionRepository->getCities($trainerId);
        
        // Get trainer's availabilities for the calendar
        $availabilities = $this->availabilityRepository->getAllForTrainer($trainerId);
        
        // Get sessions for the current week for the calendar
        $thisWeekSessions = $this->sessionRepository->getSessionsForCurrentWeek($trainerId);
        
        return [
            'sessions' => $sessions,
            'sessionTypes' => $sessionTypes,
            'cities' => $cities,
            'availabilities' => $availabilities,
            'thisWeekSessions' => $thisWeekSessions
        ];
    }
    
    /**
     * Create a new session
     *
     * @param array $data
     * @param int $trainerId
     * @return \App\Models\Session
     */
    public function createSession(array $data, int $trainerId)
    {
        try {
            // Start a transaction
            DB::beginTransaction();
            
            // Add trainer_id to the data
            $data['trainer_id'] = $trainerId;
            
            // Create the session
            $session = $this->sessionRepository->create($data);
            
            // Commit the transaction
            DB::commit();
            
            return $session;
        } catch (\Exception $e) {
            // Rollback the transaction
            DB::rollBack();
            
            // Log the error
            Log::error('Failed to create session: ' . $e->getMessage());
            
            throw $e;
        }
    }
    
    /**
     * Get session details with attendance information
     *
     * @param int $sessionId
     * @param int $trainerId
     * @return array
     */
    public function getSessionDetails(int $sessionId, int $trainerId): array
    {
        // Validate trainer access
        if (!$this->sessionRepository->belongsToTrainer($sessionId, $trainerId)) {
            throw new \Exception('You are not authorized to view this session');
        }
        
        // Get the session
        $session = $this->sessionRepository->findById($sessionId);
        
        // Get attendance count
        $attendanceCount = $this->attendanceRepository->getAttendancesCount($sessionId);
        
        // Get members who have registered for this session
        $members = $session->attendances()->with('user')->get();
        
        // Calculate available spots
        $availableSpots = $session->max_capacity - $attendanceCount;
        
        return [
            'session' => $session,
            'attendanceCount' => $attendanceCount,
            'members' => $members,
            'availableSpots' => $availableSpots
        ];
    }
    
    /**
     * Update an existing session
     *
     * @param int $sessionId
     * @param array $data
     * @param int $trainerId
     * @return \App\Models\Session
     */
    public function updateSession(int $sessionId, array $data, int $trainerId)
    {
        try {
            // Validate trainer access
            if (!$this->sessionRepository->belongsToTrainer($sessionId, $trainerId)) {
                throw new \Exception('You are not authorized to update this session');
            }
            
            // Check if session is in the past
            if ($this->sessionRepository->isPast($sessionId)) {
                throw new \Exception('Past sessions cannot be modified');
            }
            
            // Start a transaction
            DB::beginTransaction();
            
            // Update the session
            $session = $this->sessionRepository->update($sessionId, $data);
            
            // Commit the transaction
            DB::commit();
            
            return $session;
        } catch (\Exception $e) {
            // Rollback the transaction
            DB::rollBack();
            
            // Log the error
            Log::error('Failed to update session: ' . $e->getMessage());
            
            throw $e;
        }
    }
    
    /**
     * Delete a session
     *
     * @param int $sessionId
     * @param int $trainerId
     * @return bool
     */
    public function deleteSession(int $sessionId, int $trainerId): bool
    {
        try {
            // Validate trainer access
            if (!$this->sessionRepository->belongsToTrainer($sessionId, $trainerId)) {
                throw new \Exception('You are not authorized to delete this session');
            }
            
            // Check if session is in the past
            if ($this->sessionRepository->isPast($sessionId)) {
                throw new \Exception('Past sessions cannot be deleted');
            }
            
            // Check if session has attendances
            if ($this->sessionRepository->hasAttendances($sessionId)) {
                throw new \Exception('Cannot delete a session that has registered members');
            }
            
            // Start a transaction
            DB::beginTransaction();
            
            // Delete the session
            $result = $this->sessionRepository->delete($sessionId);
            
            // Commit the transaction
            DB::commit();
            
            return $result;
        } catch (\Exception $e) {
            // Rollback the transaction
            DB::rollBack();
            
            // Log the error
            Log::error('Failed to delete session: ' . $e->getMessage());
            
            throw $e;
        }
    }
}