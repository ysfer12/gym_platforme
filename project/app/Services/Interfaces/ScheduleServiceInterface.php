<?php

namespace App\Services\Interfaces;

interface ScheduleServiceInterface
{
    /**
     * Get all availabilities for a trainer
     *
     * @param int $trainerId
     * @return array
     */
    public function getTrainerAvailabilities(int $trainerId): array;
    
    /**
     * Create a new availability slot
     *
     * @param array $data
     * @param int $trainerId
     * @return \App\Models\TrainerAvailability
     */
    public function createAvailability(array $data, int $trainerId);
    
    /**
     * Update an existing availability slot
     *
     * @param int $availabilityId
     * @param array $data
     * @param int $trainerId
     * @return \App\Models\TrainerAvailability
     */
    public function updateAvailability(int $availabilityId, array $data, int $trainerId);
    
    /**
     * Delete an availability slot
     *
     * @param int $availabilityId
     * @param int $trainerId
     * @return bool
     */
    public function deleteAvailability(int $availabilityId, int $trainerId): bool;
    
    /**
     * Get calendar data for a trainer
     *
     * @param int $trainerId
     * @return array
     */
    public function getCalendarData(int $trainerId): array;
}