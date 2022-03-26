<?php

namespace App\Providers;

use App\Services\GeocodingInterface;
use App\Services\MapboxGeocodingService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(GeocodingInterface::class, function ($app) {
            return new MapboxGeocodingService();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

    }
}
