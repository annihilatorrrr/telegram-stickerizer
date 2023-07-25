<?php

namespace App\Stickerizer\Layers;

use App\Stickerizer\Styles\Color;
use Intervention\Image\Facades\Image as ImageFacade;
use Intervention\Image\Image;

class BackgroundColorLayer extends StickerLayer
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
        return new static(new Color($data['color']));
    }

    public function handle(Image $canvas): void
    {
        $layer = ImageFacade::canvas($this->layerSize->width, $this->layerSize->height, $this->color->getRgba());

        $canvas->insert($layer, 'top-left', $this->layerPosition->x, $this->layerPosition->y);

        parent::handle($canvas);
    }

    public function jsonSerialize(): array
    {
        return [
            'type' => static::class,
            'color' => $this->color->getArray(),
        ];
    }
}
