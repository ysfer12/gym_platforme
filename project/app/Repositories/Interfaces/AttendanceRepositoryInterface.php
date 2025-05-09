<?php

namespace App\Repositories\Interfaces;

interface AttendanceRepositoryInterface
{
    /**
     * Find an attendance record by session ID and user ID
     *
     * @param int $sessionId
     * @param int $userId
     * @return \App\Models\Attendance|null
     */
    public function findBySessionAndUser(int $sessionId, int $userId);
    
    /**
     * Find an attendance record by ID
     *
     * @param int $id
     * @return \App\Models\Attendance|null
     */
    public function findById(int $id);
    
    /**
     * Get all attendances for a session
     *
     * @param int $sessionId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getSessionAttendances(int $sessionId);
    
    /**
     * Record entry time for an attendance
     *
     * @param \App\Models\Attendance $attendance
     * @param string $checkInMethod
     * @return \App\Models\Attendance
     */
    public function recordEntry($attendance, string $checkInMethod = 'trainer');
    
    /**
     * Record exit time for an attendance
     *
     * @param \App\Models\Attendance $attendance
     * @return \App\Models\Attendance
     */
    public function recordExit($attendance);

    /**
     * Check if an attendance has entry time
     *
     * @param \App\Models\Attendance $attendance
     * @return bool
     */
    public function hasEntryTime($attendance);

    /**
     * Get attendances count for a session
     *
     * @param int $sessionId
     * @return int
     */
    public function getAttendancesCount(int $sessionId);
    
    /**
     * Get unique members in trainer's sessions
     *
     * @param int $trainerId
     * @return int
     */
    public function getUniqueMembers(int $trainerId);
    
    /**
     * Get recent attendances for a trainer
     * 
     * @param int $trainerId
     * @param int $limit
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getRecentAttendances(int $trainerId, int $limit = 10);
    
    /**
     * Calculate attendance rate for a trainer's sessions
     * 
     * @param int $trainerId
     * @return float
     */
    public function getAttendanceRate(int $trainerId);
}