<?php

namespace App\Support;

use Spatie\LaravelSettings\Settings;

class AppSettings extends Settings
{
    public ?int $news_message_id;

    public static function group(): string
    {
        return 'app';
    }
}
