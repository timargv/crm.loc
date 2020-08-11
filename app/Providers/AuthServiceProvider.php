<?php

namespace App\Providers;

use App\Entity\User;
use App\Entity\UserCapability\Vacation;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        $this->registerPermissions();

        //
    }

    private function registerPermissions() : void
    {
        // Доступ только Администратору
        \Gate::define('admin', function (User $user) {
            return $user->isAdmin();
        });

        \Gate::define('director', function (User $user) {
            return $user->isAdmin() || $user->isDirector();
        });

        // Доступ только Администратору
        \Gate::define('own_vacation', function (User $user, Vacation $vacation) {
            return $user->isAdmin() || $user->isDirector() || $user->id = $vacation->user_id;
        });

        // Доступ только Администратору
        \Gate::define('own_profile', function ($authorizing, User $user) {
            return $user->isAdmin() || $authorizing->id = $user->id;
        });

    }
}
