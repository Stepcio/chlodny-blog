<?php

namespace App\Providers;

use Carbon\Carbon;
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
        // Keeps Carbon's month/day names (translatedFormat()) in sync with
        // APP_LOCALE, since Laravel doesn't do this automatically.
        Carbon::setLocale(config('app.locale'));
    }
}
