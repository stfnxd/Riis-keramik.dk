<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Dynamically set the public path depending on environment
        $this->app->bind('path.public', function() {
            // Detect if we're on the server by checking an environment variable
            return env('APP_PUBLIC_PATH', base_path('public'));
        });
    }

    public function boot(): void
    {
        //
    }
}