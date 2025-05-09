<?php

namespace App\Repositories;

use App\Models\Session;
use App\Models\User;
use App\Models\Attendance;
use App\Repositories\Interfaces\TrainerRepositoryInterface;
use Carbon\Carbon;

class TrainerRepository implements TrainerRepositoryInterface
{
    /**
     * Get upcoming sessions for a trainer
     *
     * @param int $trainerId
     * @param int $limit
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getUpcomingSessions(int $trainerId, int $limit = 5)
    {
        $today = Carbon::today();
        
        return Session::where('trainer_id', $trainerId)
            ->where('date', '>=', $today)
            ->orderBy('date')
            ->orderBy('start_time')
            ->limit($limit)
            ->get();
    }
    
    /**
     * Get count of today's sessions for a trainer
     *
     * @param int $trainerId
     * @return int
     */
    public function getTodaySessionsCount(int $trainerId)
    {
        $today = Carbon::today();
        
        return Session::where('trainer_id', $trainerId)
            ->where('date', $today)
            ->count();
    }
    
    /**
     * Get total sessions count for a trainer
     *
     * @param int $trainerId
     * @return int
     */
    public function getTotalSessionsCount(int $trainerId)
    {
        return Session::where('trainer_id', $trainerId)->count();
    }
    
    /**
     * Get trainer's specialties (session types)
     *
     * @param int $trainerId
     * @return array
     */
    public function getSpecialties(int $trainerId)
    {
        return Session::where('trainer_id', $trainerId)
            ->select('type')
            ->distinct()
            ->pluck('type')
            ->toArray();
    }
    
    /**
     * Get members for a trainer with pagination
     *
     * @param int $trainerId
     * @param int $perPage
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getMembers(int $trainerId, int $perPage = 15)
    {
        return User::whereHas('attendances', function ($query) use ($trainerId) {
            $query->whereHas('session', function ($q) use ($trainerId) {
                $q->where('trainer_id', $trainerId);
            });
        })
        ->withCount(['attendances as session_count' => function ($query) use ($trainerId) {
            $query->whereHas('session', function ($q) use ($trainerId) {
                $q->where('trainer_id', $trainerId);
            });
        }])
        ->orderBy('session_count', 'desc')
        ->paginate($perPage);
    }
    
    /**
     * Get member attendances for a trainer
     *
     * @param int $trainerId
     * @param int $memberId
     * @param int $perPage
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getMemberAttendances(int $trainerId, int $memberId, int $perPage = 10)
    {
        return Attendance::whereHas('session', function ($query) use ($trainerId) {
            $query->where('trainer_id', $trainerId);
        })
        ->where('user_id', $memberId)
        ->with('session')
        ->orderBy('created_at', 'desc')
        ->paginate($perPage);
    }
    
    /**
     * Get trainer's experience level
     *
     * @param int $sessionCount
     * @return array
     */
    public function getExperienceLevel(int $sessionCount)
    {
        if ($sessionCount >= 100) {
            return [
                'level' => 'Expert',
                'badge' => 'gold',
                'progress' => 100,
            ];
        } elseif ($sessionCount >= 50) {
            $progress = (($sessionCount - 50) / 50) * 100;
            return [
                'level' => 'Advanced',
                'badge' => 'silver',
                'progress' => $progress,
            ];
        } elseif ($sessionCount >= 20) {
            $progress = (($sessionCount - 20) / 30) * 100;
            return [
                'level' => 'Intermediate',
                'badge' => 'bronze',
                'progress' => $progress,
            ];
        } else {
            $progress = ($sessionCount / 20) * 100;
            return [
                'level' => 'Beginner',
                'badge' => 'basic',
                'progress' => $progress,
            ];
        }
    }
}