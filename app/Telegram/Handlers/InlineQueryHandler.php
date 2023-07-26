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
                web_app: new WebAppInfo(route('webapp.index', ['text' => $bot->inlineQuery()->query])),
            )
        );
    }

    public function result(Nutgram $bot, string $sticker): void
    {
        $bot->answerInlineQuery(
            results: [
                InlineQueryResultCachedSticker::make(
                    id: $sticker,
                    sticker_file_id: $sticker,
                ),
            ],
            cache_time: 0,
            button: InlineQueryResultsButton::make(
                text: "Click here to create your sticker!",
                web_app: new WebAppInfo(route('webapp.index', ['text' => $bot->inlineQuery()->query])),
            )
        );
    }
}
