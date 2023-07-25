<?php

namespace App\Telegram\Commands;

use SergiX44\Nutgram\Handlers\Type\Command;
use SergiX44\Nutgram\Nutgram;
use SergiX44\Nutgram\Telegram\Types\Keyboard\ReplyKeyboardRemove;
use function App\Helpers\stats;

class CancelCommand extends Command
{
    protected string $command = 'cancel';

    protected ?string $description = 'Close a conversation or a keyboard';

    public function handle(Nutgram $bot): void
    {
        try {
            $bot->endConversation();

            $bot->sendMessage(
                text: 'Removing keyboard...',
                reply_markup: ReplyKeyboardRemove::make(true),
            )?->delete();
        } finally {
            stats('command.cancel');
        }
    }
}
