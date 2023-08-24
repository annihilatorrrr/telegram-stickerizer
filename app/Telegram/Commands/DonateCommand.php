<?php

namespace App\Telegram\Commands;

use App\Telegram\Conversations\DonateConversation;
use SergiX44\Nutgram\Handlers\Type\Command;
use SergiX44\Nutgram\Nutgram;
use function App\Helpers\stats;

class DonateCommand extends Command
{
    protected string $command = 'donate';

    protected ?string $description = 'Make a donation';

    public function handle(Nutgram $bot): void
    {
        DonateConversation::begin($bot);
    }

    public function precheckout(Nutgram $bot)
    {
        $bot->answerPreCheckoutQuery(true);

        stats('payment.precheckout');
    }

    public function successful(Nutgram $bot)
    {
        $bot->sendMessage(__('donate.thanks'));

        stats('payment.successful');
    }

    public function isHidden(): bool
    {
        return !config('donation.enabled');
    }
}
