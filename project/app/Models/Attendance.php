<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'session_id',
        'date',
        'entry_time',
        'exit_time',
        'check_in_method',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date' => 'date',
        'entry_time' => 'datetime',
        'exit_time' => 'datetime',
    ];

    /**
     * Get the user that has the attendance.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the session for this attendance.
     */
    public function session()
    {
        return $this->belongsTo(Session::class);
    }
}