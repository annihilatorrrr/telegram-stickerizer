<?php

namespace App\Telegram\Middleware;

use SergiX44\Nutgram\Nutgram;

class DevOnly
{
    public function __invoke(Nutgram $bot, $next): void
    {
        $message = 'You are not allowed to use this bot.';

        if ($bot->userId() !== config('developer.id')) {
            if ($bot->isCallbackQuery()) {
                $bot->answerCallbackQuery(text: $message);
            }

            $bot->sendMessage(text: $message);

            return;
        }

        $next($bot);
    }
}
