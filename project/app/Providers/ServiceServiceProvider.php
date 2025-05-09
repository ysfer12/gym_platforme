<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Interfaces\SessionServiceInterface;
use App\Services\SessionService;
use App\Services\Interfaces\AttendanceServiceInterface;
use App\Services\AttendanceService;
use App\Services\Interfaces\TrainerServiceInterface;
use App\Services\TrainerService;
use App\Services\Interfaces\ScheduleServiceInterface;
use App\Services\ScheduleService;

class ServiceServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            SessionServiceInterface::class,
            SessionService::class
        );

        $this->app->bind(
            AttendanceServiceInterface::class,
            AttendanceService::class
        );

        $this->app->bind(
            TrainerServiceInterface::class,
            TrainerService::class
        );
        
        $this->app->bind(
            ScheduleServiceInterface::class,
            ScheduleService::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}