<?php

namespace App\Telegram\Handlers;

use App\Models\Pack;
use App\Models\Sticker;
use App\Models\StickerPackResolver;
use App\Models\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use SergiX44\Nutgram\Nutgram;
use SergiX44\Nutgram\Telegram\Properties\ParseMode;
use SergiX44\Nutgram\Telegram\Types\Inline\InlineQueryResultArticle;
use SergiX44\Nutgram\Telegram\Types\Inline\InlineQueryResultCachedSticker;
use SergiX44\Nutgram\Telegram\Types\Inline\InlineQueryResultsButton;
use SergiX44\Nutgram\Telegram\Types\Input\InputTextMessageContent;
use SergiX44\Nutgram\Telegram\Types\WebApp\WebAppInfo;
use function App\Helpers\message;
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
                web_app: new WebAppInfo(route('webapp.stickerizer', [
                    'user_id' => $bot->userId(),
                    'fingerprint' => hash_hmac('sha256', $bot->userId(), config('app.key')),
                    'text' => $bot->inlineQuery()->query,
                    'lang' => App::getLocale(),
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

    public function chosenSticker(Nutgram $bot, string $messageID): void
    {
        //get user
        $user = $bot->get(User::class);

        //get sticker data
        [, $stickerFileUniqueID, $stickerID, $text] = Cache::get($messageID);

        //delete from cache
        Cache::delete($messageID);

        //delete sticker from private chat
        rescue(fn() => $bot->deleteMessage($bot->userId(), $messageID), report: false);

        //save sticker file id to resolvers table
        StickerPackResolver::create([
            'file_id' => $stickerFileUniqueID,
            'pack_id' => Sticker::find($stickerID)->pack_id,
        ]);

        //save sticker to user's history if enabled
        if ($user->hasStickerHistoryEnabled()) {
            $user->stickersHistory()->create([
                'sticker_id' => $stickerID,
                'text' => $text,
            ]);
        }

        //save stats
        stats('sticker.sent', ['sticker_id' => $stickerID]);
    }


    public function sharePack(Nutgram $bot, string $code)
    {
        $pack = Pack::firstWhere('code', $code);

        $results = [];

        if ($pack !== null) {
            $results = [
                InlineQueryResultArticle::make(
                    id: $pack->id,
                    title: $pack->name,
                    input_message_content: InputTextMessageContent::make(
                        message_text: message('pack', [
                            'name' => $pack->name,
                            'stickerCount' => $pack->stickers()->count(),
                            'installCount' => $pack->installs(),
                            'url' => $pack->getShareUrl(),
                        ]),
                        parse_mode: ParseMode::HTML,
                    ),
                    description: trans_choice('webapp.sticker_count', ['count' => $pack->stickers()->count()]),
                    thumbnail_url: $pack->getIconUrl()
                ),
            ];
        }

        $bot->answerInlineQuery(results: $results, cache_time: 0);
    }

    public function sharedPack(Nutgram $bot, string $code)
    {
        $pack = Pack::firstWhere('code', $code);

        if ($pack !== null) {
            stats('pack.shared', ['pack_id' => $pack->id]);
        }
    }
}
