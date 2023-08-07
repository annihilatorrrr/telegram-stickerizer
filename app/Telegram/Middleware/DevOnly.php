<?php

namespace App\Telegram\Middleware;

use SergiX44\Nutgram\Nutgram;

class DevOnly
{
    public function __invoke(Nutgram $bot, $next): void
    {
        if ($bot->userId() !== config('developer.id')) {
            $bot->sendMessage('You are not allowed to use this bot.');
            return;
        }

        $next($bot);
    }
}
