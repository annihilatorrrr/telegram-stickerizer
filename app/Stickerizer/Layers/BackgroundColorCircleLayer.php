<?php

namespace App\Stickerizer\Layers;

use App\Stickerizer\Styles\Color;
use Intervention\Image\Image;

class BackgroundColorCircleLayer extends StickerLayer
{
    protected Color $color;

    public function __construct(Color $color)
    {
        parent::__construct();
        $this->color = $color;
    }

    public static function make(Color $color): self
    {
        return new self($color);
    }

    public static function fromArray(array $data): static
    {
        $layer = new static(new Color($data['color']));
        $layer->setLayerPosition($data['layerPosition']['x'], $data['layerPosition']['y']);
        if ($data['layerSize'] !== null) {
            $layer->setLayerSize($data['layerSize']['width'], $data['layerSize']['height']);
        }
        return $layer;
    }

    public function handle(Image $canvas): void
    {
        $canvas->ellipse(
            $this->layerSize->width,
            $this->layerSize->height,
            $this->layerPosition->x,
            $this->layerPosition->y,
            fn($draw) => $draw->background($this->color->getRgba())
        );

        parent::handle($canvas);
    }

    public function jsonSerialize(): array
    {
        return [
            'type' => static::class,
            'color' => $this->color->getArray(),
            'layerPosition' => [
                'x' => $this->layerPosition->x,
                'y' => $this->layerPosition->y,
            ],
            'layerSize' => $this->layerSize === null ? null : [
                'width' => $this->layerSize->width,
                'height' => $this->layerSize->height,
            ],
        ];
    }
}
