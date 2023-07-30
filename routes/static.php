<?php

use App\Http\Controllers\WebAppController;
use Illuminate\Support\Facades\Route;
use SergiX44\Nutgram\Nutgram;

Route::post('/hook', fn(Nutgram $bot) => $bot->run());

Route::group(['prefix' => 'webapp', 'as' => 'webapp.'], function () {
    Route::get('/', [WebAppController::class, 'index'])->name('index');
    Route::get('sticker/preview/{sticker}.webp', [WebAppController::class, 'preview'])->name('sticker.preview');
    Route::post('sticker/send', [WebAppController::class, 'sendSticker'])->name('sticker.send');
});
