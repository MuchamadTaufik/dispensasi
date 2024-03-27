<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('guru-piket', function(User $user) {
            return $user->role_id === 2;
        });

        Gate::define('admin', function(User $user) {
            return $user->role_id === 1;
        });

        Gate::define('guru-piket-or-admin', function($user) {
            return in_array($user->role_id, [1, 2]);
        });
    }
}
