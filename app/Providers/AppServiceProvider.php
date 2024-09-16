<?php

namespace App\Providers;

use App\Interfaces\OrderServiceInterface;
use App\Interfaces\OrderRepositoryInterface;
use App\Repositories\OrderRepository;
use App\Services\OrderService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(OrderServiceInterface::class, OrderService::class);
        $this->app->singleton(OrderRepositoryInterface::class, OrderRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
