<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Tags\HasTags;

class Pack extends Model
{
    use HasTags;

    protected static $unguarded = true;

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function stickers(): HasMany
    {
        return $this->hasMany(Sticker::class);
    }

    public function getShareUrl(): string
    {
        return sprintf('https://t.me/%s/addstickers?startapp=%s', config('bot.username'), $this->code);
    }

    public function getIconUrl(): string
    {
        return route('webapp.sticker.preview', [
            'sticker' => $this->stickers->first()->id,
            'text' => 'T',
        ]);
    }
}
