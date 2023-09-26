<?php

use App\Http\Controllers\MiniAppController;
use App\Http\Middleware\ValidateMiniApp;
use Illuminate\Support\Facades\Route;
use SergiX44\Nutgram\Nutgram;

Route::post('/hook', fn(Nutgram $bot) => $bot->run());

Route::group(['prefix' => 'webapp', 'as' => 'webapp.'], function () {
    Route::get('/page/stickerizer', [MiniAppController::class, 'stickerizer'])->name('stickerizer')->middleware('cache.headers:private;no_cache;must_revalidate;no_store;max_age=0;etag');
    Route::get('/page/addstickers', [MiniAppController::class, 'addStickers'])->name('addstickers');
    Route::get('/page/store', [MiniAppController::class, 'store'])->name('store');

    Route::get('sticker/preview/{sticker}.webp', [MiniAppController::class, 'preview'])->name('sticker.preview')
        ->middleware('cache.headers:public;max_age=1800;etag');

    Route::middleware(ValidateMiniApp::class)->group(function () {
        Route::get('user', [MiniAppController::class, 'user'])->name('user');

        Route::get('pack/{pack:code}', [MiniAppController::class, 'pack'])->name('pack');
        Route::post('pack/{pack}/add', [MiniAppController::class, 'addPack'])->name('pack.add');
        Route::post('pack/{pack}/remove', [MiniAppController::class, 'removePack'])->name('pack.remove');

        Route::get('packs', [MiniAppController::class, 'packs'])->name('packs');
        Route::get('search', [MiniAppController::class, 'search'])->name('search');
        Route::post('sticker/send', [MiniAppController::class, 'sendSticker'])->name('sticker.send');

        Route::get('sticker/history', [MiniAppController::class, 'history'])->name('sticker.history.list');
        Route::delete('sticker/history/clear', [MiniAppController::class, 'clearHistory'])->name('sticker.clear.history');

        Route::get('sticker/favorite', [MiniAppController::class, 'getFavoriteStickers'])->name('sticker.favorite.list');
        Route::delete('sticker/favorite/clear', [MiniAppController::class, 'clearFavorite'])->name('sticker.clear.favorite');
        Route::post('sticker/favorite', [MiniAppController::class, 'saveFavoriteSticker'])->name('sticker.favorite.save');
        Route::delete('sticker/favorite/{favorite}', [MiniAppController::class, 'removeFavoriteSticker'])->name('sticker.favorite.delete');

        Route::get('packs/trending', [MiniAppController::class, 'trendingPacks'])->name('packs.trending');
        Route::post('store/pack/{pack}/add', [MiniAppController::class, 'addPack'])->name('store.pack.add');
        Route::post('store/pack/{pack}/remove', [MiniAppController::class, 'removePack'])->name('store.pack.remove');
    });
});
