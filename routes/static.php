<?php

use App\Models\Sticker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use SergiX44\Nutgram\Nutgram;

Route::post('/hook', fn(Nutgram $bot) => $bot->run());

Route::get('sticker/{sticker}.webp', function (Request $request, Sticker $sticker) {

    $text = $request->input('text', 'Hello World!');

    $sticker = $sticker->getGenerator()->generate($text);

    return $sticker->response('webp', 100);
});
