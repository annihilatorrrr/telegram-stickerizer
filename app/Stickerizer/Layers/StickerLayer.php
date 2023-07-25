<?php

namespace App\Stickerizer\Layers;

use App\Stickerizer\Styles\LayerPosition;
use App\Stickerizer\Styles\LayerSize;
use Intervention\Image\Image;
use JsonSerializable;

abstract class StickerLayer implements JsonSerializable
{
    protected LayerPosition $layerPosition;
    protected ?LayerSize $layerSize;

    public function __construct(
        LayerPosition $stickerPosition = new LayerPosition(0, 0),
        ?LayerSize $stickerSize = null
    ) {
        $this->layerPosition = $stickerPosition;
        $this->layerSize = $stickerSize;
    }

    abstract public function handle(Image $canvas): void;

    public function setLayerPosition(int $x, int $y): self
    {
        $this->layerPosition = LayerPosition::make($x, $y);
        return $this;
    }

    public function setLayerSize(int $width, int $height): self
    {
        $this->layerSize = LayerSize::make($width, $height);
        return $this;
    }

    public function setLayerControl(int $x, int $y, int $width, int $height): self
    {
        $this->setLayerPosition($x, $y);
        $this->setLayerSize($width, $height);
        return $this;
    }

    public function applyLayerSizeIfNeeded(Image $canvas): void
    {
        if ($this->layerSize !== null) {
            return;
        }

        $this->layerSize = LayerSize::make($canvas->width(), $canvas->height());
    }

    abstract public static function fromArray(array $data): static;
}
