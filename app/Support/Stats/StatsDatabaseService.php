<?php

namespace App\Support\Stats;

use App\Models\Statistic;
use SergiX44\Nutgram\Nutgram;

class StatsDatabaseService implements StatsInterface
{
    public function store(string $action, array $payload = null, int $user_id = null): void
    {
        Statistic::create([
            'collected_at' => now(),
            'user_id' => $user_id ?? app(Nutgram::class)->userId(),
            'action' => $action,
            'payload' => $payload,
        ]);
    }
}
