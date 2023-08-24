@lang('settings.title') > @lang('settings.language.title')<br>
@lang('settings.language.description')<br>
<br>
@if(isset($localization) && $localization !== '')
    @lang('settings.language.want') <a href="{{ $localization }}">@lang('common.click_here')</a>
@endif
