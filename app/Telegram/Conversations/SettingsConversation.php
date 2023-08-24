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
        $this->menuText(message('settings.main'), [
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
            ->addButtonRow(InlineKeyboardButton::make(
                text: trans('settings.language.value', [
                    'value' => match ($user->settings()->get('lang')) {
                        null => trans('common.auto'),
                        default => config('languages')[$user->settings()->get('lang')] ?? 'unknown',
                    }
                ]),
                callback_data: 'settings.language@openLanguagePage'
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

    protected function openLanguagePage(Nutgram $bot): void
    {
        $this
            ->clearButtons()
            ->menuText(message('settings.language', [
                'localization' => config('bot.localization'),
            ]), [
                'parse_mode' => ParseMode::HTML,
                'disable_web_page_preview' => true,
            ]);

        $this->addButtonRow(InlineKeyboardButton::make(trans('common.auto'),
            callback_data: 'languages:auto@setLanguage'));

        collect(config('languages'))
            ->map(fn($item, $key) => InlineKeyboardButton::make($item, callback_data: "languages:$key@setLanguage"))
            ->chunk(2)
            ->each(fn($row) => $this->addButtonRow(...$row->values()));

        $this->addButtonRow(InlineKeyboardButton::make(trans('common.back'), callback_data: 'languages:back@start'));

        $this->showMenu();
    }

    protected function setLanguage(Nutgram $bot): void
    {
        [, $lang] = explode(':', $bot->callbackQuery()->data);
        $newLang = $lang === 'auto' ? null : $lang;

        $user = $this->getUser();
        $user->settings()->set('lang', $newLang);
        $user->setLocale();

        $this->start($bot);
    }
}
