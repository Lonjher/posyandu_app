<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Auth\Access\Response;
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
        Gate::define('isAdmin', function (User $user) {
            return $user->role === 'admin' ? Response::allow() : Response::denyAsNotFound();
        });
        Gate::define('isUser', function (User $user) {
            return $user->role === 'user' ? Response::allow() : Response::denyAsNotFound();
        });
        Gate::define('isKader', function (User $user) {
            return $user->role === 'kader' ? Response::allow() : Response::denyAsNotFound();
        });
        Gate::define('isPemdes', function (User $user) {
            return $user->role === 'pemdes' ? Response::allow() : Response::denyAsNotFound();
        });
        Gate::define('isAdminBidanKader', function (User $user) {
            return $user->role === 'admin' || $user->role === 'bidan' || $user->role === 'kader' ? Response::allow() : Response::denyAsNotFound();
        });

        \Carbon\Carbon::setLocale('id');
    }
}
