<?php

namespace Riclep\KineticApi;

use Illuminate\Support\ServiceProvider;

class KineticApiServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/kinetic.php' => config_path('kinetic.php'),
        ], 'config');
    }

    /**
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/kinetic.php', 'kinetic');

        $this->app->singleton('kinetic', function ($app) {
            return new Kinetic();
        });
    }
}
