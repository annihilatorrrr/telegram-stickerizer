<?php
/** @var SergiX44\Nutgram\Nutgram $bot */

use App\Telegram\Commands\AboutCommand;
use App\Telegram\Commands\CancelCommand;
use App\Telegram\Commands\DonateCommand;
use App\Telegram\Commands\FeedbackCommand;
use App\Telegram\Commands\GdprCommand;
use App\Telegram\Commands\HelpCommand;
use App\Telegram\Commands\NewsCommand;
use App\Telegram\Commands\PrivacyCommand;
use App\Telegram\Commands\SettingsCommand;
use App\Telegram\Commands\StartCommand;
use App\Telegram\Commands\StatsCommand;
use App\Telegram\Handlers\ExceptionsHandler;
use App\Telegram\Handlers\InlineQueryHandler;
use App\Telegram\Handlers\UpdateUserStatus;
use App\Telegram\Middleware\CheckMaintenance;
use App\Telegram\Middleware\CollectUser;
use App\Telegram\Middleware\DevOnly;
use App\Telegram\Middleware\InlineAllowed;
use App\Telegram\Middleware\SendNews;
use App\Telegram\Middleware\SetLocale;
use App\Telegram\Middleware\ValidInlineCode;
use SergiX44\Nutgram\Nutgram;

/*
|--------------------------------------------------------------------------
| Global middlewares
|--------------------------------------------------------------------------
*/

$bot->middleware(CollectUser::class);
$bot->middleware(SetLocale::class);
$bot->middleware(CheckMaintenance::class);
$bot->middleware(SendNews::class);

/*
|--------------------------------------------------------------------------
| Bot handlers
|--------------------------------------------------------------------------
*/

$bot->onMyChatMember(UpdateUserStatus::class);
$bot->onCallbackQueryData('gdpr.download', [GdprCommand::class, 'downloadData']);
$bot->onChosenInlineResult([InlineQueryHandler::class, 'chosen']);
$bot->onPreCheckoutQuery([DonateCommand::class, 'precheckout']);
$bot->onSuccessfulPayment([DonateCommand::class, 'successful']);

$bot->group(function (Nutgram $bot) {
    $bot->onInlineQuery([InlineQueryHandler::class, 'input']);
    $bot->onInlineQueryText('^Ꜣ(.*)', [InlineQueryHandler::class, 'result'])
        ->middleware(ValidInlineCode::class);
})->middleware(InlineAllowed::class);

/*
|--------------------------------------------------------------------------
| Bot commands
|--------------------------------------------------------------------------
*/

$bot->onCommand('start (.*)', StartCommand::class);
$bot->registerCommand(StartCommand::class);
$bot->registerCommand(HelpCommand::class);
$bot->registerCommand(SettingsCommand::class);
$bot->registerCommand(StatsCommand::class);
$bot->registerCommand(AboutCommand::class);
$bot->registerCommand(DonateCommand::class);
$bot->registerCommand(FeedbackCommand::class);
$bot->registerCommand(PrivacyCommand::class);
$bot->registerCommand(GdprCommand::class);
$bot->registerCommand(CancelCommand::class);
$bot->registerCommand(NewsCommand::class)->middleware(DevOnly::class);

/*
|--------------------------------------------------------------------------
| Exception handlers
|--------------------------------------------------------------------------
*/

$bot->onApiError([ExceptionsHandler::class, 'api']);
$bot->onException([ExceptionsHandler::class, 'global']);
