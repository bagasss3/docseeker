<?php

namespace App\Providers;

use App\Models\Orders;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use App\Observers\OrdersObserver;
use Laravel\Sanctum\Sanctum;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Sanctum::ignoreMigrations();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (config('APP_ENV.env') === 'production') {
            URL::forceScheme('https');
        }
    }
}
