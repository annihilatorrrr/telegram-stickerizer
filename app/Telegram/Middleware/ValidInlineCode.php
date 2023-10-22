<?php

namespace App\Telegram\Middleware;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use SergiX44\Nutgram\Nutgram;
use SergiX44\Nutgram\Telegram\Types\Inline\InlineQueryResultsButton;
use SergiX44\Nutgram\Telegram\Types\WebApp\WebAppInfo;

class ValidInlineCode
{
    public function __invoke(Nutgram $bot, $next): void
    {
        [$code] = $bot->currentParameters();

        if ($code === null || Cache::missing($code)) {
            $bot->answerInlineQuery(
                results: [],
                cache_time: 0,
                button: InlineQueryResultsButton::make(
                    text: __('inline.invalid_code'),
                    start_parameter: 'INVALID_CODE',
                )
            );
            return;
        }

        $next($bot);
    }
}
