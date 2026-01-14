<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Services\AuthServices\AuthManager;
use App\Services\AuthServices\AuthService;
use App\Services\MainServiceManager;
use App\Services\MainService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(AuthManager::class, AuthService::class);
        $this->app->bind(MainServiceManager::class, MainService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);
    }
}
