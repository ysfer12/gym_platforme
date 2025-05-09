<?php

namespace App\Services\Interfaces;

interface TrainerServiceInterface
{
    /**
     * Get dashboard data for a trainer
     *
     * @param int $trainerId
     * @return array
     */
    public function getDashboardData(int $trainerId): array;
    
    /**
     * Get profile data for a trainer
     *
     * @param int $trainerId
     * @return array
     */
    public function getProfileData(int $trainerId): array;
    
    /**
     * Get badge data for a trainer
     *
     * @param int $trainerId
     * @return array
     */
    public function getBadgeData(int $trainerId): array;
    
    /**
     * Get members for a trainer with pagination
     *
     * @param int $trainerId
     * @return array
     */
    public function getMembers(int $trainerId): array;
    
    /**
     * Get member details with attendance history
     *
     * @param int $trainerId
     * @param int $memberId
     * @return array
     */
    public function getMemberDetails(int $trainerId, int $memberId): array;
}