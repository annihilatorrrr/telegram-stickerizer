<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use function App\Helpers\miniAppUser;

/** @mixin \App\Models\Pack */
class PackResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $user = miniAppUser();

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
