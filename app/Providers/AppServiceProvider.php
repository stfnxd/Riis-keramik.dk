<?php

namespace App\Providers;

use Illuminate\Foundation\Vite;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if (app()->environment('production')) {
            $app->bind('path.public', function() {
                return base_path('public_html');
            });
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $vite = $this->app->make(Vite::class);

        if (app()->environment('production')) {
            $vite->useBuildDirectory('build'); // relative to public_path(), which is now public_html
        }
    }
}
