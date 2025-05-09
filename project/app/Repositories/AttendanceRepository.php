<?php

namespace App\Repositories;

use App\Models\Attendance;
use App\Repositories\Interfaces\AttendanceRepositoryInterface;
use Carbon\Carbon;

class AttendanceRepository implements AttendanceRepositoryInterface
{
    /**
     * @var Attendance
     */
    protected $model;

    /**
     * AttendanceRepository constructor.
     *
     * @param Attendance $model
     */
    public function __construct(Attendance $model)
    {
        $this->model = $model;
    }

    /**
     * Find an attendance record by session ID and user ID
     *
     * @param int $sessionId
     * @param int $userId
     * @return \App\Models\Attendance|null
     */
    public function findBySessionAndUser(int $sessionId, int $userId)
    {
        return $this->model->where('session_id', $sessionId)
            ->where('user_id', $userId)
            ->first();
    }
    
    /**
     * Find an attendance record by ID
     *
     * @param int $id
     * @return \App\Models\Attendance|null
     */
    public function findById(int $id)
    {
        return $this->model->findOrFail($id);
    }
    
    /**
     * Get all attendances for a session
     *
     * @param int $sessionId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getSessionAttendances(int $sessionId)
    {
        return $this->model->with('user')
            ->where('session_id', $sessionId)
            ->get();
    }
    
    /**
     * Record entry time for an attendance
     *
     * @param \App\Models\Attendance $attendance
     * @param string $checkInMethod
     * @return \App\Models\Attendance
     */
    public function recordEntry($attendance, string $checkInMethod = 'trainer')
    {
        $attendance->entry_time = Carbon::now();
        $attendance->check_in_method = $checkInMethod;
        $attendance->save();
        
        return $attendance;
    }
    
    /**
     * Record exit time for an attendance
     *
     * @param \App\Models\Attendance $attendance
     * @return \App\Models\Attendance
     */
    public function recordExit($attendance)
    {
        $attendance->exit_time = Carbon::now();
        $attendance->save();
        
        return $attendance;
    }

    /**
     * Check if an attendance has entry time
     *
     * @param \App\Models\Attendance $attendance
     * @return bool
     */
    public function hasEntryTime($attendance)
    {
        return $attendance->entry_time !== null;
    }

    /**
     * Get attendances count for a session
     *
     * @param int $sessionId
     * @return int
     */
    public function getAttendancesCount(int $sessionId)
    {
        return $this->model->where('session_id', $sessionId)->count();
    }
    
    /**
     * Get unique members in trainer's sessions
     *
     * @param int $trainerId
     * @return int
     */
    public function getUniqueMembers(int $trainerId)
    {
        return $this->model->whereHas('session', function ($query) use ($trainerId) {
            $query->where('trainer_id', $trainerId);
        })
        ->distinct('user_id')
        ->count('user_id');
    }
    
    /**
     * Get recent attendances for a trainer
     * 
     * @param int $trainerId
     * @param int $limit
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getRecentAttendances(int $trainerId, int $limit = 10)
    {
        return $this->model->whereHas('session', function ($query) use ($trainerId) {
            $query->where('trainer_id', $trainerId);
        })
        ->with(['user', 'session'])
        ->orderBy('created_at', 'desc')
        ->limit($limit)
        ->get();
    }
    
    /**
     * Calculate attendance rate for a trainer's sessions
     * 
     * @param int $trainerId
     * @return float
     */
    public function getAttendanceRate(int $trainerId)
    {
        $today = Carbon::today();
        
        $completedSessionIds = \App\Models\Session::where('trainer_id', $trainerId)
            ->where('date', '<', $today)
            ->pluck('id');
            
        $bookedSlots = $this->model->whereIn('session_id', $completedSessionIds)->count();
        $maxCapacity = \App\Models\Session::whereIn('id', $completedSessionIds)->sum('max_capacity');
        
        return $maxCapacity > 0 
            ? round(($bookedSlots / $maxCapacity) * 100, 2) 
            : 0;
    }
}