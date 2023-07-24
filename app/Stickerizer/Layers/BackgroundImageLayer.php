<?php

namespace App\Stickerizer\Layers;

use Intervention\Image\Facades\Image as ImageFacade;
use Intervention\Image\Image;

class BackgroundImageLayer extends StickerLayer
{
    protected string $path;
    protected int $opacity;

    public function __construct(string $path, int $opacity = 100)
    {
        parent::__construct();
        $this->path = $path;
        $this->opacity = $opacity;
    }

    public static function make(string $path, int $opacity = 100): self
    {
        return new self($path, $opacity);
    }

    public static function fromArray(array $data): static
    {
        return new static(
            path: $data['path'],
            opacity: $data['opacity']
        );
    }

    public function handle(Image $canvas): void
    {
        $layer = imagecreatefrompng($this->path);
        imagealphablending($layer, false);
        imagesavealpha($layer, true);
        imagefilter($layer, IMG_FILTER_COLORIZE, 0, 0, 0, 127 * (1 - ($this->opacity / 100)));

        $layer = ImageFacade::make($layer)->resize($this->layerSize->width, $this->layerSize->height);

        $canvas->insert($layer, 'top-left', $this->layerPosition->x, $this->layerPosition->y);
    }

    public function jsonSerialize(): array
    {
        return [
            'type' => static::class,
            'path' => $this->path,
            'opacity' => $this->opacity,
        ];
    }
}
