<?php

namespace App\Casts;

use App\Stickerizer\Layers\BackgroundColorLayer;
use App\Stickerizer\Layers\BackgroundImageLayer;
use App\Stickerizer\Layers\InputTextLayer;
use App\Stickerizer\Layers\StaticTextLayer;
use App\Stickerizer\Layers\StickerLayer;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;
use InvalidArgumentException;

class StickerLayers implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param array<string, mixed> $attributes
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        $layers = json_decode($value, true, flags: JSON_THROW_ON_ERROR);

        if (!is_array($layers)) {
            throw new InvalidArgumentException('Sticker layers must be an array');
        }

        return collect($layers)
            ->map(fn(array $layer) => match ($layer['type']) {
                BackgroundColorLayer::class => BackgroundColorLayer::fromArray($layer),
                BackgroundImageLayer::class => BackgroundImageLayer::fromArray($layer),
                InputTextLayer::class => InputTextLayer::fromArray($layer),
                StaticTextLayer::class => StaticTextLayer::fromArray($layer),
            })
            ->toArray();
    }

    /**
     * Prepare the given value for storage.
     *
     * @param array<string, mixed> $attributes
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        if (!is_array($value)) {
            throw new InvalidArgumentException('Sticker layers must be an array');
        }

        foreach ($value as $layer) {
            if (!($layer instanceof StickerLayer)) {
                throw new InvalidArgumentException('Sticker layers must be an array of StickerLayer');
            }
        }

        return json_encode($value, JSON_THROW_ON_ERROR);
    }
}
