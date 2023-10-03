<?php

namespace App\Providers;

use App\Support\HashData\HashDataService;
use App\Support\Stats\StatsDatabaseService;
use Illuminate\Foundation\Console\AboutCommand;
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
        $this->app->bind('hashdata', fn() => new HashDataService());
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

        AboutCommand::add('Bot', fn () => [
            'Version' => config('app.version'),
            'Username' => config('bot.username'),
            'Privacy' => config('bot.privacy'),
            'News Channel' => config('bot.channel.username'),
            'Support Chat' => config('bot.support'),
            'Localization' => config('bot.localization'),
            'Changelog' => config('bot.changelog'),
        ]);

        AboutCommand::add('Donations', fn () => [
            'Enabled' => config('donation.enabled') ? 'Yes' : 'No',
            'Terms' => config('donation.terms'),
            'Telegram Provider Token' => config('donation.providers.telegram.token'),
        ]);

        AboutCommand::add('Telegram WebApp', fn () => [
            'Main' => route('webapp.stickerizer'),
            'Add Stickers' => route('webapp.addstickers'),
        ]);
    }
}
