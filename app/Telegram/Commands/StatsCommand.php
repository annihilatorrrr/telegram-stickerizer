<?php

namespace App\Telegram\Commands;

use Illuminate\Support\Facades\Cache;
use SergiX44\Nutgram\Handlers\Type\Command;
use SergiX44\Nutgram\Nutgram;
use SergiX44\Nutgram\Telegram\Properties\ParseMode;
use SergiX44\Nutgram\Telegram\Types\Keyboard\InlineKeyboardButton;
use SergiX44\Nutgram\Telegram\Types\Keyboard\InlineKeyboardMarkup;
use function App\Helpers\message;
use function App\Helpers\stats;

class StatsCommand extends Command
{
    protected string $command = 'stats';

    protected ?string $description = 'Show bot statistics';

    public function handle(Nutgram $bot): void
    {
        $data = Cache::get('stats');

        if ($data === null) {
            $bot->sendMessage(
                text: message('stats.empty'),
                parse_mode: ParseMode::HTML,
            );
            return;
        }

        $bot->sendMessage(
            text: $this->getMessage($data, 'stickers_sent'),
            parse_mode: ParseMode::HTML,
            reply_markup: InlineKeyboardMarkup::make()->addRow(
                InlineKeyboardButton::make(__('stats.stickers_sent'), callback_data: 'stats:stickers_sent'),
                InlineKeyboardButton::make(__('stats.active_users'), callback_data: 'stats:active_users'),
                InlineKeyboardButton::make(__('stats.users'), callback_data: 'stats:users'),
            ),
        );

        stats('command.stats');
    }

    public function updateStatsMessage(Nutgram $bot, string $value)
    {
        $data = Cache::get('stats');

        if ($data === null) {
            $bot->editMessageText(
                text: message('stats.empty'),
                parse_mode: ParseMode::HTML,
            );
            return;
        }

        $bot->editMessageText(
            text: $this->getMessage($data, $value),
            parse_mode: ParseMode::HTML,
            reply_markup: InlineKeyboardMarkup::make()->addRow(
                InlineKeyboardButton::make(__('stats.stickers_sent'), callback_data: 'stats:stickers_sent'),
                InlineKeyboardButton::make(__('stats.active_users'), callback_data: 'stats:active_users'),
                InlineKeyboardButton::make(__('stats.users'), callback_data: 'stats:users'),
            ),
        );

        $bot->answerCallbackQuery();
    }

    protected function getMessage(array $data, string $value): string
    {
        $title = match ($value) {
            'stickers_sent' => __('stats.stickers_sent'),
            'active_users' => __('stats.active_users'),
            'users' => __('stats.users'),
        };

        return message('stats.template', [
            'title' => $title,
            ...$data[$value],
            'lastUpdate' => $data['lastUpdate'],
        ]);
    }
}
