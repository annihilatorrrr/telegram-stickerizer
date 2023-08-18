<?php

namespace App\Helpers;

use App\Facades\Stats;
use Illuminate\Support\Str;

function message(string $view, array $values = []): string
{
    return rescue(function () use ($view, $values) {
        return (string)Str::of(view("messages.$view", $values)->render())
            ->replaceMatches('/\r\n|\r|\n/', '')
            ->replace(['<br>', '<BR>'], "\n");
    }, 'messages.' . $view, false);
}

function stats(string $action, array $payload = null, int $user_id = null): void
{
    Stats::store($action, $payload, $user_id);
}

function trans_bool(bool $condition, string $trueKey, string $falseKey)
{
    return trans($condition ? $trueKey : $falseKey);
}
