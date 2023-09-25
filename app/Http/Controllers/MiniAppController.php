<?php

namespace App\Http\Controllers;

use App\Http\Resources\PackResource;
use App\Http\Resources\StickerResource;
use App\Http\Resources\StickersFavoriteResource;
use App\Http\Resources\StickersHistoryResource;
use App\Http\Resources\UserResource;
use App\Models\Pack;
use App\Models\Sticker;
use App\Models\StickersFavorite;
use App\Models\StickersHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image as ImageFacade;
use SergiX44\Nutgram\Nutgram;
use SergiX44\Nutgram\Telegram\Types\Internal\InputFile;
use function App\Helpers\miniAppUser;
use function App\Helpers\stats;

class MiniAppController extends Controller
{
    public function stickerizer(Request $request)
    {
        return view('webapp.main', [
            'initData' => [
                'text' => $request->input('text'),
                'user_id' => $request->input('user_id'),
                'lang' => $request->input('lang', config('app.locale')),
                'fingerprint' => $request->input('fingerprint'),
            ]
        ]);
    }

    public function addStickers()
    {
        return view('webapp.addstickers', [
            'initData' => [
                'bot_username' => config('bot.username'),
            ],
        ]);
    }

    public function store(Request $request)
    {
        return view('webapp.store', [
            'initData' => [
                'user_id' => $request->input('user_id'),
                'lang' => $request->input('lang', config('app.locale')),
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

    public function pack(Pack $pack)
    {
        return new PackResource($pack);
    }

    public function addPack(Pack $pack)
    {
        $user = miniAppUser();
        $user->packs()->syncWithoutDetaching($pack->id);

        stats('pack.installed', ['pack' => $pack->id]);
    }

    public function removePack(Pack $pack)
    {
        $user = miniAppUser();
        $user->packs()->detach($pack->id);

        stats('pack.uninstalled', ['pack' => $pack->id]);
    }

    public function user()
    {
        $user = miniAppUser();

        return new UserResource($user);
    }

    public function sendSticker(Request $request, Nutgram $bot)
    {
        //get input
        $user = miniAppUser();
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
            chat_id: $user->id,
            disable_notification: true,
        );

        //save sticker data to cache
        Cache::put($message->message_id, [
            $message->sticker->file_id,
            $message->sticker->file_unique_id,
            $stickerID,
            $text
        ]);

        //return sticker id
        return ['telegram_sticker_id' => $message->message_id];
    }

    public function packs()
    {
        $packs = miniAppUser()
            ->packs()
            ->with('stickers')
            ->get();

        return PackResource::collection($packs);
    }

    public function trendingPacks()
    {
        $packs = Pack::query()
            ->with('stickers')
            ->get();

        return PackResource::collection($packs);
    }

    public function search(Request $request)
    {
        $user = miniAppUser();
        $tags = Str::of($request->input('search'))
            ->explode(' ')
            ->filter()
            ->values()
            ->toArray();

        $stickers = $user
            ->stickers()
            ->withAnyTagsOfAnyType($tags)
            ->get();

        return StickerResource::collection($stickers);
    }

    public function history()
    {
        $user = miniAppUser();
        $history = StickersHistory::query()
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        return StickersHistoryResource::collection($history);
    }

    public function clearHistory()
    {
        $user = miniAppUser();
        StickersHistory::query()
            ->where('user_id', $user->id)
            ->delete();

        stats('sticker.history.clear');
    }

    public function clearFavorite()
    {
        $user = miniAppUser();
        StickersFavorite::query()
            ->where('user_id', $user->id)
            ->delete();

        stats('sticker.favorite.clear');
    }

    public function getFavoriteStickers()
    {
        $user = miniAppUser();
        $favorites = StickersFavorite::query()
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        return StickersFavoriteResource::collection($favorites);
    }

    public function saveFavoriteSticker(Request $request)
    {
        $user = miniAppUser();
        $stickerID = (int)$request->input('sticker_id');

        StickersFavorite::create([
            'user_id' => $user->id,
            'sticker_id' => $stickerID,
            'text' => $request->input('text'),
        ]);

        stats('sticker.favorite.save', ['sticker_id' => $stickerID]);
    }

    public function removeFavoriteSticker(StickersFavorite $favorite)
    {
        $favorite->delete();

        stats('sticker.favorite.remove', ['sticker_id' => $favorite->sticker_id]);
    }
}
