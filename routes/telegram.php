<?php
/** @var SergiX44\Nutgram\Nutgram $bot */

use SergiX44\Nutgram\Nutgram;
use SergiX44\Nutgram\Telegram\Types\Inline\InlineQueryResultsButton;
use SergiX44\Nutgram\Telegram\Types\WebApp\WebAppInfo;

/*
|--------------------------------------------------------------------------
| Nutgram Handlers
|--------------------------------------------------------------------------
|
| Here is where you can register telegram handlers for Nutgram. These
| handlers are loaded by the NutgramServiceProvider. Enjoy!
|
*/

$bot->onCommand('start', function (Nutgram $bot) {
    $bot->sendMessage('Hello, world!');
})->description('The start command!');

$bot->onInlineQueryText('^Ꜣ(.*)', function (Nutgram $bot, string $text) {
    $bot->answerInlineQuery(
        results: [],
        cache_time: 0,
        button: InlineQueryResultsButton::make(
            text: "Code: $text",
            start_parameter: 'code',
        )
    );
});

$bot->onInlineQuery(function (Nutgram $bot) {
    $bot->answerInlineQuery(
        results: [],
        cache_time: 0,
        button: InlineQueryResultsButton::make(
            text: "Click here to create your sticker!",
            web_app: new WebAppInfo(route('webapp.index', ['text' => $bot->inlineQuery()->query])),
        )
    );
});
