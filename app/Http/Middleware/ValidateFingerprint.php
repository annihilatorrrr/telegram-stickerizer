<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ValidateFingerprint
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->input('fingerprint') !== hash_hmac('sha256', $request->input('user_id'), config('app.key'))) {
            abort(403);
        }

        return $next($request);
    }
}
