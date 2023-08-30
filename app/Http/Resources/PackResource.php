<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Pack */
class PackResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $user = User::find($request->input('user_id'));

        $userData = [];
        if ($user !== null) {
            $userData = [
                'installed' => $user->packs()->where('pack_id', $this->id)->exists(),
            ];
        }

        return [
            'id' => $this->id,
            'name' => $this->name,
            'icon' => route('webapp.sticker.preview', [
                'sticker' => $this->stickers->first()->id,
                'text' => 'T',
            ]),
            'share_url' => $this->getShareUrl(),
            'stickers_count' => $this->stickers()->count(),
            'stickers' => StickerResource::collection($this->stickers),
            ...$userData,
        ];
    }
}
