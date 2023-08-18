<?php

namespace App\Telegram\Commands;

use SergiX44\Nutgram\Handlers\Type\Command;
use SergiX44\Nutgram\Nutgram;
use SergiX44\Nutgram\Telegram\Properties\ParseMode;
use SergiX44\Nutgram\Telegram\Types\Keyboard\InlineKeyboardButton;
use SergiX44\Nutgram\Telegram\Types\Keyboard\InlineKeyboardMarkup;
use function App\Helpers\message;
use function App\Helpers\stats;

class StartCommand extends Command
{
    protected string $command = 'start';

    protected ?string $description = 'Initial bot message';

    public function handle(Nutgram $bot): void
    {
        $bot->sendMessage(
            text: message('start'),
            parse_mode: ParseMode::HTML,
            reply_markup: InlineKeyboardMarkup::make()->addRow(
                InlineKeyboardButton::make(
                    text: __('inline.start'),
                    switch_inline_query: '',
                )
            ),
        );

        stats('command.start');
    }
}
