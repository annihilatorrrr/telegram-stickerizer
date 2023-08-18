<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Lukasss93\ModelSettings\Traits\HasSettingsTable;
use SergiX44\Nutgram\Telegram\Types\User\User as TelegramUser;

class User extends Model
{
    use HasSettingsTable;

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
            'news' => true,
            'history' => true,
        ];
    }

    public function settingsRules(): array
    {
        return [
            'news' => 'boolean',
            'history' => 'boolean',
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
}
