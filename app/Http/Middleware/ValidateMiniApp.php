<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use SergiX44\Nutgram\Exception\InvalidDataException;
use SergiX44\Nutgram\Nutgram;

class ValidateMiniApp
{
    public function __construct(protected Nutgram $bot)
    {
    }

    public function handle(Request $request, Closure $next)
    {
        //inputs
        $initData = $request->input('initData') ?: '';
        $fingerprint = $request->input('fingerprint');
        $user_id = $request->input('user_id');

        //validate via initData
        try {
            $data = $this->bot->validateWebAppData($initData);

            $request->attributes->add([
                'webAppData' => $data,
                'user' => User::find($data->user?->id)
            ]);

            return $next($request);
        } catch (InvalidDataException) {
        }

        //validate via fingerprint
        if ($fingerprint === hash_hmac('sha256', $user_id, config('app.key'))) {
            $request->attributes->add(['user' => User::find((int)$user_id)]);

            return $next($request);
        }

        //invalid data
        return $this->handleInvalidData($request, $next);
    }

    protected function handleInvalidData(Request $request, Closure $next): mixed
    {
        abort(403);
    }
}
