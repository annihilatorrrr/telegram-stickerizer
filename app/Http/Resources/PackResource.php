<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Pack */
class PackResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'icon' => route('webapp.sticker.preview', [
                'sticker' => $this->stickers->first()->id,
                'text' => 'T',
            ]),
            'stickers' => StickerResource::collection($this->stickers),
        ];
    }
}
