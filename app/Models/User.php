<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use SergiX44\Nutgram\Telegram\Types\User\User as TelegramUser;

class User extends Model
{
    public $incrementing = false;
    protected static $unguarded = true;
    protected $casts = [
        'started_at' => 'datetime',
        'blocked_at' => 'datetime',
    ];

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
}
