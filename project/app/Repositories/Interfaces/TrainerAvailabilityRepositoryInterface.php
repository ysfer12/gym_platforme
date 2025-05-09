<?php

namespace App\Repositories\Interfaces;

interface TrainerAvailabilityRepositoryInterface
{
    /**
     * Get all availabilities for a trainer
     *
     * @param int $trainerId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllForTrainer(int $trainerId);
    
    /**
     * Find an availability by ID
     *
     * @param int $id
     * @return \App\Models\TrainerAvailability|null
     */
    public function findById(int $id);
    
    /**
     * Create a new availability
     *
     * @param array $data
     * @return \App\Models\TrainerAvailability
     */
    public function create(array $data);
    
    /**
     * Update an existing availability
     *
     * @param int $id
     * @param array $data
     * @return \App\Models\TrainerAvailability
     */
    public function update(int $id, array $data);
    
    /**
     * Delete an availability
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id);
    
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
    public function hasOverlappingSlots(int $trainerId, int $dayOfWeek, string $startTime, string $endTime, ?int $excludeId = null);
    
    /**
     * Check if there are any sessions scheduled during this time slot
     * 
     * @param int $trainerId
     * @param int $dayOfWeek
     * @param string $startTime
     * @param string $endTime
     * @return bool
     */
    public function hasSessionsDuringSlot(int $trainerId, int $dayOfWeek, string $startTime, string $endTime);
    
    /**
     * Check if an availability belongs to a trainer
     * 
     * @param int $availabilityId
     * @param int $trainerId
     * @return bool
     */
    public function belongsToTrainer(int $availabilityId, int $trainerId);
}