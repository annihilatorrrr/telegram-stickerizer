<?php

use App\Http\Controllers\WebAppController;
use App\Http\Middleware\ValidateFingerprint;
use App\Http\Middleware\ValidateWebAppData;
use Illuminate\Support\Facades\Route;
use SergiX44\Nutgram\Nutgram;

Route::post('/hook', fn(Nutgram $bot) => $bot->run());

Route::group(['prefix' => 'webapp', 'as' => 'webapp.'], function () {
    Route::get('/', [WebAppController::class, 'index'])->name('index');
    Route::get('/addstickers', [WebAppController::class, 'addStickers'])->name('addstickers');
    Route::get('sticker/preview/{sticker}.webp', [WebAppController::class, 'preview'])->name('sticker.preview')
        ->middleware('cache.headers:public;max_age=1800;etag');

    Route::middleware(ValidateWebAppData::class)->group(function () {
        Route::get('pack/{pack:code}', [WebAppController::class, 'pack'])->name('pack');
        Route::get('user/{user}', [WebAppController::class, 'user'])->name('user');
        Route::post('pack/{pack}/add', [WebAppController::class, 'addPack'])->name('pack.add');
        Route::post('pack/{pack}/remove', [WebAppController::class, 'removePack'])->name('pack.remove');
    });

    Route::middleware(ValidateFingerprint::class)->group(function () {
        Route::get('packs', [WebAppController::class, 'packs'])->name('packs');
        Route::get('search', [WebAppController::class, 'search'])->name('search');
        Route::post('sticker/send', [WebAppController::class, 'sendSticker'])->name('sticker.send');
        Route::get('sticker/history', [WebAppController::class, 'history'])->name('sticker.history.list');
        Route::delete('sticker/history/clear', [WebAppController::class, 'clearHistory'])->name('sticker.history.clear');
        Route::get('sticker/favorite', [WebAppController::class, 'getFavoriteStickers'])->name('sticker.favorite.list');
        Route::post('sticker/favorite', [WebAppController::class, 'saveFavoriteSticker'])->name('sticker.favorite.save');
        Route::delete('sticker/favorite/{favorite}', [WebAppController::class, 'removeFavoriteSticker'])->name('sticker.favorite.delete');
    });
});
