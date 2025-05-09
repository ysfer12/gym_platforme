<?php

namespace App\Services\Interfaces;

interface SessionServiceInterface
{
    /**
     * Get filtered sessions with pagination and related data
     *
     * @param int $trainerId
     * @param array $filters
     * @return array
     */
    public function getFilteredSessions(int $trainerId, array $filters): array;
    
    /**
     * Create a new session
     *
     * @param array $data
     * @param int $trainerId
     * @return \App\Models\Session
     */
    public function createSession(array $data, int $trainerId);
    
    /**
     * Get session details with attendance information
     *
     * @param int $sessionId
     * @param int $trainerId
     * @return array
     */
    public function getSessionDetails(int $sessionId, int $trainerId): array;
    
    /**
     * Update an existing session
     *
     * @param int $sessionId
     * @param array $data
     * @param int $trainerId
     * @return \App\Models\Session
     */
    public function updateSession(int $sessionId, array $data, int $trainerId);
    
    /**
     * Delete a session
     *
     * @param int $sessionId
     * @param int $trainerId
     * @return bool
     */
    public function deleteSession(int $sessionId, int $trainerId): bool;
}