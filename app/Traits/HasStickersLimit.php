<?php

namespace App\Traits;

trait HasStickersLimit
{
    protected const STICKER_LIMIT = 4;

    public static function bootHasStickersLimit()
    {
        static::created(function ($model) {
            //delete the same sticker except itself
            self::query()
                ->where('id', '!=', $model->id)
                ->where('user_id', $model->user_id)
                ->where('sticker_id', $model->sticker_id)
                ->where('text', $model->text)
                ->delete();

            //delete old history
            $totalRows = self::where('user_id', $model->user_id)->count();

            if ($totalRows <= self::STICKER_LIMIT) {
                return;
            }

            self::query()
                ->where('user_id', $model->user_id)
                ->oldest()
                ->take($totalRows - self::STICKER_LIMIT)
                ->delete();
        });
    }
}
