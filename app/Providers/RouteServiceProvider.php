<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The namespace applied to controller routes.
     */
    protected $namespace = 'App\\Http\\Controllers';

    /**
     * Register routes for the application.
     */
    public function boot(): void
    {
        parent::boot();

        Route::middleware('api')
            ->prefix('api/v1')
            ->namespace($this->namespace)
            ->group(base_path('routes/v1.php'));
    }

    /**
     * Disable default Laravel route mapping.
     */
    public function map(): void
    {

    }
}
