<?php

namespace App\Support\Stats;

use App\Models\Statistic;
use SergiX44\Nutgram\Nutgram;
use function Nutgram\Laravel\Support\webAppData;

class StatsDatabaseService implements StatsInterface
{
    public function store(string $action, array $payload = null, int $user_id = null): void
    {
        Statistic::create([
            'collected_at' => now(),
            'user_id' => $this->resolveUserID($user_id),
            'action' => $action,
            'payload' => $payload,
        ]);
    }

    protected function resolveUserID(int $user_id = null): ?int
    {
        if ($user_id !== null) {
            return $user_id;
        }

        if (app(Nutgram::class)->userId() !== null) {
            return app(Nutgram::class)->userId();
        }

        if (webAppData()?->user->id !== null) {
            return webAppData()->user->id;
        }

        if (request()?->has('user_id')) {
            return (int)request()?->input('user_id');
        }

        return null;
    }
}
