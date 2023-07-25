<?php

namespace App\Providers;

use App\Support\Stats\StatsDatabaseService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //load helpers folder
        foreach (glob(app_path() . '/Helpers/*.php') as $file) {
            require_once($file);
        }

        $this->app->bind('stats', fn() => new StatsDatabaseService());
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
