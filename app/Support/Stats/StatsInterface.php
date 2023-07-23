<?php

namespace App\Support\Stats;

interface StatsInterface
{
    public function store(string $action, array $payload = null, int $user_id = null): void;
}
