<?php

namespace App\Telegram\Middleware;

use App\Models\User;
use SergiX44\Nutgram\Nutgram;

class CheckUserBlocked
{
    public function __invoke(Nutgram $bot, $next): void
    {
        $user = $bot->get(User::class);

        if ($user?->blocked_at !== null) {
            return;
        }

        $next($bot);
    }
}
