<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class TrainerAvailability extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'trainer_id',
        'day_of_week',
        'start_time',
        'end_time',
        'is_available',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'is_available' => 'boolean',
    ];

    /**
     * Get the trainer that this availability belongs to.
     */
    public function trainer()
    {
        return $this->belongsTo(User::class, 'trainer_id');
    }

    /**
     * Get the day name based on the day_of_week integer.
     *
     * @return string
     */
    public function getDayNameAttribute()
    {
        $days = [
            0 => 'Sunday',
            1 => 'Monday',
            2 => 'Tuesday',
            3 => 'Wednesday',
            4 => 'Thursday',
            5 => 'Friday',
            6 => 'Saturday',
        ];

        return $days[$this->day_of_week] ?? 'Unknown';
    }

    /**
     * Check if this availability slot overlaps with another slot.
     *
     * @param TrainerAvailability $availability
     * @return bool
     */
    public function overlaps(TrainerAvailability $availability)
    {
        // Only check for overlap if same day and trainer
        if ($this->day_of_week !== $availability->day_of_week || 
            $this->trainer_id !== $availability->trainer_id) {
            return false;
        }

        // Parse times for comparison
        $thisStart = Carbon::parse($this->start_time)->format('H:i');
        $thisEnd = Carbon::parse($this->end_time)->format('H:i');
        $otherStart = Carbon::parse($availability->start_time)->format('H:i');
        $otherEnd = Carbon::parse($availability->end_time)->format('H:i');

        // Check for any overlap
        return ($thisStart < $otherEnd && $thisEnd > $otherStart);
    }

    /**
     * Scope a query to only include availabilities for a specific trainer.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param int $trainerId
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeForTrainer($query, $trainerId)
    {
        return $query->where('trainer_id', $trainerId);
    }

    /**
     * Scope a query to only include available slots.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAvailable($query)
    {
        return $query->where('is_available', true);
    }
}