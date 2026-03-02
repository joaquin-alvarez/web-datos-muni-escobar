<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

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
        // Force HTTPS in production (required for Filament assets on Railway)
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }

        // Set Spanish as default locale
        app()->setLocale('es');
        \Carbon\Carbon::setLocale('es');

        // Share institution data with all views
        view()->composer('*', function ($view) {
            $institution = \App\Models\Institution::where('is_active', true)->first();
            $view->with('institution', $institution);
        });
    }
}
