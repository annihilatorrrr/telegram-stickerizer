<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use SergiX44\Nutgram\Nutgram;

Route::post('/hook', fn(Nutgram $bot) => $bot->run());

Route::group(['prefix' => 'webapp', 'as' => 'webapp.'], function () {

    Route::get('/', function (Request $request) {
        return view('webapp.main', [
            'text' => $request->input('text'),
        ]);
    })->name('index');

});


