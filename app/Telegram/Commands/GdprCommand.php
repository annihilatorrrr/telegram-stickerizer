<?php

namespace App\Telegram\Commands;

use App\Models\User;
use Illuminate\Support\Str;
use SergiX44\Nutgram\Handlers\Type\Command;
use SergiX44\Nutgram\Nutgram;
use SergiX44\Nutgram\Telegram\Types\Internal\InputFile;
use SergiX44\Nutgram\Telegram\Types\Keyboard\InlineKeyboardButton;
use SergiX44\Nutgram\Telegram\Types\Keyboard\InlineKeyboardMarkup;

class GdprCommand extends Command
{
    protected string $command = 'gdpr';

    protected ?string $description = 'Manage your GDPR data';

    public function handle(Nutgram $bot): void
    {
        $bot->sendMessage(
            text: 'Here you can manage your GDPR data.',
            reply_markup: InlineKeyboardMarkup::make()->addRow(
                InlineKeyboardButton::make('Download my data', callback_data: 'gdpr.download'),
            )
        );
    }

    public function downloadData(Nutgram $bot): void
    {
        $data = $bot->get(User::class)->getGdprData();
        $json = json_encode($data, JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT);
        $resource = Str::toResource($json);

        $bot->sendDocument(
            document: InputFile::make($resource, 'user_data.json'),
            caption: 'This file contains all your saved data.',
        );
    }
}
