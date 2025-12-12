<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Vite;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Only override public path on production
        if ($this->app->environment('production')) {
            $this->app->bind('path.public', function () {
                return base_path('../public_html'); 
            });
        }
    }

    public function boot(): void
    {

    }
}