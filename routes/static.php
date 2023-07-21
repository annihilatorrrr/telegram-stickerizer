<?php

use App\Stickerizer\Layers\InputTextLayer;
use App\Stickerizer\StickerGenerator;
use App\Stickerizer\Styles\Color;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use SergiX44\Nutgram\Nutgram;

Route::post('/hook', fn(Nutgram $bot) => $bot->run());

Route::get('sticker.webp', function (Request $request) {

    $text = $request->input('text', 'Hello World!');

    $sticker = StickerGenerator::make(512, 512)
        ->addLayer(
            InputTextLayer::make(
                fontColor: Color::fromRgba(0, 0, 0),
                strokeSize: 2,
                strokeColor: Color::fromRgba(255, 255, 255),
            )
        )
        ->generate($text);

    return $sticker->response('webp', 100);
});
