<?php

namespace App\Stickerizer\Layers;

use App\Stickerizer\Styles\Color;
use App\Stickerizer\Styles\HorizontalAlignment;
use App\Stickerizer\Styles\VerticalAlignment;
use GDText\Box;
use GDText\TextWrapping;
use Intervention\Image\Image;

class InputTextLayer extends StickerLayer
{
    protected string $text;

    protected Color $fontColor;
    protected ?int $fontSize;

    protected int $strokeSize;
    protected Color $strokeColor;

    protected HorizontalAlignment $horizontalAlignment;
    protected VerticalAlignment $verticalAlignment;

    protected float $lineHeight;
    protected bool $wrap;

    public function __construct(
        Color $fontColor = new Color([255, 255, 255]),
        ?int $fontSize = null,
        int $strokeSize = 0,
        Color $strokeColor = new Color([0, 0, 0]),
        HorizontalAlignment $horizontalAlignment = HorizontalAlignment::CENTER,
        VerticalAlignment $verticalAlignment = VerticalAlignment::MIDDLE,
        float $lineHeight = 1,
        bool $wrap = true,
    ) {
        parent::__construct();

        $this->fontColor = $fontColor;
        $this->fontSize = $fontSize;

        $this->strokeSize = $strokeSize;
        $this->strokeColor = $strokeColor;

        $this->horizontalAlignment = $horizontalAlignment;
        $this->verticalAlignment = $verticalAlignment;

        $this->lineHeight = $lineHeight;
        $this->wrap = $wrap;
    }

    public static function make(
        Color $fontColor = new Color([255, 255, 255]),
        ?int $fontSize = null,
        int $strokeSize = 0,
        Color $strokeColor = new Color([0, 0, 0]),
        HorizontalAlignment $horizontalAlignment = HorizontalAlignment::CENTER,
        VerticalAlignment $verticalAlignment = VerticalAlignment::MIDDLE,
        float $lineHeight = 1,
        bool $wrap = true,
    ): static {
        return new static(
            fontColor: $fontColor,
            fontSize: $fontSize,
            strokeSize: $strokeSize,
            strokeColor: $strokeColor,
            horizontalAlignment: $horizontalAlignment,
            verticalAlignment: $verticalAlignment,
            lineHeight: $lineHeight,
            wrap: $wrap,
        );
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function handle(Image $canvas): void
    {
        //create a new layer
        $layer = imagecreatetruecolor($canvas->getWidth(), $canvas->getHeight());
        imagesavealpha($layer, true);
        imagefill($layer, 0, 0, imagecolorallocatealpha($layer, 0, 0, 0, 127));

        //initialize box
        $box = new Box($layer);
        $box->setBox($this->layerPosition->x, $this->layerPosition->y, $this->layerSize->width,
            $this->layerSize->height);

        //set font style
        $box->setFontFace(resource_path('fonts/OpenSansEmoji.ttf'));
        if ($this->fontSize !== null) {
            $box->setFontSize($this->fontSize);
        }
        $box->setFontColor(new \GDText\Color($this->fontColor->r, $this->fontColor->g, $this->fontColor->b,
            $this->fontColor->a));

        //set stroke style
        $box->setStrokeSize($this->strokeSize);
        $box->setStrokeColor(new \GDText\Color($this->strokeColor->r, $this->strokeColor->g, $this->strokeColor->b,
            $this->strokeColor->a));

        //set text alignment
        $box->setTextAlign($this->horizontalAlignment->value, $this->verticalAlignment->value);

        //set line height
        $box->setLineHeight($this->lineHeight);

        //set wrap
        $box->setTextWrapping($this->wrap ? TextWrapping::WrapWithOverflow : TextWrapping::NoWrap);

        //write text
        if ($this->fontSize !== null) {
            $box->draw($this->text);
        } else {
            $box->drawFitFontSize($this->text, 20, 500, 20);
        }

        //handle layer
        $canvas->insert($layer, 'top-left', 0, 0);
    }
}
