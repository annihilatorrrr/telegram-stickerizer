<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\User */
class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'language' => $this->getLocale(),
            'started' => $this->started_at !== null,
            'active' => $this->blocked_at === null,
        ];
    }
}
