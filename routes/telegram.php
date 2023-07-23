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
