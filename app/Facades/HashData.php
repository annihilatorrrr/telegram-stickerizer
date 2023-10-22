<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static array validate(string $rawData)
 * @method static string build(array $data)
 * @see \App\Support\HashData\HashDataService
 */
class HashData extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'hashdata';
    }
}
