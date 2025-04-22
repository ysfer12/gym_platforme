<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Notifications\VerifyEmail;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'password',
        'address',
        'role',
        'status',
        'registrationDate',
        'deletionDate',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'registrationDate' => 'datetime',
        'deletionDate' => 'datetime',
    ];

    /**
     * Check if user is an administrator
     *
     * @return bool
     */
    public function isAdmin()
    {
        return $this->role === 'Administrator';
    }

    /**
     * Check if user is a member
     *
     * @return bool
     */
    public function isMember()
    {
        return $this->role === 'Member';
    }

    /**
     * Check if user is a trainer
     *
     * @return bool
     */
    public function isTrainer()
    {
        return $this->role === 'Trainer';
    }

    /**
     * Check if user is a receptionist
     *
     * @return bool
     */
    public function isReceptionist()
    {
        return $this->role === 'Receptionist';
    }

    /**
     * Get the subscriptions for the user
     */
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    /**
     * Get the sessions the user participates in
     */
    public function sessions()
    {
        return $this->belongsToMany(Session::class, 'attendances');
    }

    /**
     * Get the sessions the trainer leads
     */
    public function trainedSessions()
    {
        return $this->hasMany(Session::class, 'trainer_id');
    }

    /**
     * Get the attendances for the user
     */
    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
    
    /**
     * Get the availabilities for the trainer
     */
    public function availabilities()
    {
        return $this->hasMany(TrainerAvailability::class, 'trainer_id');
    }
    
    /**
     * Send the email verification notification.
     *
     * @return void
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmail);
    }
}