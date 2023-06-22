<?php

namespace App\Providers;

use App\Http\Services\TestInterface;
use App\Http\Services\TestService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class TestServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(TestInterface::class, TestService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Log::info(TestServiceProvider::class);
    }
}
