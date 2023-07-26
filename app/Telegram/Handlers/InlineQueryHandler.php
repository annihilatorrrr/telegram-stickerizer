<?php

namespace App\Telegram\Handlers;

use SergiX44\Nutgram\Nutgram;
use SergiX44\Nutgram\Telegram\Types\Inline\InlineQueryResultCachedSticker;
use SergiX44\Nutgram\Telegram\Types\Inline\InlineQueryResultsButton;
use SergiX44\Nutgram\Telegram\Types\WebApp\WebAppInfo;

class InlineQueryHandler
{
    public function input(Nutgram $bot): void
    {
        $bot->answerInlineQuery(
            results: [],
            cache_time: 0,
            button: InlineQueryResultsButton::make(
                text: "Click here to create your sticker!",
                web_app: new WebAppInfo(route('webapp.index', [
                    'text' => $bot->inlineQuery()->query,
                    'user_id' => $bot->inlineQuery()->from->id,
                ])),
            )
        );
    }

    public function result(Nutgram $bot, string $sticker): void
    {
        info('result', ['sticker' => $sticker]);

        $bot->answerInlineQuery(
            results: [
                InlineQueryResultCachedSticker::make(
                    id: (string)time(),
                    sticker_file_id: $sticker,
                ),
            ],
            cache_time: 0,
        );
    }
}
