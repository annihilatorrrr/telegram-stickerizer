<?php

namespace App\Telegram\Commands;

use App\Telegram\Conversations\SettingsConversation;
use SergiX44\Nutgram\Handlers\Type\Command;
use SergiX44\Nutgram\Nutgram;

class SettingsCommand extends Command
{
    protected string $command = 'settings';

    protected ?string $description = 'Change the bot settings';

    public function handle(Nutgram $bot): void
    {
        SettingsConversation::begin($bot);
    }
}
