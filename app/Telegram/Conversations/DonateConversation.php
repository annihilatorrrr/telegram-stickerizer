<?php

namespace App\Telegram\Conversations;

use SergiX44\Nutgram\Conversations\InlineMenu;
use SergiX44\Nutgram\Nutgram;
use SergiX44\Nutgram\Telegram\Properties\ParseMode;
use SergiX44\Nutgram\Telegram\Types\Keyboard\InlineKeyboardButton;
use function App\Helpers\message;
use function App\Helpers\stats;

class DonateConversation extends InlineMenu
{
    public function start(Nutgram $bot)
    {
        $this->menuText(message('donate.menu'), [
            'parse_mode' => ParseMode::HTML,
            'disable_web_page_preview' => true,
        ]);

        $this->clearButtons();
        $this->addButtonRow(InlineKeyboardButton::make(
            text: 'Telegram Payment',
            callback_data: 'donate.telegram@menuTelegram'
        ));

        foreach (config('donation.providers.third_party') as $service => $value) {
            $this->addButtonRow(InlineKeyboardButton::make(text: $service, url: $value));
        }

        $this->addButtonRow(InlineKeyboardButton::make(
            text: trans('common.cancel'),
            callback_data: 'donate.cancel@end'
        ));

        $this->showMenu();

        stats('command.donate');
    }

    public function menuTelegram(): void
    {
        $this->menuText(message('donate.telegram'), [
            'parse_mode' => ParseMode::HTML,
            'disable_web_page_preview' => true,
        ]);

        $this->clearButtons();

        $buttons = collect(config('donation.providers.telegram.prices'))
            ->map(fn($price) => InlineKeyboardButton::make(
                text: "$price$",
                callback_data: "$price@donationInvoice"
            ))
            ->toArray();

        $this->addButtonRow(...$buttons);

        $this->addButtonRow(InlineKeyboardButton::make(
            text: trans('common.back'),
            callback_data: 'donate.telegram.back@start'
        ));

        $this->showMenu();

        stats('donate.telegram');
    }

    public function donationInvoice(Nutgram $bot, string $data): void
    {
        $value = (int)$data;

        $this->bot->sendInvoice(
            title: trans('donate.donation'),
            description: trans('donate.support_by_donating'),
            payload: 'donation',
            provider_token: config('donation.providers.telegram.token'),
            currency: 'USD',
            prices: [['label' => "{$value}$", 'amount' => $value * 100]],
        );

        $this->end();

        stats('donate.invoice', ['value' => $value]);
    }
}
