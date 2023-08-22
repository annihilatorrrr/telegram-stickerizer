<b>@lang('about.bot')</b><br>
@lang('about.name', ['value' => config('app.name')])<br>
@lang('about.username', ['value' => '@'.config('bot.username')])<br>
@lang('about.version', ['value' => config('app.version')])<br>
@lang('about.changelog', ['value' => sprintf('<a href="%s">%s</a>', config('bot.changelog'), __('common.open'))])<br>
<br>
<b>@lang('about.developer')</b><br>
@lang('about.name', ['value' => config('developer.name')])<br>
@lang('about.username', ['value' => config('developer.username')])<br>
@lang('about.email', ['value' => config('developer.email')])<br>
<br>
<b>@lang('about.links')</b><br>
@lang('about.news', ['value' => config('bot.channel.username')])<br>
@lang('about.support', ['value' => config('bot.support')])
