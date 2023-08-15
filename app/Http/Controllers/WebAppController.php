<?php

namespace App\Http\Controllers;

use App\Http\Resources\PackResource;
use App\Http\Resources\StickersHistoryResource;
use App\Models\Pack;
use App\Models\Sticker;
use App\Models\StickersHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Facades\Image as ImageFacade;
use SergiX44\Nutgram\Nutgram;
use SergiX44\Nutgram\Telegram\Types\Internal\InputFile;

class WebAppController extends Controller
{
    public function index(Request $request)
    {
        return view('webapp.main', [
            'initData' => [
                'text' => $request->input('text'),
                'user_id' => $request->input('user_id'),
                'fingerprint' => $request->input('fingerprint'),
            ]
        ]);
    }

    public function preview(Request $request, Sticker $sticker)
    {
        $text = $request->input('text') ?: 'TEXT';
        $key = md5(sprintf("key_%s-text_%s", $sticker->id, $text));

        $dataUrl = Cache::rememberForever($key, function () use ($text, $sticker) {
            return (string)$sticker
                ->getGenerator()
                ->generate($text)
                ->resize(200, 200)
                ->encode('data-url');
        });

        return ImageFacade::make($dataUrl)->response('webp', 100);
    }

    public function sendSticker(Request $request, Nutgram $bot)
    {
        //get input
        $userID = $request->input('user_id');
        $stickerID = (int)$request->input('sticker_id');
        $text = $request->input('text') ?: 'TEXT';

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

        //save sticker data to cache
        Cache::put($message->message_id, [$message->sticker->file_id, $stickerID, $text]);

        //return sticker id
        return ['telegram_sticker_id' => $message->message_id];
    }

    public function packs()
    {
        $packs = Pack::query()
            ->with('stickers')
            ->get();

        return PackResource::collection($packs);
    }

    public function history(Request $request)
    {
        $history = StickersHistory::query()
            ->where('user_id', $request->input('user_id'))
            ->latest()
            ->get();

        return StickersHistoryResource::collection($history);
    }

    public function clearHistory(Request $request)
    {
        StickersHistory::query()
            ->where('user_id', $request->input('user_id'))
            ->delete();
    }
}
