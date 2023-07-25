<?php

namespace App\Stickerizer\Styles;

class LayerPosition
{
    public int $x;
    public int $y;

    public function __construct(int $x, int $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    public static function make(int $x, int $y): self
    {
        return new self($x, $y);
    }
}
