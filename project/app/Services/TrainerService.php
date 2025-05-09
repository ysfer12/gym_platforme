<?php

namespace App\Services;

use App\Repositories\Interfaces\TrainerRepositoryInterface;
use App\Repositories\Interfaces\AttendanceRepositoryInterface;
use App\Services\Interfaces\TrainerServiceInterface;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class TrainerService implements TrainerServiceInterface
{
    /**
     * @var TrainerRepositoryInterface
     */
    protected $trainerRepository;
    
    /**
     * @var AttendanceRepositoryInterface
     */
    protected $attendanceRepository;
    
    /**
     * TrainerService constructor.
     *
     * @param TrainerRepositoryInterface $trainerRepository
     * @param AttendanceRepositoryInterface $attendanceRepository
     */
    public function __construct(
        TrainerRepositoryInterface $trainerRepository,
        AttendanceRepositoryInterface $attendanceRepository
    ) {
        $this->trainerRepository = $trainerRepository;
        $this->attendanceRepository = $attendanceRepository;
    }
    
    /**
     * Get dashboard data for a trainer
     *
     * @param int $trainerId
     * @return array
     */
    public function getDashboardData(int $trainerId): array
    {
        try {
            // Get today's date
            
            // Get trainer's upcoming sessions
            $upcomingSessions = $this->trainerRepository->getUpcomingSessions($trainerId, 5);
                
            // Get count of sessions for today
            $todaySessions = $this->trainerRepository->getTodaySessionsCount($trainerId);
                
            // Get count of total sessions led by the trainer
            $totalSessions = $this->trainerRepository->getTotalSessionsCount($trainerId);
                
            // Get total number of unique members in trainer's sessions
            $totalUniqueMembers = $this->attendanceRepository->getUniqueMembers($trainerId);
                
            // Get attendance rate for trainer's sessions
            $attendanceRate = $this->attendanceRepository->getAttendanceRate($trainerId);
            
            // Get recent attendances for the trainer's sessions
            $recentAttendances = $this->attendanceRepository->getRecentAttendances($trainerId, 10);

            // Get trainer's experience level based on sessions count
            $experienceLevel = $this->trainerRepository->getExperienceLevel($totalSessions);
            
            return [
                'success' => true,
                'upcomingSessions' => $upcomingSessions,
                'todaySessions' => $todaySessions,
                'totalSessions' => $totalSessions,
                'totalUniqueMembers' => $totalUniqueMembers,
                'attendanceRate' => $attendanceRate,
                'recentAttendances' => $recentAttendances,
                'experienceLevel' => $experienceLevel
            ];
        } catch (\Exception $e) {
            // Log the error
            Log::error('Failed to get dashboard data: ' . $e->getMessage());
            
            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
    }
    
    /**
     * Get profile data for a trainer
     *
     * @param int $trainerId
     * @return array
     */
    public function getProfileData(int $trainerId): array
    {
        try {
            // Get total sessions led by the trainer
            $totalSessions = $this->trainerRepository->getTotalSessionsCount($trainerId);
            
            // Get total unique members in trainer's sessions
            $totalUniqueMembers = $this->attendanceRepository->getUniqueMembers($trainerId);
            
            // Get trainer's experience level based on sessions count
            $experienceLevel = $this->trainerRepository->getExperienceLevel($totalSessions);
            
            // Get trainer's specialties (session types)
            $specialties = $this->trainerRepository->getSpecialties($trainerId);
            
            return [
                'success' => true,
                'totalSessions' => $totalSessions,
                'totalUniqueMembers' => $totalUniqueMembers,
                'experienceLevel' => $experienceLevel,
                'specialties' => $specialties
            ];
        } catch (\Exception $e) {
            // Log the error
            Log::error('Failed to get profile data: ' . $e->getMessage());
            
            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
    }
    
    /**
     * Get badge data for a trainer
     *
     * @param int $trainerId
     * @return array
     */
    public function getBadgeData(int $trainerId): array
    {
        try {
            // Get total sessions led by the trainer
            $totalSessions = $this->trainerRepository->getTotalSessionsCount($trainerId);
            
            // Get trainer's experience level based on sessions count
            $experienceLevel = $this->trainerRepository->getExperienceLevel($totalSessions);
            
            // Get trainer's specialties (session types)
            $specialties = $this->trainerRepository->getSpecialties($trainerId);
            
            return [
                'success' => true,
                'totalSessions' => $totalSessions,
                'experienceLevel' => $experienceLevel,
                'specialties' => $specialties
            ];
        } catch (\Exception $e) {
            // Log the error
            Log::error('Failed to get badge data: ' . $e->getMessage());
            
            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
    }
    
    /**
     * Get members for a trainer with pagination
     *
     * @param int $trainerId
     * @return array
     */
    public function getMembers(int $trainerId): array
    {
        try {
            // Get members
            $members = $this->trainerRepository->getMembers($trainerId);
            
            return [
                'success' => true,
                'members' => $members
            ];
        } catch (\Exception $e) {
            // Log the error
            Log::error('Failed to get members: ' . $e->getMessage());
            
            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
    }
    
    /**
     * Get member details with attendance history
     *
     * @param int $trainerId
     * @param int $memberId
     * @return array
     */
    public function getMemberDetails(int $trainerId, int $memberId): array
    {
        try {
            // Get the member
            $member = User::findOrFail($memberId);
            
            // Get the member's attendance in the trainer's sessions
            $attendances = $this->trainerRepository->getMemberAttendances($trainerId, $memberId);
            
            return [
                'success' => true,
                'member' => $member,
                'attendances' => $attendances
            ];
        } catch (\Exception $e) {
            // Log the error
            Log::error('Failed to get member details: ' . $e->getMessage());
            
            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
    }
}