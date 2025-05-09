<?php

namespace App\Services\Interfaces;

interface AttendanceServiceInterface
{
    /**
     * Record entry for a member in a session
     *
     * @param int $sessionId
     * @param int $userId
     * @param int $trainerId
     * @return array
     */
    public function recordEntry(int $sessionId, int $userId, int $trainerId): array;
    
    /**
     * Record exit for a member in a session
     *
     * @param int $attendanceId
     * @param int $trainerId
     * @return array
     */
    public function recordExit(int $attendanceId, int $trainerId): array;
    
    /**
     * Get attendances for a session
     *
     * @param int $sessionId
     * @param int $trainerId
     * @return array
     */
    public function getSessionAttendances(int $sessionId, int $trainerId): array;
}