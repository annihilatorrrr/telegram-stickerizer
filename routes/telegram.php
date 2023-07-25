<?php
/** @var SergiX44\Nutgram\Nutgram $bot */

use App\Telegram\Commands\AboutCommand;
use App\Telegram\Commands\CancelCommand;
use App\Telegram\Commands\FeedbackCommand;
use App\Telegram\Commands\PrivacyCommand;
use App\Telegram\Commands\StartCommand;
use App\Telegram\Commands\StatsCommand;
use App\Telegram\Handlers\ExceptionsHandler;
use App\Telegram\Handlers\UpdateUserStatus;
use App\Telegram\Middleware\CheckMaintenance;
use App\Telegram\Middleware\CollectUser;
use SergiX44\Nutgram\Nutgram;
use SergiX44\Nutgram\Telegram\Types\Inline\InlineQueryResultsButton;
use SergiX44\Nutgram\Telegram\Types\WebApp\WebAppInfo;

/*
|--------------------------------------------------------------------------
| Global middlewares
|--------------------------------------------------------------------------
*/

$bot->middleware(CollectUser::class);
$bot->middleware(CheckMaintenance::class);

/*
|--------------------------------------------------------------------------
| Bot handlers
|--------------------------------------------------------------------------
*/

$bot->onMyChatMember(UpdateUserStatus::class);

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

/*
|--------------------------------------------------------------------------
| Bot commands
|--------------------------------------------------------------------------
*/

$bot->registerCommand(StartCommand::class);
$bot->registerCommand(FeedbackCommand::class);
$bot->registerCommand(PrivacyCommand::class);
$bot->registerCommand(AboutCommand::class);
$bot->registerCommand(CancelCommand::class);
$bot->registerCommand(StatsCommand::class);

/*
|--------------------------------------------------------------------------
| Exception handlers
|--------------------------------------------------------------------------
*/

$bot->onApiError([ExceptionsHandler::class, 'api']);
$bot->onException([ExceptionsHandler::class, 'global']);
