<?php

namespace App\Telegram\Handlers;

use App\Models\StickerPackResolver;
use SergiX44\Nutgram\Nutgram;
use SergiX44\Nutgram\Telegram\Properties\ParseMode;
use function App\Helpers\message;

class StickerHandler
{
    public function __invoke(Nutgram $bot): void
    {
        $sticker = StickerPackResolver::where('file_id', $bot->message()->sticker->file_unique_id)->first();

        if ($sticker === null) {
            return;
        }

        $bot->sendMessage(
            text: message('pack', [
                'name' => $sticker->pack->name,
                'count' => $sticker->pack->stickers()->count(),
                'url' => $sticker->pack->getShareUrl(),
            ]),
            parse_mode: ParseMode::HTML,
            reply_to_message_id: $bot->messageId(),
        );
    }
}
