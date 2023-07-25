<?php

namespace App\Facades;

use App\Support\Stats\StatsFakeService;
use Illuminate\Support\Facades\Facade;

/**
 * @method static void store(string $action, array $payload = null, int $user_id = null)
 * @method static void clear()
 * @method static void assertStored(string $action, array $payload = null, int $user_id = null)
 * @method static void assertNotStored(string $action, array $payload = null, int $user_id = null)
 * @method static void assertCount(int $count)
 */
class Stats extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'stats';
    }

    public static function fake(): void
    {
        static::swap(new StatsFakeService);
    }
}
