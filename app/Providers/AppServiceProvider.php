<?php

namespace App\Providers;

use App\Services\PlayerService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Bind PlayerService to a closure that resolves it from the container
        $this->app->bind(PlayerService::class, function ($app) {
            return new PlayerService(/* constructor arguments if any */);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
