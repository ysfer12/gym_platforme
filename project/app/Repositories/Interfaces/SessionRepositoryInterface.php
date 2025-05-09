<?php

namespace App\Repositories\Interfaces;

interface SessionRepositoryInterface
{
    /**
     * Get all sessions with pagination
     *
     * @param array $filters
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getAllWithPagination(array $filters = []);
    
    /**
     * Get session by ID
     *
     * @param int $id
     * @return \App\Models\Session|null
     */
    public function findById(int $id);
    
    /**
     * Create a new session
     *
     * @param array $data
     * @return \App\Models\Session
     */
    public function create(array $data);
    
    /**
     * Update an existing session
     *
     * @param int $id
     * @param array $data
     * @return \App\Models\Session
     */
    public function update(int $id, array $data);
    
    /**
     * Delete a session
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id);
    
    /**
     * Get distinct session types
     *
     * @param int $trainerId
     * @return \Illuminate\Support\Collection
     */
    public function getSessionTypes(int $trainerId);
    
    /**
     * Get distinct cities
     *
     * @param int $trainerId
     * @return \Illuminate\Support\Collection
     */
    public function getCities(int $trainerId);
    
    /**
     * Get sessions for the current week
     *
     * @param int $trainerId
     * @return \Illuminate\Support\Collection
     */
    public function getSessionsForCurrentWeek(int $trainerId);
    
    /**
     * Check if a session has attendances
     *
     * @param int $id
     * @return bool
     */
    public function hasAttendances(int $id);
    
    /**
     * Check if a session is in the past
     *
     * @param int $id
     * @return bool
     */
    public function isPast(int $id);
    
    /**
     * Get the number of attendances for a session
     *
     * @param int $id
     * @return int
     */
    public function getAttendancesCount(int $id);
    
    /**
     * Check if a session belongs to a trainer
     *
     * @param int $sessionId
     * @param int $trainerId
     * @return bool
     */
    public function belongsToTrainer(int $sessionId, int $trainerId);
}