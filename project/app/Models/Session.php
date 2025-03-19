<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'type',
        'level',
        'max_capacity',
        'date',
        'start_time',
        'end_time',
        'trainer_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date' => 'date',
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    /**
     * Get the trainer that leads the session.
     */
    public function trainer()
    {
        return $this->belongsTo(User::class, 'trainer_id');
    }

    /**
     * Get the attendances for the session.
     */
    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    /**
     * Get the members that attend this session.
     */
    public function members()
    {
        return $this->belongsToMany(User::class, 'attendances', 'session_id', 'user_id');
    }
}