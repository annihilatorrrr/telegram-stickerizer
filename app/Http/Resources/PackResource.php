<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use function Nutgram\Laravel\Support\webAppData;

/** @mixin \App\Models\Pack */
class PackResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $user = User::find(webAppData()?->user?->id ?? $request->input('user_id'));

        $userData = [];
        if ($user !== null) {
            $userData = [
                'installed' => $user->packs()->where('pack_id', $this->id)->exists(),
            ];
        }

        return [
            'id' => $this->id,
            'name' => $this->name,
            'code' => $this->code,
            'icon' => $this->getIconUrl(),
            'share_url' => $this->getShareUrl(),
            'stickers_count' => $this->stickers()->count(),
            'install_count' => $this->installs(),
            'stickers' => StickerResource::collection($this->stickers),
            ...$userData,
        ];
    }
}
