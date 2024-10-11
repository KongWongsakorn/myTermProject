<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Pagination\Paginator;

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
        Blade::if('adminRole', function () {
            return Auth::user()->roles()->where('role_id', 11)->exists();
        });
        Blade::if('teacherRole', function () {
            return Auth::user()->roles()->where('role_id', 9)->exists();
        });
        Blade::if('leaderRole', function () {
            return Auth::user()->roles()->where('role_id', 10)->exists();
        });
        Blade::if('deputyRole', function () {
            return Auth::user()->roles()->where('role_id', 8)->exists();
        });
        Blade::if('directorRole', function () {
            return Auth::user()->roles()->where('role_id', 7)->exists();
        });
        Paginator::useBootstrap();
    }
}
