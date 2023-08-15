<?php

namespace App\Telegram\Commands;

use App\Models\User;
use Illuminate\Support\Str;
use SergiX44\Nutgram\Handlers\Type\Command;
use SergiX44\Nutgram\Nutgram;
use SergiX44\Nutgram\Telegram\Types\Internal\InputFile;
use SergiX44\Nutgram\Telegram\Types\Keyboard\InlineKeyboardButton;
use SergiX44\Nutgram\Telegram\Types\Keyboard\InlineKeyboardMarkup;
use function App\Helpers\stats;

class GdprCommand extends Command
{
    protected string $command = 'gdpr';

    protected ?string $description = 'Manage your GDPR data';

    public function handle(Nutgram $bot): void
    {
        $bot->sendMessage(
            text: __('gdpr.description'),
            reply_markup: InlineKeyboardMarkup::make()->addRow(
                InlineKeyboardButton::make(__('gdpr.download.button'), callback_data: 'gdpr.download'),
            )
        );

        stats('command.gdpr');
    }

    public function downloadData(Nutgram $bot): void
    {
        $data = $bot->get(User::class)->getGdprData();
        $json = json_encode(
            value: $data,
            flags: JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE
        );

        $bot->sendDocument(
            document: InputFile::make(Str::toResource($json), 'user_data.json'),
            caption: __('gdpr.download.caption'),
        );

        stats('command.gdpr.download');

        $bot->answerCallbackQuery();
    }
}
