<?php

namespace App\Stickerizer\Layers;

use App\Stickerizer\Styles\Color;
use App\Stickerizer\Styles\LayerPosition;
use App\Stickerizer\Styles\LayerSize;
use Intervention\Image\Image;
use JsonSerializable;
use Stringable;

abstract class StickerLayer implements JsonSerializable, Stringable
{
    protected LayerPosition $layerPosition;
    protected ?LayerSize $layerSize;
    protected bool $debug = false;

    public function __construct(
        LayerPosition $stickerPosition = new LayerPosition(0, 0),
        ?LayerSize $stickerSize = null
    ) {
        $this->layerPosition = $stickerPosition;
        $this->layerSize = $stickerSize;
    }

    public function handle(Image $canvas): void
    {
        $this->renderDebug($canvas);
    }

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

    protected function renderDebug(Image $canvas): void
    {
        if (!$this->debug) {
            return;
        }

        $canvas->rectangle(
            $this->layerPosition->x,
            $this->layerPosition->y,
            $this->layerPosition->x + $this->layerSize->width,
            $this->layerPosition->y + $this->layerSize->height,
            function ($draw) {
                $draw->border(3, Color::fromRgba(255, 0, 0)->getRgba());
            }
        );

        $canvas->text(
            sprintf("%s,%s", $this->layerPosition->x, $this->layerPosition->y),
            $this->layerPosition->x + 10,
            $this->layerPosition->y + 10,
            function ($font) {
                $font->file(resource_path('fonts/arial-unicode.ttf'));
                $font->size(12);
                $font->color('#ff0000');
                $font->align('left');
                $font->valign('top');
            });

        $canvas->text(
            $this->layerSize->width,
            $this->layerPosition->x + $this->layerSize->width - 10,
            $this->layerPosition->y + 10,
            function ($font) {
                $font->file(resource_path('fonts/arial-unicode.ttf'));
                $font->size(12);
                $font->color('#ff0000');
                $font->align('right');
                $font->valign('top');
            });

        $canvas->text(
            $this->layerSize->height,
            $this->layerPosition->x + 10,
            $this->layerPosition->y + $this->layerSize->height - 10,
            function ($font) {
                $font->file(resource_path('fonts/arial-unicode.ttf'));
                $font->size(12);
                $font->color('#ff0000');
                $font->align('left');
                $font->valign('bottom');
            });

        $canvas->text(
            'DEBUG MODE',
            $this->layerPosition->x + $this->layerSize->width - 10,
            $this->layerPosition->y + $this->layerSize->height - 10,
            function ($font) {
                $font->file(resource_path('fonts/arial-unicode.ttf'));
                $font->size(22);
                $font->color('#ff0000');
                $font->align('right');
                $font->valign('bottom');
            });
    }

    public function __toString(): string
    {
        return json_encode($this->jsonSerialize(), JSON_THROW_ON_ERROR);
    }
}
