<?php

namespace App\Http\Middleware;

use App\Facades\HashData;
use App\Models\User;
use App\Support\HashData\InvalidHashDataException;
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

        //validate initData via telegram
        try {
            $data = $this->bot->validateWebAppData($initData);

            $request->attributes->add([
                'webAppData' => $data,
                'user' => User::find($data->user?->id)
            ]);

            return $next($request);
        } catch (InvalidDataException) {
        }

        //validate initData via application
        try {
            $data = HashData::validate($initData);

            $request->attributes->add([
                'user' => User::find((int)$data['user_id'])
            ]);

            return $next($request);
        } catch (InvalidHashDataException) {
        }

        //invalid data
        return $this->handleInvalidData($request, $next);
    }

    protected function handleInvalidData(Request $request, Closure $next): mixed
    {
        abort(403);
    }
}
