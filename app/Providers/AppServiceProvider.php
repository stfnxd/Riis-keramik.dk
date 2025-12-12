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
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $vite = $this->app->make(Vite::class);

        if (app()->environment('production')) {
            $vite->useBuildDirectory(base_path('public_html/build')); // actual build folder
            $vite->usePublicPath(base_path('public_html'));          // overrides the default "public"
        }
    }
}
