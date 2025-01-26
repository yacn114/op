<?php

namespace App\Providers;


use App\Models\Permission;
use App\Models\User;
use http\Env\Request;
use Illuminate\Support\Facades\Auth;
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
    Gate::define('update-post', function ($user) {
       $status = Auth::user() ?  $user->role->HasPermission('update-post') : null;
       return $status;
    });
}
}
