<?php

namespace Lizhineng\Sharable;

use Illuminate\Support\ServiceProvider;

class SharableServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        $this->publishes([
            __DIR__.'/../database/migrations' => database_path('migrations'),
        ], 'sharable-migrations');

        $this->publishes([
            __DIR__.'/../config/sharable.php' => config_path('sharable.php'),
        ], 'sharable-config');
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/sharable.php', 'sharable'
        );
    }
}
