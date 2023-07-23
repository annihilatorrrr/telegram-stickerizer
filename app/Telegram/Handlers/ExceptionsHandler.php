<?php

namespace App\Telegram\Handlers;

use SergiX44\Nutgram\Nutgram;
use Throwable;
use function App\Helpers\message;

class ExceptionsHandler
{
    public function api(Nutgram $bot, Throwable $e): void
    {
        $this->reportException($bot, $e);
    }

    public function global(Nutgram $bot, Throwable $e): void
    {
        $this->reportException($bot, $e);
    }

    protected function reportException(Nutgram $bot, Throwable $e): void
    {
        report($e);

        $bot->sendMessage(
            text: message('exception', [
                'name' => last(explode('\\', $e::class)),
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => str_replace(base_path(), '', $e->getFile()),
            ]),
            chat_id: config('developer.id'),
        );
    }
}
