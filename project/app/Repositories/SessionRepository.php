<?php

namespace App\Repositories;

use App\Models\Session;
use App\Repositories\Interfaces\SessionRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class SessionRepository implements SessionRepositoryInterface
{
    /**
     * @var Session
     */
    protected $model;

    /**
     * SessionRepository constructor.
     *
     * @param Session $model
     */
    public function __construct(Session $model)
    {
        $this->model = $model;
    }

    /**
     * Get all sessions with pagination
     *
     * @param array $filters
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getAllWithPagination(array $filters = [])
    {
        $query = $this->model->where('trainer_id', $filters['trainer_id'] ?? auth()->id());
        
        // Filter by date if provided
        if (isset($filters['date'])) {
            $query->where('date', $filters['date']);
        }
        
        // Filter by session type if provided
        if (isset($filters['type']) && $filters['type'] !== 'all') {
            $query->where('type', $filters['type']);
        }
        
        // Filter by city if provided
        if (isset($filters['city']) && $filters['city'] !== 'all') {
            $query->where('city', $filters['city']);
        }
        
        // Default sorting by date and time
        $query->orderBy('date', 'desc')->orderBy('start_time');
        
        return $query->withCount('attendances as registered_members')
            ->paginate(10);
    }
    
    /**
     * Get session by ID
     *
     * @param int $id
     * @return \App\Models\Session|null
     */
    public function findById(int $id)
    {
        return $this->model->findOrFail($id);
    }
    
    /**
     * Create a new session
     *
     * @param array $data
     * @return \App\Models\Session
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }
    
    /**
     * Update an existing session
     *
     * @param int $id
     * @param array $data
     * @return \App\Models\Session
     */
    public function update(int $id, array $data)
    {
        $session = $this->findById($id);
        $session->update($data);
        return $session;
    }
    
    /**
     * Delete a session
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id)
    {
        return $this->findById($id)->delete();
    }
    
    /**
     * Get distinct session types
     *
     * @param int $trainerId
     * @return \Illuminate\Support\Collection
     */
    public function getSessionTypes(int $trainerId)
    {
        return $this->model->where('trainer_id', $trainerId)
            ->select('type')
            ->distinct()
            ->pluck('type');
    }
    
    /**
     * Get distinct cities
     *
     * @param int $trainerId
     * @return \Illuminate\Support\Collection
     */
    public function getCities(int $trainerId)
    {
        return $this->model->where('trainer_id', $trainerId)
            ->select('city')
            ->distinct()
            ->whereNotNull('city')
            ->pluck('city');
    }
    
    /**
     * Get sessions for the current week
     *
     * @param int $trainerId
     * @return \Illuminate\Support\Collection
     */
    public function getSessionsForCurrentWeek(int $trainerId)
    {
        $startOfWeek = now()->startOfWeek();
        $endOfWeek = now()->endOfWeek();
        
        return $this->model->where('trainer_id', $trainerId)
            ->whereBetween('date', [$startOfWeek, $endOfWeek])
            ->get()
            ->groupBy(function($session) {
                return Carbon::parse($session->date)->format('Y-m-d');
            });
    }
    
    /**
     * Check if a session has attendances
     *
     * @param int $id
     * @return bool
     */
    public function hasAttendances(int $id)
    {
        $session = $this->findById($id);
        return $session->attendances()->count() > 0;
    }
    
    /**
     * Check if a session is in the past
     *
     * @param int $id
     * @return bool
     */
    public function isPast(int $id)
    {
        $session = $this->findById($id);
        return Carbon::parse($session->date)->isPast();
    }
    
    /**
     * Get the number of attendances for a session
     *
     * @param int $id
     * @return int
     */
    public function getAttendancesCount(int $id)
    {
        return $this->findById($id)->attendances()->count();
    }
    
    /**
     * Check if a session belongs to a trainer
     *
     * @param int $sessionId
     * @param int $trainerId
     * @return bool
     */
    public function belongsToTrainer(int $sessionId, int $trainerId)
    {
        $session = $this->findById($sessionId);
        return $session->trainer_id === $trainerId;
    }
}