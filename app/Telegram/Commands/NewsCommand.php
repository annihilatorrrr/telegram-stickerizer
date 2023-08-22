<?php

namespace App\Telegram\Commands;

use Illuminate\Support\Facades\DB;
use SergiX44\Nutgram\Handlers\Type\Command;
use SergiX44\Nutgram\Nutgram;
use function App\Helpers\settings;

class NewsCommand extends Command
{
    protected string $command = 'news ?(.*)?';

    public function handle(Nutgram $bot, ?string $messageID): void
    {
        if ($messageID !== null) {
            if (!is_numeric($messageID)) {
                $bot->sendMessage('Value must be a number');
                return;
            }

            $this->reset();
            settings()->news_message_id = (int)$messageID;
            settings()->save();
        } else {
            $this->reset();
        }

        $bot->sendMessage('Done.');
    }

    protected function reset(): void
    {
        settings()->news_message_id = null;
        settings()->save();

        DB::table('model_settings')->update([
            'settings->news->notified_at' => null
        ]);
    }
}
