<?php

namespace App\Providers;

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
    // Register your custom module views path as a fallback location
    if (file_exists(app_path('Modules/AllenJobPosting/views'))) {
        $this->app['view']->addLocation(app_path('Modules/AllenJobPosting/views'));
    }
}
}
