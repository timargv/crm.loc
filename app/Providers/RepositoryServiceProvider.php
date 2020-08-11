<?php

namespace App\Providers;

use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\Interfaces\VacationRepositoryInterface;
use App\Repositories\User\UserRepository;
use App\Repositories\User\VacationRepository;
use Illuminate\Support\ServiceProvider;

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
            UserRepositoryInterface::class,
            UserRepository::class
        );

        $this->app->bind(
            VacationRepositoryInterface::class,
            VacationRepository::class
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
