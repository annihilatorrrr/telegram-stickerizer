<?php

namespace App\Models;

use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Statistic extends Model
{
    protected static $unguarded = true;
    public $timestamps = false;
    protected $casts = [
        'collected_at' => 'datetime',
        'payload' => 'array',
    ];

    public static function getStatsForBot(): array
    {
        $date = CarbonImmutable::now();

        // stickers sent
        $stickersSentToday = self::query()
            ->whereBetween('collected_at', [$date->startOfDay(), $date->endOfDay()])
            ->where('action', 'sticker.sent')
            ->count();
        $stickersSentWeek = self::query()
            ->whereBetween('collected_at', [$date->startOfWeek(), $date->endOfWeek()])
            ->where('action', 'sticker.sent')
            ->count();
        $stickersSentMonth = self::query()
            ->whereBetween('collected_at', [$date->startOfMonth(), $date->endOfMonth()])
            ->where('action', 'sticker.sent')
            ->count();
        $stickersSentYear = self::query()
            ->whereBetween('collected_at', [$date->startOfYear(), $date->endOfYear()])
            ->where('action', 'sticker.sent')
            ->count();
        $stickersSentTotal = self::query()
            ->where('action', 'sticker.sent')
            ->count();

        // add old stats from old bot version
        $stickersSentTotal += 1_630_754;

        //active users
        $activeUsersToday = self::query()
            ->distinct()
            ->whereBetween('collected_at', [$date->startOfDay(), $date->endOfDay()])
            ->count('user_id');
        $activeUsersWeek = self::query()
            ->distinct()
            ->whereBetween('collected_at', [$date->startOfWeek(), $date->endOfWeek()])
            ->count('user_id');
        $activeUsersMonth = self::query()
            ->distinct()
            ->whereBetween('collected_at', [$date->startOfMonth(), $date->endOfMonth()])
            ->count('user_id');
        $activeUsersYear = self::query()
            ->distinct()
            ->whereBetween('collected_at', [$date->startOfYear(), $date->endOfYear()])
            ->count('user_id');

        // users
        $usersToday = User::whereBetween('created_at', [$date->startOfDay(), $date->endOfDay()])->count();
        $usersWeek = User::whereBetween('created_at', [$date->startOfWeek(), $date->endOfWeek()])->count();
        $usersMonth = User::whereBetween('created_at', [$date->startOfMonth(), $date->endOfMonth()])->count();
        $usersYear = User::whereBetween('created_at', [$date->startOfYear(), $date->endOfYear()])->count();
        $usersTotal = User::count();

        return [
            'stickersSentToday' => number_format($stickersSentToday, thousands_separator: '˙'),
            'stickersSentWeek' => number_format($stickersSentWeek, thousands_separator: '˙'),
            'stickersSentMonth' => number_format($stickersSentMonth, thousands_separator: '˙'),
            'stickersSentYear' => number_format($stickersSentYear, thousands_separator: '˙'),
            'stickersSentTotal' => number_format($stickersSentTotal, thousands_separator: '˙'),
            'activeUsersToday' => number_format($activeUsersToday, thousands_separator: '˙'),
            'activeUsersWeek' => number_format($activeUsersWeek, thousands_separator: '˙'),
            'activeUsersMonth' => number_format($activeUsersMonth, thousands_separator: '˙'),
            'activeUsersYear' => number_format($activeUsersYear, thousands_separator: '˙'),
            'usersToday' => number_format($usersToday, thousands_separator: '˙'),
            'usersWeek' => number_format($usersWeek, thousands_separator: '˙'),
            'usersMonth' => number_format($usersMonth, thousands_separator: '˙'),
            'usersYear' => number_format($usersYear, thousands_separator: '˙'),
            'usersTotal' => number_format($usersTotal, thousands_separator: '˙'),
            'lastUpdate' => now()->format('Y-m-d H:i:s e'),
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
