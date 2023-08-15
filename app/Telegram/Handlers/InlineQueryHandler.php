<?php

namespace App\Telegram\Handlers;

use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use SergiX44\Nutgram\Nutgram;
use SergiX44\Nutgram\Telegram\Types\Inline\InlineQueryResultCachedSticker;
use SergiX44\Nutgram\Telegram\Types\Inline\InlineQueryResultsButton;
use SergiX44\Nutgram\Telegram\Types\WebApp\WebAppInfo;
use function App\Helpers\stats;

class InlineQueryHandler
{
    public function input(Nutgram $bot): void
    {
        $bot->answerInlineQuery(
            results: [],
            cache_time: 0,
            button: InlineQueryResultsButton::make(
                text: __('inline.create'),
                web_app: new WebAppInfo(route('webapp.index', [
                    'text' => $bot->inlineQuery()->query,
                    'user_id' => $bot->userId(),
                    'lang' => $bot->user()->language_code,
                    'fingerprint' => hash_hmac('sha256', $bot->userId(), config('app.key')),
                ])),
            )
        );
    }

    public function result(Nutgram $bot, ?string $code): void
    {
        [$stickerFileID] = Cache::get($code);

        $bot->answerInlineQuery(
            results: [
                InlineQueryResultCachedSticker::make(
                    id: (string)time(),
                    sticker_file_id: $stickerFileID,
                ),
            ],
            cache_time: 0,
        );
    }

    public function chosen(Nutgram $bot): void
    {
        //get code
        $messageID = Str::after($bot->chosenInlineResult()->query, 'Ꜣ');

        //get sticker data
        [, $stickerID, $text] = Cache::get($messageID);

        //delete from cache
        Cache::delete($messageID);

        //delete sticker from private chat
        rescue(fn() => $bot->deleteMessage($bot->userId(), $messageID), report: false);

        //save sticker to user's history
        $bot->get(User::class)->stickersHistory()->create([
            'sticker_id' => $stickerID,
            'text' => $text,
        ]);

        //save stats
        stats('sticker.sent', ['sticker_id' => $stickerID]);
    }
}
