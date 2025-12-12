<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Vite;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Override the public path on production
        if ($this->app->environment('production')) {
            $this->app->bind('path.public', function () {
                return base_path('public_html');
            });
        }
    }

    public function boot(): void
    {
        $vite = $this->app->make(Vite::class);

        // Use the build directory as usual (relative to public_path)
        $vite->useBuildDirectory('build');
    }
}