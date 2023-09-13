<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\App;
use Illuminate\Validation\Rule;
use Lukasss93\ModelSettings\Traits\HasSettingsTable;
use SergiX44\Nutgram\Telegram\Types\User\User as TelegramUser;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

class User extends Model
{
    use HasSettingsTable;
    use HasRelationships;

    public $incrementing = false;
    protected static $unguarded = true;
    protected $casts = [
        'started_at' => 'datetime',
        'blocked_at' => 'datetime',
    ];

    public bool $initSettings = true;

    public function defaultSettings(): array
    {
        return [
            'news' => [
                'enabled' => true,
                'notified_at' => null,
            ],
            'history' => true,
            'lang' => null,
        ];
    }

    public function settingsRules(): array
    {
        return [
            'news.enabled' => 'boolean',
            'history' => 'boolean',
            'lang' => [
                'nullable',
                'string',
                Rule::in(array_keys(config('languages')))
            ],
        ];
    }

    public function feedback(): HasMany
    {
        return $this->hasMany(Feedback::class);
    }

    public function statistics(): HasMany
    {
        return $this->hasMany(Statistic::class);
    }

    public static function findByTelegramUser(?TelegramUser $user): ?User
    {
        return self::find($user?->id);
    }

    public function packs(): BelongsToMany
    {
        return $this->belongsToMany(Pack::class)->withTimestamps();
    }

    public function stickers()
    {
        return $this->hasManyDeep(Sticker::class, ['pack_user', Pack::class]);
    }

    public function stickersHistory(): HasMany
    {
        return $this->hasMany(StickersHistory::class);
    }

    public function stickersFavorites(): HasMany
    {
        return $this->hasMany(StickersFavorite::class);
    }

    public function getGdprData(): array
    {
        return [
            ...$this->toArray(),
            'feedback' => $this->feedback->toArray(),
            'stickers_favorites' => $this->stickersFavorites->toArray(),
            'stickers_history' => $this->stickersHistory->toArray(),
            'statistics' => $this->statistics()
                ->selectRaw('action, count(action) as total')
                ->groupBy('action')
                ->pluck('total', 'action')
                ->toArray(),
        ];
    }

    public function hasNewsEnabled(): bool
    {
        return $this->settings()->get('news.enabled', true);
    }

    public function hasStickerHistoryEnabled(): bool
    {
        return $this->settings()->get('history', true);
    }

    public function markNewsAsNotified(): void
    {
        $this->settings()->set('news.notified_at', now()->toIso8601String());
    }

    public function isNewsAlreadyNotified(): bool
    {
        return $this->settings()->get('news.notified_at') !== null;
    }

    public function setLocale(): void
    {
        App::setLocale($this->getLocale());
    }

    public function getLocale(): string
    {
        //get lang from user settings
        $lang = $this->settings()->get('lang');

        //get lang from user
        $lang ??= $this->language_code;

        //get lang from app locale
        $lang ??= config('app.locale');

        return $lang;
    }
}
