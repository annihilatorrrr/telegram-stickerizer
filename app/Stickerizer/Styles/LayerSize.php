<?php

namespace App\Stickerizer\Styles;

class LayerSize
{
    public int $width;
    public int $height;

    public function __construct(int $width, int $height)
    {
        $this->width = $width;
        $this->height = $height;
    }

    public static function make(int $width, int $height): self
    {
        return new self($width, $height);
    }
}
