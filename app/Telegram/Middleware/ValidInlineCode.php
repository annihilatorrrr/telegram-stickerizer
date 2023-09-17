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
                    web_app: new WebAppInfo(route('webapp.index', [
                        'text' => '',
                        'user_id' => $bot->userId(),
                        'lang' => App::getLocale(),
                        'fingerprint' => hash_hmac('sha256', $bot->userId(), config('app.key')),
                    ])),
                )
            );
            return;
        }

        $next($bot);
    }
}
