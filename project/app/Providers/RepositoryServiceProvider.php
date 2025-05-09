<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Interfaces\SessionRepositoryInterface;
use App\Repositories\SessionRepository;
use App\Repositories\Interfaces\AttendanceRepositoryInterface;
use App\Repositories\AttendanceRepository;
use App\Repositories\Interfaces\TrainerAvailabilityRepositoryInterface;
use App\Repositories\TrainerAvailabilityRepository;
use App\Repositories\Interfaces\TrainerRepositoryInterface;
use App\Repositories\TrainerRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            SessionRepositoryInterface::class,
            SessionRepository::class
        );

        $this->app->bind(
            AttendanceRepositoryInterface::class,
            AttendanceRepository::class
        );

        $this->app->bind(
            TrainerAvailabilityRepositoryInterface::class,
            TrainerAvailabilityRepository::class
        );
        
        $this->app->bind(
            TrainerRepositoryInterface::class,
            TrainerRepository::class
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