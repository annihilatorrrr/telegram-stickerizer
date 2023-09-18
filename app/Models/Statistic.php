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
        $stickersSentYesterday = self::query()
            ->whereBetween('collected_at', [$date->subDay()->startOfDay(), $date->subDay()->endOfDay()])
            ->where('action', 'sticker.sent')
            ->count();
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
        $activeUsersYesterday = self::query()
            ->distinct()
            ->whereBetween('collected_at', [$date->subDay()->startOfDay(), $date->subDay()->endOfDay()])
            ->count('user_id');
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
        $usersYesterday = User::whereBetween('created_at',
            [$date->subDay()->startOfDay(), $date->subDay()->endOfDay()])->count();
        $usersToday = User::whereBetween('created_at', [$date->startOfDay(), $date->endOfDay()])->count();
        $usersWeek = User::whereBetween('created_at', [$date->startOfWeek(), $date->endOfWeek()])->count();
        $usersMonth = User::whereBetween('created_at', [$date->startOfMonth(), $date->endOfMonth()])->count();
        $usersYear = User::whereBetween('created_at', [$date->startOfYear(), $date->endOfYear()])->count();
        $usersTotal = User::count();

        return [
            'stickers_sent' => [
                'yesterday' => number_format($stickersSentYesterday, thousands_separator: '˙'),
                'today' => number_format($stickersSentToday, thousands_separator: '˙'),
                'week' => number_format($stickersSentWeek, thousands_separator: '˙'),
                'month' => number_format($stickersSentMonth, thousands_separator: '˙'),
                'year' => number_format($stickersSentYear, thousands_separator: '˙'),
                'total' => number_format($stickersSentTotal, thousands_separator: '˙'),
            ],
            'active_users' => [
                'yesterday' => number_format($activeUsersYesterday, thousands_separator: '˙'),
                'today' => number_format($activeUsersToday, thousands_separator: '˙'),
                'week' => number_format($activeUsersWeek, thousands_separator: '˙'),
                'month' => number_format($activeUsersMonth, thousands_separator: '˙'),
                'year' => number_format($activeUsersYear, thousands_separator: '˙'),
            ],
            'users' => [
                'yesterday' => number_format($usersYesterday, thousands_separator: '˙'),
                'today' => number_format($usersToday, thousands_separator: '˙'),
                'week' => number_format($usersWeek, thousands_separator: '˙'),
                'month' => number_format($usersMonth, thousands_separator: '˙'),
                'year' => number_format($usersYear, thousands_separator: '˙'),
                'total' => number_format($usersTotal, thousands_separator: '˙'),
            ],
            'lastUpdate' => now()->format('Y-m-d H:i:s e'),
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
