<?php

namespace App\Providers;

use App\Entity\User;
use App\Observers\UserObserver;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Schema::defaultStringLength(191);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        setlocale(LC_TIME, 'Russian');
        Carbon::setLocale(config('app.locale'));

        User::observe(UserObserver::class);
    }
}
