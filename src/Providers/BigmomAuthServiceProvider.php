<?php

namespace Bigmom\Auth\Providers;

use App\Models\BigmomUserPermission;
use Bigmom\Auth\Facades\Permission;
use Bigmom\Auth\Services\PermissionService;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Auth\User;

class BigmomAuthServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        config([
            'auth.guards.bigmom' => array_merge([
                'driver' => config('bigmom-auth.guard.driver', 'session'),
                'provider' => config('bigmom-auth.guard.provider', 'users'),
            ], config('auth.guards.bigmom', [])),
        ]);

        $this->app->singleton('bigmom-permission', function ($app) {
            return new PermissionService;
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/bigmom-auth.php' => config_path('bigmom-auth.php'),
            ]);

            $this->publishes([
                __DIR__.'/../public' => public_path('vendor/bigmom-auth'),
            ], 'public');

            $this->publishes([
                __DIR__.'/../resources/views/auth' => resource_path('views/vendor/bigmom/auth'),
            ]);
        }

        $this->loadRoutesFrom(__DIR__.'/../routes.php');

        $this->loadMigrationsFrom(__DIR__.'/../migrations');

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'bigmom-auth');
    }
}