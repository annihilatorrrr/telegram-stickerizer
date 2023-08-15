<?php

use App\Http\Controllers\WebAppController;
use App\Http\Middleware\ValidateFingerprint;
use Illuminate\Support\Facades\Route;
use SergiX44\Nutgram\Nutgram;

Route::post('/hook', fn(Nutgram $bot) => $bot->run());

Route::group(['prefix' => 'webapp', 'as' => 'webapp.'], function () {
    Route::get('/', [WebAppController::class, 'index'])->name('index');
    Route::get('sticker/preview/{sticker}.webp', [WebAppController::class, 'preview'])->name('sticker.preview')
        ->middleware('cache.headers:public;max_age=1800;etag');
    Route::get('packs', [WebAppController::class, 'packs'])->name('packs');

    Route::middleware(ValidateFingerprint::class)->group(function () {
        Route::post('sticker/send', [WebAppController::class, 'sendSticker'])->name('sticker.send');
        Route::get('sticker/history', [WebAppController::class, 'history'])->name('sticker.history.list');
        Route::delete('sticker/history/clear', [WebAppController::class, 'clearHistory'])->name('sticker.history.clear');
    });
});
