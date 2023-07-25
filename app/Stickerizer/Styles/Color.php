<?php

namespace App\Stickerizer\Styles;

use Intervention\Image\Gd\Color as InterventionColor;

class Color extends InterventionColor
{
    public static function fromRgba(int $red, int $green, int $blue, int $alpha = 1): self
    {
        return new self([$red, $green, $blue, $alpha]);
    }
}
