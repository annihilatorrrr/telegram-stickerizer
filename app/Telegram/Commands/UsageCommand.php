<?php

namespace App\Telegram\Commands;

use Illuminate\Support\Facades\Cache;
use SergiX44\Nutgram\Nutgram;
use SergiX44\Nutgram\Handlers\Type\Command;
use SergiX44\Nutgram\Telegram\Properties\ChatAction;
use SergiX44\Nutgram\Telegram\Types\Internal\InputFile;

class UsageCommand extends Command
{
    protected string $command = 'usage';

    protected ?string $description = 'How do I use this bot?';

    public function handle(Nutgram $bot): void
    {
        if(Cache::has('usage_file_id')){
            $bot->sendVideo(Cache::get('usage_file_id'));
            return;
        }

        $video = InputFile::make(resource_path('video/usage.mp4'));
        $bot->sendChatAction(ChatAction::UPLOAD_VIDEO);
        $message = $bot->sendVideo($video);
        Cache::put('usage_file_id', $message?->video->file_id);
    }
}
