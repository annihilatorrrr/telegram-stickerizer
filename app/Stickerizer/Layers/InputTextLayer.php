<?php

namespace App\Stickerizer\Layers;

use App\Stickerizer\Styles\Color;
use App\Stickerizer\Styles\HorizontalAlignment;
use App\Stickerizer\Styles\VerticalAlignment;
use GDText\Box;
use GDText\TextWrapping;
use Intervention\Image\Facades\Image as ImageFacade;
use Intervention\Image\Image;

class InputTextLayer extends StickerLayer
{
    protected ?string $text = null;

    protected Color $fontColor;
    protected ?int $fontSize;
    protected ?string $fontFamily;

    protected int $strokeSize;
    protected Color $strokeColor;

    protected Color $shadowColor;
    protected int $shadowOffsetX;
    protected int $shadowOffsetY;

    protected HorizontalAlignment $horizontalAlignment;
    protected VerticalAlignment $verticalAlignment;

    protected float $lineHeight;
    protected bool $wrap;
    protected float $baseLine;
    protected int $angle;

    public function __construct(
        Color $fontColor = new Color([255, 255, 255]),
        ?int $fontSize = null,
        ?string $fontFamily = null,
        int $strokeSize = 0,
        Color $strokeColor = new Color([0, 0, 0]),
        Color $shadowColor = new Color([0, 0, 0]),
        int $shadowOffsetX = 0,
        int $shadowOffsetY = 0,
        HorizontalAlignment $horizontalAlignment = HorizontalAlignment::CENTER,
        VerticalAlignment $verticalAlignment = VerticalAlignment::MIDDLE,
        float $lineHeight = 1,
        bool $wrap = true,
        float $baseLine = 0.2,
        int $angle = 0,
    ) {
        parent::__construct();

        $this->fontColor = $fontColor;
        $this->fontSize = $fontSize;
        $this->fontFamily = $fontFamily ?? resource_path('fonts/OpenSansEmoji.ttf');

        $this->strokeSize = $strokeSize;
        $this->strokeColor = $strokeColor;

        $this->shadowColor = $shadowColor;
        $this->shadowOffsetX = $shadowOffsetX;
        $this->shadowOffsetY = $shadowOffsetY;

        $this->horizontalAlignment = $horizontalAlignment;
        $this->verticalAlignment = $verticalAlignment;

        $this->lineHeight = $lineHeight;
        $this->wrap = $wrap;
        $this->baseLine = $baseLine;
        $this->angle = $angle;
    }

    public static function make(
        Color $fontColor = new Color([255, 255, 255]),
        ?int $fontSize = null,
        ?string $fontFamily = null,
        int $strokeSize = 0,
        Color $strokeColor = new Color([0, 0, 0]),
        Color $shadowColor = new Color([0, 0, 0]),
        int $shadowOffsetX = 0,
        int $shadowOffsetY = 0,
        HorizontalAlignment $horizontalAlignment = HorizontalAlignment::CENTER,
        VerticalAlignment $verticalAlignment = VerticalAlignment::MIDDLE,
        float $lineHeight = 1,
        bool $wrap = true,
        float $baseLine = 0.2,
        int $angle = 0,
    ): static {
        return new static(
            fontColor: $fontColor,
            fontSize: $fontSize,
            fontFamily: $fontFamily,
            strokeSize: $strokeSize,
            strokeColor: $strokeColor,
            shadowColor: $shadowColor,
            shadowOffsetX: $shadowOffsetX,
            shadowOffsetY: $shadowOffsetY,
            horizontalAlignment: $horizontalAlignment,
            verticalAlignment: $verticalAlignment,
            lineHeight: $lineHeight,
            wrap: $wrap,
            baseLine: $baseLine,
            angle: $angle,
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
        $layer = ImageFacade::canvas($canvas->getWidth(), $canvas->getHeight());
        $layerCore = $layer->getCore();

        //initialize box
        $box = new Box($layerCore);
        $box->setBox(
            x: $this->layerPosition->x,
            y: $this->layerPosition->y,
            width: $this->layerSize->width,
            height: $this->layerSize->height,
        );

        //set font style
        $box->setFontFace($this->fontFamily);
        if ($this->fontSize !== null) {
            $box->setFontSize($this->fontSize);
        }
        $box->setFontColor(new \GDText\Color(
            red: $this->fontColor->r,
            green: $this->fontColor->g,
            blue: $this->fontColor->b,
            alpha: $this->fontColor->a,
        ));

        //set stroke style
        $box->setStrokeSize($this->strokeSize);
        $box->setStrokeColor(new \GDText\Color(
            red: $this->strokeColor->r,
            green: $this->strokeColor->g,
            blue: $this->strokeColor->b,
            alpha: $this->strokeColor->a,
        ));

        //set shadow style
        if ($this->shadowOffsetX > 0 || $this->shadowOffsetY > 0) {
            $box->setTextShadow(
                color: new \GDText\Color(
                    red: $this->shadowColor->r,
                    green: $this->shadowColor->g,
                    blue: $this->shadowColor->b,
                    alpha: $this->shadowColor->a,
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

        //set baseline
        $box->setBaseLine($this->baseLine);

        //set angle
        $box->setAngle($this->angle);

        //write text
        if ($this->fontSize !== null) {
            $box->draw($this->text);
        } else {
            $box->drawFitFontSize($this->text, 20, 500, 20);
        }

        //handle layer
        $canvas->insert($layer, 'top-left', 0, 0);

        parent::handle($canvas);
    }

    public function jsonSerialize(): array
    {
        return [
            'type' => static::class,
            'text' => $this->text,
            'fontColor' => $this->fontColor->getArray(),
            'fontSize' => $this->fontSize,
            'fontFamily' => $this->fontFamily,
            'strokeSize' => $this->strokeSize,
            'strokeColor' => $this->strokeColor->getArray(),
            'shadowColor' => $this->shadowColor->getArray(),
            'shadowOffsetX' => $this->shadowOffsetX,
            'shadowOffsetY' => $this->shadowOffsetY,
            'horizontalAlignment' => $this->horizontalAlignment->value,
            'verticalAlignment' => $this->verticalAlignment->value,
            'lineHeight' => $this->lineHeight,
            'wrap' => $this->wrap,
            'baseLine' => $this->baseLine,
            'angle' => $this->angle,
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

    public static function fromArray(array $data): static
    {
        $layer = new static(
            fontColor: new Color($data['fontColor']),
            fontSize: $data['fontSize'],
            fontFamily: $data['fontFamily'],
            strokeSize: $data['strokeSize'],
            strokeColor: new Color($data['strokeColor']),
            shadowColor: new Color($data['shadowColor']),
            shadowOffsetX: $data['shadowOffsetX'],
            shadowOffsetY: $data['shadowOffsetY'],
            horizontalAlignment: HorizontalAlignment::from($data['horizontalAlignment']),
            verticalAlignment: VerticalAlignment::from($data['verticalAlignment']),
            lineHeight: $data['lineHeight'],
            wrap: $data['wrap'],
            baseLine: $data['baseLine'],
            angle: $data['angle'],
        );
        $layer->setText($data['text']);
        $layer->setLayerPosition($data['layerPosition']['x'], $data['layerPosition']['y']);
        if ($data['layerSize'] !== null) {
            $layer->setLayerSize($data['layerSize']['width'], $data['layerSize']['height']);
        }
        return $layer;
    }
}
