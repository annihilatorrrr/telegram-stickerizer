<?php

return [

    'username' => env('BOT_USERNAME'),
    'privacy' => env('BOT_PRIVACY'),
    'changelog' => env('BOT_CHANGELOG'),
    'channel' => [
        'id' => env('BOT_CHANNEL_ID'),
        'username' => env('BOT_CHANNEL_USERNAME'),
    ],
    'support' => env('BOT_SUPPORT'),
    'localization' => env('BOT_LOCALIZATION'),

];
