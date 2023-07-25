<?php

namespace App\Telegram\Commands;

use SergiX44\Nutgram\Handlers\Type\Command;
use SergiX44\Nutgram\Nutgram;
use SergiX44\Nutgram\Telegram\Properties\ParseMode;
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
        );

        stats('command.start');
    }
}
