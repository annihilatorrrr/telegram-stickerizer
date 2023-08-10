<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\StickersHistory */
class StickersHistoryResource extends JsonResource
{
    public static $wrap = null;

    public function toArray(Request $request): array
    {
        return [
            'sticker_id' => $this->sticker_id,
            'text' => $this->text,
        ];
    }
}
