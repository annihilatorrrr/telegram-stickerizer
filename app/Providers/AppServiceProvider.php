<?php

namespace App\Providers;

use App\Support\Stats\StatsDatabaseService;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

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
        JsonResource::withoutWrapping();

        Str::macro('toResource', function (string $text) {
            $stream = fopen('php://temp', 'rb+');
            fwrite($stream, $text);
            rewind($stream);
            return $stream;
        });
    }
}
