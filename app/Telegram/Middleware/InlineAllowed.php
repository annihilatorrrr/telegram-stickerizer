<?php

namespace App\Telegram\Middleware;

use App\Models\User;
use SergiX44\Nutgram\Nutgram;
use SergiX44\Nutgram\Telegram\Types\Inline\InlineQueryResultsButton;

class InlineAllowed
{
    public function __invoke(Nutgram $bot, $next): void
    {
        /** @var User $user */
        $user = $bot->get(User::class);

        if ($user->blocked_at !== null) {
            $bot->answerInlineQuery(
                results: [],
                cache_time: 0,
                button: InlineQueryResultsButton::make(
                    text: '❌ You need to unblock the bot first! ❌',
                    start_parameter: 'BOT_BLOCKED',
                )
            );
            return;
        }

        if ($user->started_at === null) {
            $bot->answerInlineQuery(
                results: [],
                cache_time: 0,
                button: InlineQueryResultsButton::make(
                    text: '❌ You need to start the bot first! ❌',
                    start_parameter: 'BOT_NOT_STARTED',
                )
            );
            return;
        }

        $next($bot);
    }
}
