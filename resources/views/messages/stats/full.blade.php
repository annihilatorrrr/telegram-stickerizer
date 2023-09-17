<b>@lang('stats.title')</b><br>
<br>
@lang('stats.stickers_sent')<br>
@lang('stats.range.today', ['value' => $stickersSentToday])<br>
@lang('stats.range.week', ['value' => $stickersSentWeek])<br>
@lang('stats.range.month', ['value' => $stickersSentMonth])<br>
@lang('stats.range.year', ['value' => $stickersSentYear])<br>
@lang('stats.range.total', ['value' => $stickersSentTotal])<br>
<br>
@lang('stats.active_users')<br>
@lang('stats.range.today', ['value' => $activeUsersToday])<br>
@lang('stats.range.week', ['value' => $activeUsersWeek])<br>
@lang('stats.range.month', ['value' => $activeUsersMonth])<br>
@lang('stats.range.year', ['value' => $activeUsersYear])<br>
<br>
@lang('stats.users')<br>
@lang('stats.range.today', ['value' => $usersToday])<br>
@lang('stats.range.week', ['value' => $usersWeek])<br>
@lang('stats.range.month', ['value' => $usersMonth])<br>
@lang('stats.range.year', ['value' => $usersYear])<br>
@lang('stats.range.total', ['value' => $usersTotal])<br>
<br>
@lang('stats.last_update')<br>
{{ $lastUpdate }}
