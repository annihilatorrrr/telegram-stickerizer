<?php
/** @var SergiX44\Nutgram\Nutgram $bot */

use App\Telegram\Commands\AboutCommand;
use App\Telegram\Commands\CancelCommand;
use App\Telegram\Commands\FeedbackCommand;
use App\Telegram\Commands\HelpCommand;
use App\Telegram\Commands\PrivacyCommand;
use App\Telegram\Commands\StartCommand;
use App\Telegram\Commands\StatsCommand;
use App\Telegram\Exceptions\StickerSetNotFoundException;
use App\Telegram\Handlers\ExceptionsHandler;
use App\Telegram\Handlers\InlineQueryHandler;
use App\Telegram\Handlers\UpdateUserStatus;
use App\Telegram\Middleware\CheckMaintenance;
use App\Telegram\Middleware\CollectUser;
use App\Telegram\Middleware\DevOnly;
use App\Telegram\Middleware\InlineAllowed;
use SergiX44\Nutgram\Nutgram;

/*
|--------------------------------------------------------------------------
| Global middlewares
|--------------------------------------------------------------------------
*/

$bot->middleware(DevOnly::class);
$bot->middleware(CollectUser::class);
$bot->middleware(CheckMaintenance::class);

/*
|--------------------------------------------------------------------------
| Bot handlers
|--------------------------------------------------------------------------
*/

$bot->onMyChatMember(UpdateUserStatus::class);
$bot->onInlineQuery([InlineQueryHandler::class, 'input'])
    ->middleware(InlineAllowed::class);
$bot->onInlineQueryText('^Ꜣ(.*)', [InlineQueryHandler::class, 'result'])
    ->middleware(InlineAllowed::class);
$bot->onChosenInlineResult([InlineQueryHandler::class, 'chosen']);

/*
|--------------------------------------------------------------------------
| Bot commands
|--------------------------------------------------------------------------
*/

$bot->onCommand('start (.*)', StartCommand::class);
$bot->registerCommand(StartCommand::class);
$bot->registerCommand(HelpCommand::class);
$bot->registerCommand(StatsCommand::class);
$bot->registerCommand(AboutCommand::class);
$bot->registerCommand(PrivacyCommand::class);
$bot->registerCommand(FeedbackCommand::class);
$bot->registerCommand(CancelCommand::class);

/*
|--------------------------------------------------------------------------
| Exception handlers
|--------------------------------------------------------------------------
*/

$bot->onApiError('.*(STICKERSET_INVALID|STICKERPACK_NOT_FOUND).*', function (Nutgram $bot, $e) {
    throw new StickerSetNotFoundException($e->getMessage());
});

$bot->onApiError([ExceptionsHandler::class, 'api']);
$bot->onException([ExceptionsHandler::class, 'global']);
