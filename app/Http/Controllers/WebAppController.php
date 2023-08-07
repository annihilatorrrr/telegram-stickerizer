<?php

namespace App\Http\Controllers;

use App\Http\Resources\PackResource;
use App\Models\Pack;
use App\Models\Sticker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use SergiX44\Nutgram\Nutgram;
use SergiX44\Nutgram\Telegram\Types\Internal\InputFile;

class WebAppController extends Controller
{
    public function index(Request $request)
    {
        return view('webapp.main', [
            'text' => $request->input('text'),
            'user_id' => $request->input('user_id'),
        ]);
    }

    public function preview(Request $request, Sticker $sticker)
    {
        return $sticker
            ->getGenerator()
            ->generate($request->input('text') ?: 'TEXT')
            ->resize(100, 100)
            ->response('webp', 50);
    }

    public function sendSticker(Request $request, Nutgram $bot)
    {
        //get input
        $userID = $request->input('user_id');
        $stickerID = $request->input('sticker_id');
        $text = $request->input('text');

        //generate sticker
        $stickerResource = Sticker::find($stickerID)
            ->getGenerator()
            ->generate($text)
            ->stream('webp', 100)
            ->detach();

        //send sticker to user
        $message = $bot->sendSticker(
            sticker: InputFile::make($stickerResource, 'sticker.webp'),
            chat_id: $userID,
            disable_notification: true,
        );

        //save sticker ID to cache
        Cache::put($message->message_id, $message->sticker->file_id);

        //return sticker id
        return ['telegram_sticker_id' => $message->message_id];
    }

    public function packs()
    {
        return PackResource::collection(Pack::all());
    }
}
