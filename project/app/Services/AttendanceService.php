<?php

namespace App\Services;

use App\Repositories\Interfaces\AttendanceRepositoryInterface;
use App\Repositories\Interfaces\SessionRepositoryInterface;
use App\Services\Interfaces\AttendanceServiceInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AttendanceService implements AttendanceServiceInterface
{
    /**
     * @var AttendanceRepositoryInterface
     */
    protected $attendanceRepository;
    
    /**
     * @var SessionRepositoryInterface
     */
    protected $sessionRepository;
    
    /**
     * AttendanceService constructor.
     *
     * @param AttendanceRepositoryInterface $attendanceRepository
     * @param SessionRepositoryInterface $sessionRepository
     */
    public function __construct(
        AttendanceRepositoryInterface $attendanceRepository,
        SessionRepositoryInterface $sessionRepository
    ) {
        $this->attendanceRepository = $attendanceRepository;
        $this->sessionRepository = $sessionRepository;
    }
    
    /**
     * Record entry for a member in a session
     *
     * @param int $sessionId
     * @param int $userId
     * @param int $trainerId
     * @return array
     */
    public function recordEntry(int $sessionId, int $userId, int $trainerId): array
    {
        try {
            // Verify this session belongs to the trainer
            if (!$this->sessionRepository->belongsToTrainer($sessionId, $trainerId)) {
                throw new \Exception('You are not authorized to manage attendance for this session');
            }
            
            // Check if attendance record exists
            $attendance = $this->attendanceRepository->findBySessionAndUser($sessionId, $userId);
                
            if (!$attendance) {
                throw new \Exception('Member is not registered for this session');
            }
            
            // Start a transaction
            DB::beginTransaction();
            
            // Record entry time
            $updatedAttendance = $this->attendanceRepository->recordEntry($attendance);
            
            // Commit the transaction
            DB::commit();
            
            return [
                'success' => true,
                'message' => 'Entry recorded successfully',
                'attendance' => $updatedAttendance
            ];
        } catch (\Exception $e) {
            // Rollback the transaction
            DB::rollBack();
            
            // Log the error
            Log::error('Failed to record entry: ' . $e->getMessage());
            
            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
    }
    
    /**
     * Record exit for a member in a session
     *
     * @param int $attendanceId
     * @param int $trainerId
     * @return array
     */
    public function recordExit(int $attendanceId, int $trainerId): array
    {
        try {
            // Find the attendance
            $attendance = $this->attendanceRepository->findById($attendanceId);
            
            // Verify this session belongs to the trainer
            if (!$this->sessionRepository->belongsToTrainer($attendance->session_id, $trainerId)) {
                throw new \Exception('You are not authorized to manage attendance for this session');
            }
            
            // Check if entry time exists
            if (!$this->attendanceRepository->hasEntryTime($attendance)) {
                throw new \Exception('Cannot record exit without entry');
            }
            
            // Start a transaction
            DB::beginTransaction();
            
            // Record exit time
            $updatedAttendance = $this->attendanceRepository->recordExit($attendance);
            
            // Commit the transaction
            DB::commit();
            
            return [
                'success' => true,
                'message' => 'Exit recorded successfully',
                'attendance' => $updatedAttendance
            ];
        } catch (\Exception $e) {
            // Rollback the transaction
            DB::rollBack();
            
            // Log the error
            Log::error('Failed to record exit: ' . $e->getMessage());
            
            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
    }
    
    /**
     * Get attendances for a session
     *
     * @param int $sessionId
     * @param int $trainerId
     * @return array
     */
    public function getSessionAttendances(int $sessionId, int $trainerId): array
    {
        try {
            // Verify this session belongs to the trainer
            if (!$this->sessionRepository->belongsToTrainer($sessionId, $trainerId)) {
                throw new \Exception('You are not authorized to view this session');
            }
            
            // Get the session
            $session = $this->sessionRepository->findById($sessionId);
            
            // Get all attendances for this session
            $attendances = $this->attendanceRepository->getSessionAttendances($sessionId);
            
            return [
                'success' => true,
                'session' => $session,
                'attendances' => $attendances
            ];
        } catch (\Exception $e) {
            // Log the error
            Log::error('Failed to get session attendances: ' . $e->getMessage());
            
            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
    }
}