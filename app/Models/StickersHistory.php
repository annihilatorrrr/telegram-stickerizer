<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StickersHistory extends Model
{
    protected const HISTORY_LIMIT = 4;
    protected static $unguarded = true;

    protected static function booted()
    {
        static::created(function (StickersHistory $history) {
            //delete same sticker except itself
            self::query()
                ->where('id', '!=', $history->id)
                ->where('user_id', $history->user_id)
                ->where('sticker_id', $history->sticker_id)
                ->where('text', $history->text)
                ->delete();

            //delete old history
            $totalRows = self::where('user_id', $history->user_id)->count();

            if ($totalRows <= self::HISTORY_LIMIT) {
                return;
            }

            self::query()
                ->where('user_id', $history->user_id)
                ->oldest()
                ->take($totalRows - self::HISTORY_LIMIT)
                ->delete();
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function sticker(): BelongsTo
    {
        return $this->belongsTo(Sticker::class);
    }
}
