<?php

namespace App\Telegram\Commands;

use Illuminate\Support\Facades\Cache;
use SergiX44\Nutgram\Handlers\Type\Command;
use SergiX44\Nutgram\Nutgram;
use SergiX44\Nutgram\Telegram\Properties\ParseMode;
use function App\Helpers\message;
use function App\Helpers\stats;

class StatsCommand extends Command
{
    protected string $command = 'stats';

    protected ?string $description = 'Show bot statistics';

    public function handle(Nutgram $bot): void
    {
        $bot->sendMessage(
            text: $this->getMessage(),
            parse_mode: ParseMode::HTML,
            disable_web_page_preview: true,
        );

        stats('command.stats');
    }

    protected function getMessage(): string
    {
        $data = Cache::get('stats');

        if ($data === null) {
            return message('stats.empty');
        }

        return message('stats.full', $data);
    }
}
