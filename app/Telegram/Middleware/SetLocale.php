<?php

namespace App\Telegram\Middleware;

use App\Models\User;
use Illuminate\Support\Facades\App;
use SergiX44\Nutgram\Nutgram;

class SetLocale
{
    public function __invoke(Nutgram $bot, $next): void
    {
        $user = $bot->get(User::class);

        App::setLocale($user->language_code ?? config('app.locale'));

        $next($bot);
    }
}
