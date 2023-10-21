<?php

namespace App\Telegram\Middleware;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use SergiX44\Nutgram\Nutgram;
use SergiX44\Nutgram\Telegram\Properties\ChatType;

class CollectUser
{
    public function __invoke(Nutgram $bot, $next): void
    {
        if ($bot->user() === null) {
            return;
        }

        $user = $this->saveUser($bot);

        $bot->set(User::class, $user);

        $next($bot);
    }

    protected function saveUser(Nutgram $bot): User
    {
        return DB::transaction(function () use ($bot) {
            $user = User::updateOrCreate([
                'id' => $bot->user()->id,
            ], [
                'first_name' => $bot->user()->first_name,
                'last_name' => $bot->user()->last_name,
                'username' => $bot->user()->username,
                'language_code' => $bot->user()->language_code,
            ]);

            $this->checkStartedFromPM($user, $bot);

            return $user;
        });
    }

    protected function checkStartedFromPM(User $user, Nutgram $bot): void
    {
        if ($user->started_at === null && $bot->chat()?->type === ChatType::PRIVATE) {
            $user->started_at = now();
            $user->save();
        }
    }
}
