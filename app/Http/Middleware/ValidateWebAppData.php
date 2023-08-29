<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use OxMohsen\TgBot\Validate;

class ValidateWebAppData
{
    public function handle(Request $request, Closure $next)
    {
        $initData = $request->input('initData', '');

        if (!Validate::isSafe(config('nutgram.token'), $initData)) {
            abort(403);
        }

        return $next($request);
    }
}
