<?php

namespace App\Telegram\Commands;

use SergiX44\Nutgram\Handlers\Type\Command;
use SergiX44\Nutgram\Nutgram;
use SergiX44\Nutgram\Telegram\Properties\ParseMode;
use SergiX44\Nutgram\Telegram\Types\Keyboard\InlineKeyboardButton;
use SergiX44\Nutgram\Telegram\Types\Keyboard\InlineKeyboardMarkup;
use function App\Helpers\message;
use function App\Helpers\stats;

class PrivacyCommand extends Command
{
    protected string $command = 'privacy';

    protected ?string $description = 'Privacy Policy';

    public function handle(Nutgram $bot): void
    {
        $bot->sendMessage(
            text: message('privacy'),
            parse_mode: ParseMode::HTML,
            disable_web_page_preview: true,
            reply_markup: InlineKeyboardMarkup::make()
                ->addRow(InlineKeyboardButton::make(__('privacy.button'), config('bot.privacy'))),
        );

        stats('command.privacy');
    }
}
