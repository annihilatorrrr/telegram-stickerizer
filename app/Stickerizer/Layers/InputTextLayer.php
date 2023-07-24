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
    protected ?string $text = null;

    protected Color $fontColor;
    protected ?int $fontSize;

    protected int $strokeSize;
    protected Color $strokeColor;

    protected Color $shadowColor;
    protected int $shadowOffsetX;
    protected int $shadowOffsetY;

    protected HorizontalAlignment $horizontalAlignment;
    protected VerticalAlignment $verticalAlignment;

    protected float $lineHeight;
    protected bool $wrap;

    public function __construct(
        Color $fontColor = new Color([255, 255, 255]),
        ?int $fontSize = null,
        int $strokeSize = 0,
        Color $strokeColor = new Color([0, 0, 0]),
        Color $shadowColor = new Color([0, 0, 0]),
        int $shadowOffsetX = 0,
        int $shadowOffsetY = 0,
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

        $this->shadowColor = $shadowColor;
        $this->shadowOffsetX = $shadowOffsetX;
        $this->shadowOffsetY = $shadowOffsetY;

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
        Color $shadowColor = new Color([0, 0, 0]),
        int $shadowOffsetX = 0,
        int $shadowOffsetY = 0,
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
            shadowColor: $shadowColor,
            shadowOffsetX: $shadowOffsetX,
            shadowOffsetY: $shadowOffsetY,
            horizontalAlignment: $horizontalAlignment,
            verticalAlignment: $verticalAlignment,
            lineHeight: $lineHeight,
            wrap: $wrap,
        );
    }

    public function setText(?string $text): self
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
        $box->setStrokeColor(new \GDText\Color(
            red: $this->strokeColor->r,
            green: $this->strokeColor->g,
            blue: $this->strokeColor->b,
            alpha: $this->strokeColor->a
        ));

        //set shadow style
        if ($this->shadowOffsetX > 0 || $this->shadowOffsetY > 0) {
            $box->setTextShadow(
                color: new \GDText\Color(
                    red: $this->shadowColor->r,
                    green: $this->shadowColor->g,
                    blue: $this->shadowColor->b,
                    alpha: $this->shadowColor->a
                ),
                xShift: $this->strokeSize + $this->shadowOffsetX,
                yShift: $this->strokeSize + $this->shadowOffsetY,
            );
        }

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

    public function jsonSerialize(): array
    {
        return [
            'type' => static::class,
            'text' => $this->text,
            'fontColor' => $this->fontColor->getArray(),
            'fontSize' => $this->fontSize,
            'strokeSize' => $this->strokeSize,
            'strokeColor' => $this->strokeColor->getArray(),
            'shadowColor' => $this->shadowColor->getArray(),
            'shadowOffsetX' => $this->shadowOffsetX,
            'shadowOffsetY' => $this->shadowOffsetY,
            'horizontalAlignment' => $this->horizontalAlignment->value,
            'verticalAlignment' => $this->verticalAlignment->value,
            'lineHeight' => $this->lineHeight,
            'wrap' => $this->wrap,
        ];
    }

    public static function fromArray(array $data): static
    {
        $layer = new static(
            fontColor: new Color($data['fontColor']),
            fontSize: $data['fontSize'],
            strokeSize: $data['strokeSize'],
            strokeColor: new Color($data['strokeColor']),
            shadowColor: new Color($data['shadowColor']),
            shadowOffsetX: $data['shadowOffsetX'],
            shadowOffsetY: $data['shadowOffsetY'],
            horizontalAlignment: HorizontalAlignment::from($data['horizontalAlignment']),
            verticalAlignment: VerticalAlignment::from($data['verticalAlignment']),
            lineHeight: $data['lineHeight'],
            wrap: $data['wrap'],
        );
        $layer->setText($data['text']);
        return $layer;
    }
}
