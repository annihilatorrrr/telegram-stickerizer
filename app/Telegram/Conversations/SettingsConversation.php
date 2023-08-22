<?php

namespace App\Telegram\Conversations;

use App\Models\User;
use SergiX44\Nutgram\Conversations\InlineMenu;
use SergiX44\Nutgram\Nutgram;
use SergiX44\Nutgram\Telegram\Properties\ParseMode;
use SergiX44\Nutgram\Telegram\Types\Keyboard\InlineKeyboardButton;
use function App\Helpers\message;
use function App\Helpers\stats;

class SettingsConversation extends InlineMenu
{
    protected int $userID;

    protected function getUser(): User
    {
        return User::find($this->userID);
    }

    public function start(Nutgram $bot)
    {
        $this->userID = $bot->userId();
        $user = $this->getUser();

        $user->initSettings();

        $this->clearButtons();
        $this->menuText(message('settings'), [
            'parse_mode' => ParseMode::HTML,
        ])
            ->addButtonRow(InlineKeyboardButton::make(
                text: trans('settings.news', [
                    'value' => $user->settings()->get('news.enabled', false) ?
                        trans('common.enabled') :
                        trans('common.disabled')
                ]),
                callback_data: 'settings.news@toggleNews'
            ))
            ->addButtonRow(InlineKeyboardButton::make(
                text: trans('settings.history', [
                    'value' => $user->settings()->get('history', false) ?
                        trans('common.enabled') :
                        trans('common.disabled')
                ]),
                callback_data: 'settings.history@toggleHistory'
            ))
            ->addButtonRow(
                InlineKeyboardButton::make(
                    text: trans('common.close'),
                    callback_data: 'settings.cancel@end'
                )
            )
            ->showMenu();
    }

    protected function toggleNews(Nutgram $bot): void
    {
        $this->getUser()->settings()->set('news.enabled', !$this->getUser()->settings()->get('news.enabled', false));

        stats('settings.news', ['status' => $this->getUser()->settings()->get('news.enabled')]);

        $this->start($bot);
    }

    protected function toggleHistory(Nutgram $bot): void
    {
        $this->getUser()->settings()->set('history', !$this->getUser()->settings()->get('history', false));

        stats('settings.history', ['status' => $this->getUser()->settings()->get('history')]);

        $this->start($bot);
    }
}
