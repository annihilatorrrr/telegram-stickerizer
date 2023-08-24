<?php

namespace App\Telegram\Middleware;

use App\Models\User;
use SergiX44\Nutgram\Nutgram;

class SetLocale
{
    public function __invoke(Nutgram $bot, $next): void
    {
        $bot->get(User::class)->setLocale();

        $next($bot);
    }
}
