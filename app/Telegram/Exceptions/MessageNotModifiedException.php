<?php

namespace App\Telegram\Exceptions;

use SergiX44\Nutgram\Exception\ApiException;
use SergiX44\Nutgram\Nutgram;
use SergiX44\Nutgram\Telegram\Exceptions\TelegramException;

class MessageNotModifiedException extends ApiException
{
    public static ?string $pattern = '.*message is not modified.*';

    public function __invoke(Nutgram $bot, TelegramException $e)
    {
        //ignore this exception
    }
}
