<?php

namespace App\Telegram\Middleware;

use App\Models\User;
use SergiX44\Nutgram\Nutgram;
use SergiX44\Nutgram\Telegram\Properties\ParseMode;
use function App\Helpers\message;

class CheckMaintenance
{
    public function __invoke(Nutgram $bot, $next): void
    {
        $user = $bot->get(User::class);

        if (!app()->isDownForMaintenance()) {
            $next($bot);
            return;
        }

        if ($user->id === config('developer.id')) {
            $bot->sendMessage(
                text: '<b>⚠ MAINTENANCE MODE ENABLED ⚠</b>',
                parse_mode: ParseMode::HTML,
            );

            $next($bot);
            return;
        }


        $bot->sendMessage(
            text: message('maintenance'),
            parse_mode: ParseMode::HTML,
        );
    }
}
