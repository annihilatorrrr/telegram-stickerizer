<?php

namespace App\Stickerizer;

use App\Stickerizer\Exceptions\DuplicatedInputTextLayerFound;
use App\Stickerizer\Exceptions\InvalidStickerSize;
use App\Stickerizer\Exceptions\NoInputTextLayerFound;
use App\Stickerizer\Exceptions\TooManyLayersFound;
use App\Stickerizer\Layers\InputTextLayer;
use App\Stickerizer\Layers\StickerLayer;
use Illuminate\Support\Collection;
use Intervention\Image\Facades\Image as ImageFacade;
use Intervention\Image\Image;

class StickerGenerator
{
    protected const SIDE_LIMIT = 512;

    /**
     * Maximum number of layers allowed
     * @var int
     */
    protected const LAYERS_LIMIT = 10;

    /**
     * Canvas width
     * @var int
     */
    protected int $width;

    /**
     * Canvas height
     * @var int
     */
    protected int $height;

    /**
     * Sticker layers
     * @var Collection<StickerLayer>
     */
    protected Collection $layers;

    public function __construct(int $width, int $height)
    {
        $this->width = $width;
        $this->height = $height;
        $this->layers = collect();
    }

    public static function make(int $width, int $height): self
    {
        return new self($width, $height);
    }

    /**
     * Add a layer to the canvas
     * @param StickerLayer $layer
     * @return $this
     */
    public function addLayer(StickerLayer $layer): self
    {
        $this->layers[] = $layer;

        return $this;
    }

    /**
     * Add multiple layers to the canvas
     * @param StickerLayer[] $layers
     * @return $this
     */
    public function addLayers(array $layers): self
    {
        $this->layers = $this->layers->merge($layers);

        return $this;
    }

    /**
     * Validate the layers
     * @return void
     * @throws DuplicatedInputTextLayerFound
     * @throws InvalidStickerSize
     * @throws NoInputTextLayerFound
     * @throws TooManyLayersFound
     */
    protected function validate(): void
    {
        if ($this->width !== self::SIDE_LIMIT && $this->height !== self::SIDE_LIMIT) {
            throw new InvalidStickerSize();
        }

        $inputTextLayerCount = $this->layers
            ->filter(fn(StickerLayer $layer) => $layer::class === InputTextLayer::class)
            ->count();

        if ($inputTextLayerCount === 0) {
            throw new NoInputTextLayerFound();
        }

        if ($inputTextLayerCount > 1) {
            throw new DuplicatedInputTextLayerFound();
        }

        if ($this->layers->count() > self::LAYERS_LIMIT) {
            throw new TooManyLayersFound();
        }
    }

    public function generate(string $text): Image
    {
        $this->validate();

        $canvas = ImageFacade::canvas($this->width, $this->height);

        foreach ($this->layers as $layer) {

            $layer->applyLayerSizeIfNeeded($canvas);

            if ($layer::class === InputTextLayer::class) {
                $layer->setText($text);
            }

            $layer->handle($canvas);
        }

        return $canvas;
    }
}
