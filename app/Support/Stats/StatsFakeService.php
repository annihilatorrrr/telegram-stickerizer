<?php

namespace App\Support\Stats;

use Illuminate\Support\Collection;
use Illuminate\Testing\Assert;
use SergiX44\Nutgram\Nutgram;

class StatsFakeService implements StatsInterface
{
    protected Collection $stats;

    public function __construct()
    {
        $this->stats = collect();
    }

    public function store(string $action, array $payload = null, int $user_id = null): void
    {
        $this->stats->push([
            'collected_at' => now(),
            'user_id' => $user_id ?? app(Nutgram::class)->userId(),
            'action' => $action,
            'payload' => $payload,
        ]);
    }

    public function clear(): void
    {
        $this->stats = collect();
    }

    public function assertStored(
        string $action,
        array $payload = null,
        int $user_id = null
    ): void {
        $result = $this->stats
            ->where('action', $action)
            ->when($payload !== null, fn($query) => $query->where('payload', $payload))
            ->when($user_id !== null, fn($query) => $query->where('user_id', $user_id));

        Assert::assertTrue($result->isNotEmpty(), 'The stats was not stored.');
    }

    public function assertNotStored(
        string $action,
        array $payload = null,
        int $user_id = null
    ): void {
        $result = $this->stats
            ->where('action', $action)
            ->when($payload !== null, fn($query) => $query->where('payload', $payload))
            ->when($user_id !== null, fn($query) => $query->where('user_id', $user_id));

        Assert::assertTrue($result->isEmpty(), 'The stats was stored.');
    }

    public function assertCount(int $count): void
    {
        $result = $this->stats->count();

        Assert::assertSame($result, $count, "The stats count was $result, expected $count.");
    }
}
