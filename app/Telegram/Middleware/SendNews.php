<?php

namespace App\Telegram\Middleware;

use App\Models\User;
use SergiX44\Nutgram\Nutgram;
use SergiX44\Nutgram\Telegram\Properties\ChatMemberStatus;
use function App\Helpers\settings;

class SendNews
{
    public function __invoke(Nutgram $bot, $next): void
    {
        if ($bot->chatId() === null) {
            $next($bot);
            return;
        }

        if ($bot->isCallbackQuery()) {
            $next($bot);
            return;
        }

        if (settings()->news_message_id === null) {
            $next($bot);
            return;
        }

        $user = $bot->get(User::class);

        if ($bot->chatMember() && $bot->chatMember()->new_chat_member->status !== ChatMemberStatus::MEMBER) {
            $next($bot);
            return;
        }

        if (!$user->canReceiveNews()) {
            $next($bot);
            return;
        }

        $next($bot);

        $bot->forwardMessage(
            chat_id: $bot->chatId(),
            from_chat_id: config('bot.channel.id'),
            message_id: settings()->news_message_id,
        );

        $user->markNewsAsNotified();
    }
}
