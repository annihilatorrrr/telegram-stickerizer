<?php

use App\Models\Sticker;
use App\Telegram\Exceptions\StickerSetNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use SergiX44\Nutgram\Nutgram;
use SergiX44\Nutgram\Telegram\Types\Input\InputSticker;
use SergiX44\Nutgram\Telegram\Types\Internal\InputFile;

Route::post('/hook', fn(Nutgram $bot) => $bot->run());

Route::get('sticker/{sticker}.webp', function (Request $request, Sticker $sticker) {

    $text = $request->input('text', 'Hello World!');

    $sticker = $sticker->getGenerator()->generate($text);

    return $sticker->response('webp', 100);
});

Route::group(['prefix' => 'webapp', 'as' => 'webapp.'], function () {

    Route::get('/', function (Request $request) {
        return view('webapp.main', [
            'text' => $request->input('text'),
            'user_id' => $request->input('user_id'),
        ]);
    })->name('index');

    Route::post('sticker/send', function (Request $request, Nutgram $bot) {
        //get input
        $userID = $request->input('user_id');
        $stickerID = $request->input('sticker_id');
        $text = $request->input('text');

        //generate sticker
        $stickerImage = Sticker::find($stickerID)->getGenerator()->generate($text);
        $stickerResource = $stickerImage->stream('webp', 100)->detach();
        $stickerToUpload = InputFile::make($stickerResource, 'sticker.webp');

        //build pack name
        $packName = sprintf("StickerizerHistory_for_%s_by_Stickerizer2Bot", $userID);

        //create pack and add sticker OR add sticker to existing pack
        try {
            $bot->getStickerSet($packName);
            $bot->addStickerToSet(
                name: $packName,
                sticker: InputSticker::make(sticker: $stickerToUpload, emoji_list: ['🕒']),
                user_id: $userID,
            );
        } catch (StickerSetNotFoundException) {
            $bot->createNewStickerSet(
                name: $packName,
                title: 'Stickerizer History',
                stickers: [InputSticker::make(sticker: $stickerToUpload, emoji_list: ['🕒'])],
                sticker_format: 'static',
                user_id: $userID,
                sticker_type: 'regular',
            );
        }

        //reorder generated sticker to first position
        $stickerId = end($bot->getStickerSet($packName)->stickers)->file_id;
        $bot->setStickerPositionInSet($stickerId, 0);

        //get generated sticker id
        $stickerSet = $bot->getStickerSet($packName);
        $stickerId = $stickerSet->stickers[0]->file_id;

        //delete old sticker
        if (count($stickerSet->stickers) > 10) {
            $bot->deleteStickerFromSet(end($stickerSet->stickers)->file_id);
        }

        //return sticker id
        return ['telegram_sticker_id' => $stickerId];
    })->name('sticker.send');

});
