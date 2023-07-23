<?php

namespace App\Telegram\Commands;

use SergiX44\Nutgram\Handlers\Type\Command;
use SergiX44\Nutgram\Nutgram;
use SergiX44\Nutgram\Telegram\Properties\ParseMode;
use function App\Helpers\message;
use function App\Helpers\stats;

class AboutCommand extends Command
{
    protected string $command = 'about';

    protected ?string $description = 'About the bot';

    public function handle(Nutgram $bot): void
    {
        $bot->sendMessage(
            text: message('about'),
            parse_mode: ParseMode::HTML,
            disable_web_page_preview: true,
        );

        stats('command.about');
    }
}
