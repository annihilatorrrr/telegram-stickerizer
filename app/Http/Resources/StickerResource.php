<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Sticker */
class StickerResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'thumbnail' => route('webapp.sticker.preview', [
                'sticker' => $this->id,
                'text' => 'TEXT',
            ]),
        ];
    }
}
