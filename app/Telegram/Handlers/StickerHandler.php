<?php

namespace App\Telegram\Handlers;

use App\Models\StickerPackResolver;
use SergiX44\Nutgram\Nutgram;
use SergiX44\Nutgram\Telegram\Properties\ParseMode;
use function App\Helpers\message;
use function App\Helpers\stats;

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
                'stickerCount' => $sticker->pack->stickers()->count(),
                'installCount' => $sticker->pack->installs(),
                'url' => $sticker->pack->getShareUrl(),
            ]),
            parse_mode: ParseMode::HTML,
            reply_to_message_id: $bot->messageId(),
        );

        stats('pack.resolved', ['pack_id' => $sticker->pack->id]);
    }
}
