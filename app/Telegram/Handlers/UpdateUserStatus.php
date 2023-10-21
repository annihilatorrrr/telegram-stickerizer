<?php

namespace App\Telegram\Handlers;

use App\Models\User;
use SergiX44\Nutgram\Nutgram;
use SergiX44\Nutgram\Telegram\Types\Chat\ChatMemberBanned;
use function App\Helpers\stats;

class UpdateUserStatus
{
    public function __invoke(Nutgram $bot): void
    {
        $user = $bot->get(User::class);
        $chatMember = $bot->chatMember();

        if ($user !== null && $chatMember !== null) {
            $user->blocked_at = $chatMember->new_chat_member instanceof ChatMemberBanned ? now() : null;
            $user->save();

            stats($user->blocked_at === null ? 'user.status.unblocked' : 'user.status.blocked');
        }
    }
}
