<?php

namespace App\Repositories\Interfaces;

interface TrainerRepositoryInterface
{
    /**
     * Get upcoming sessions for a trainer
     *
     * @param int $trainerId
     * @param int $limit
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getUpcomingSessions(int $trainerId, int $limit = 5);
    
    /**
     * Get count of today's sessions for a trainer
     *
     * @param int $trainerId
     * @return int
     */
    public function getTodaySessionsCount(int $trainerId);
    
    /**
     * Get total sessions count for a trainer
     *
     * @param int $trainerId
     * @return int
     */
    public function getTotalSessionsCount(int $trainerId);
    
    /**
     * Get trainer's specialties (session types)
     *
     * @param int $trainerId
     * @return array
     */
    public function getSpecialties(int $trainerId);
    
    /**
     * Get members for a trainer with pagination
     *
     * @param int $trainerId
     * @param int $perPage
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getMembers(int $trainerId, int $perPage = 15);
    
    /**
     * Get member attendances for a trainer
     *
     * @param int $trainerId
     * @param int $memberId
     * @param int $perPage
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getMemberAttendances(int $trainerId, int $memberId, int $perPage = 10);
    
    /**
     * Get trainer's experience level
     *
     * @param int $sessionCount
     * @return array
     */
    public function getExperienceLevel(int $sessionCount);
}