<?php

namespace Database\Seeders\BasePacks;

use App\Models\Pack;
use App\Stickerizer\Layers\BackgroundColorCircleLayer;
use App\Stickerizer\Layers\InputTextLayer;
use App\Stickerizer\Styles\Color;
use Illuminate\Database\Seeder;

class BackgroundColorCircleSeeder extends Seeder
{
    public function run(): void
    {
        $packCode = 'BackgroundColorCircle';

        $pack = Pack::updateOrCreate([
            'code' => $packCode,
        ], [
            'name' => 'Background Color (Circle)',
            'tags' => [
                'text-monochrome',
                'monochrome-text',
                'solid-background',
                'round',
                'circle',
                'round-background',
                'circle-background',
            ],
        ]);

        //BLACK
        $sticker = $pack->stickers()->updateOrCreate([
            'code' => sprintf('%s.%s', $packCode, 'black'),
        ], [
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundColorCircleLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerPosition(512 / 2, 512 / 2),
                InputTextLayer::make(Color::fromRgba(255, 255, 255))
                    ->setLayerControl(75, 75, 350, 350),
            ]
        ]);
        $sticker->syncTags(['black']);
        unset($sticker);

        //BLUE
        $sticker = $pack->stickers()->updateOrCreate([
            'code' => sprintf('%s.%s', $packCode, 'blue'),
        ], [
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundColorCircleLayer::make(Color::fromRgba(1, 0, 171))
                    ->setLayerPosition(512 / 2, 512 / 2),
                InputTextLayer::make(Color::fromRgba(255, 255, 255))
                    ->setLayerControl(75, 75, 350, 350),
            ]
        ]);
        $sticker->syncTags(['blue']);
        unset($sticker);

        //DARK GREEN
        $sticker = $pack->stickers()->updateOrCreate([
            'code' => sprintf('%s.%s', $packCode, 'dark-green'),
        ], [
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundColorCircleLayer::make(Color::fromRgba(0, 170, 1))
                    ->setLayerPosition(512 / 2, 512 / 2),
                InputTextLayer::make(Color::fromRgba(255, 255, 255))
                    ->setLayerControl(75, 75, 350, 350),
            ]
        ]);
        $sticker->syncTags(['dark-green']);
        unset($sticker);

        //CYAN
        $sticker = $pack->stickers()->updateOrCreate([
            'code' => sprintf('%s.%s', $packCode, 'cyan'),
        ], [
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundColorCircleLayer::make(Color::fromRgba(6, 164, 167))
                    ->setLayerPosition(512 / 2, 512 / 2),
                InputTextLayer::make(Color::fromRgba(255, 255, 255))
                    ->setLayerControl(75, 75, 350, 350),
            ]
        ]);
        $sticker->syncTags(['cyan']);
        unset($sticker);

        //DARK RED
        $sticker = $pack->stickers()->updateOrCreate([
            'code' => sprintf('%s.%s', $packCode, 'dark-red'),
        ], [
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundColorCircleLayer::make(Color::fromRgba(172, 0, 0))
                    ->setLayerPosition(512 / 2, 512 / 2),
                InputTextLayer::make(Color::fromRgba(255, 255, 255))
                    ->setLayerControl(75, 75, 350, 350),
            ]
        ]);
        $sticker->syncTags(['dark-red']);
        unset($sticker);

        //DARK MAGENTA
        $sticker = $pack->stickers()->updateOrCreate([
            'code' => sprintf('%s.%s', $packCode, 'dark-magenta'),
        ], [
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundColorCircleLayer::make(Color::fromRgba(170, 0, 169))
                    ->setLayerPosition(512 / 2, 512 / 2),
                InputTextLayer::make(Color::fromRgba(255, 255, 255))
                    ->setLayerControl(75, 75, 350, 350),
            ]
        ]);
        $sticker->syncTags(['dark-magenta']);
        unset($sticker);

        //ORANGE
        $sticker = $pack->stickers()->updateOrCreate([
            'code' => sprintf('%s.%s', $packCode, 'orange'),
        ], [
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundColorCircleLayer::make(Color::fromRgba(255, 170, 1))
                    ->setLayerPosition(512 / 2, 512 / 2),
                InputTextLayer::make(Color::fromRgba(255, 255, 255))
                    ->setLayerControl(75, 75, 350, 350),
            ]
        ]);
        $sticker->syncTags(['orange']);
        unset($sticker);

        //GRAY
        $sticker = $pack->stickers()->updateOrCreate([
            'code' => sprintf('%s.%s', $packCode, 'gray'),
        ], [
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundColorCircleLayer::make(Color::fromRgba(170, 170, 170))
                    ->setLayerPosition(512 / 2, 512 / 2),
                InputTextLayer::make(Color::fromRgba(255, 255, 255))
                    ->setLayerControl(75, 75, 350, 350),
            ]
        ]);
        $sticker->syncTags(['gray']);
        unset($sticker);

        //DARK GRAY
        $sticker = $pack->stickers()->updateOrCreate([
            'code' => sprintf('%s.%s', $packCode, 'dark-gray'),
        ], [
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundColorCircleLayer::make(Color::fromRgba(85, 85, 85))
                    ->setLayerPosition(512 / 2, 512 / 2),
                InputTextLayer::make(Color::fromRgba(255, 255, 255))
                    ->setLayerControl(75, 75, 350, 350),
            ]
        ]);
        $sticker->syncTags(['dark-gray']);
        unset($sticker);

        //INDIGO
        $sticker = $pack->stickers()->updateOrCreate([
            'code' => sprintf('%s.%s', $packCode, 'indigo'),
        ], [
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundColorCircleLayer::make(Color::fromRgba(86, 84, 255))
                    ->setLayerPosition(512 / 2, 512 / 2),
                InputTextLayer::make(Color::fromRgba(255, 255, 255))
                    ->setLayerControl(75, 75, 350, 350),
            ]
        ]);
        $sticker->syncTags(['indigo']);
        unset($sticker);

        //LIGHT GREEN
        $sticker = $pack->stickers()->updateOrCreate([
            'code' => sprintf('%s.%s', $packCode, 'light-green'),
        ], [
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundColorCircleLayer::make(Color::fromRgba(85, 255, 86))
                    ->setLayerPosition(512 / 2, 512 / 2),
                InputTextLayer::make(Color::fromRgba(255, 255, 255))
                    ->setLayerControl(75, 75, 350, 350),
            ]
        ]);
        $sticker->syncTags(['light-green']);
        unset($sticker);

        //LIGHT CYAN
        $sticker = $pack->stickers()->updateOrCreate([
            'code' => sprintf('%s.%s', $packCode, 'light-cyan'),
        ], [
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundColorCircleLayer::make(Color::fromRgba(85, 255, 255))
                    ->setLayerPosition(512 / 2, 512 / 2),
                InputTextLayer::make(Color::fromRgba(255, 255, 255))
                    ->setLayerControl(75, 75, 350, 350),
            ]
        ]);
        $sticker->syncTags(['light-cyan']);
        unset($sticker);

        //LIGHT RED
        $sticker = $pack->stickers()->updateOrCreate([
            'code' => sprintf('%s.%s', $packCode, 'light-red'),
        ], [
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundColorCircleLayer::make(Color::fromRgba(255, 85, 85))
                    ->setLayerPosition(512 / 2, 512 / 2),
                InputTextLayer::make(Color::fromRgba(255, 255, 255))
                    ->setLayerControl(75, 75, 350, 350),
            ]
        ]);
        $sticker->syncTags(['light-red']);
        unset($sticker);

        //PINK
        $sticker = $pack->stickers()->updateOrCreate([
            'code' => sprintf('%s.%s', $packCode, 'pink'),
        ], [
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundColorCircleLayer::make(Color::fromRgba(255, 85, 254))
                    ->setLayerPosition(512 / 2, 512 / 2),
                InputTextLayer::make(Color::fromRgba(255, 255, 255))
                    ->setLayerControl(75, 75, 350, 350),
            ]
        ]);
        $sticker->syncTags(['pink']);
        unset($sticker);

        //YELLOW
        $sticker = $pack->stickers()->updateOrCreate([
            'code' => sprintf('%s.%s', $packCode, 'yellow'),
        ], [
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundColorCircleLayer::make(Color::fromRgba(255, 255, 85))
                    ->setLayerPosition(512 / 2, 512 / 2),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(75, 75, 350, 350),
            ]
        ]);
        $sticker->syncTags(['yellow']);
        unset($sticker);

        //WHITE
        $sticker = $pack->stickers()->updateOrCreate([
            'code' => sprintf('%s.%s', $packCode, 'white'),
        ], [
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundColorCircleLayer::make(Color::fromRgba(255, 255, 255))
                    ->setLayerPosition(512 / 2, 512 / 2),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(75, 75, 350, 350),
            ]
        ]);
        $sticker->syncTags(['white']);
        unset($sticker);

        //VIOLET
        $sticker = $pack->stickers()->updateOrCreate([
            'code' => sprintf('%s.%s', $packCode, 'violet'),
        ], [
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundColorCircleLayer::make(Color::fromRgba(42, 0, 211))
                    ->setLayerPosition(512 / 2, 512 / 2),
                InputTextLayer::make(Color::fromRgba(255, 255, 255))
                    ->setLayerControl(75, 75, 350, 350),
            ]
        ]);
        $sticker->syncTags(['violet']);
        unset($sticker);

        //LIGHT BLUE
        $sticker = $pack->stickers()->updateOrCreate([
            'code' => sprintf('%s.%s', $packCode, 'light-blue'),
        ], [
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundColorCircleLayer::make(Color::fromRgba(0, 120, 255))
                    ->setLayerPosition(512 / 2, 512 / 2),
                InputTextLayer::make(Color::fromRgba(255, 255, 255))
                    ->setLayerControl(75, 75, 350, 350),
            ]
        ]);
        $sticker->syncTags(['light-blue']);
        unset($sticker);

        //GREEN
        $sticker = $pack->stickers()->updateOrCreate([
            'code' => sprintf('%s.%s', $packCode, 'green'),
        ], [
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundColorCircleLayer::make(Color::fromRgba(36, 198, 0))
                    ->setLayerPosition(512 / 2, 512 / 2),
                InputTextLayer::make(Color::fromRgba(255, 255, 255))
                    ->setLayerControl(75, 75, 350, 350),
            ]
        ]);
        $sticker->syncTags(['green']);
        unset($sticker);

        //AQUA
        $sticker = $pack->stickers()->updateOrCreate([
            'code' => sprintf('%s.%s', $packCode, 'acqua'),
        ], [
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundColorCircleLayer::make(Color::fromRgba(0, 211, 137))
                    ->setLayerPosition(512 / 2, 512 / 2),
                InputTextLayer::make(Color::fromRgba(255, 255, 255))
                    ->setLayerControl(75, 75, 350, 350),
            ]
        ]);
        $sticker->syncTags(['acqua']);
        unset($sticker);

        //RED
        $sticker = $pack->stickers()->updateOrCreate([
            'code' => sprintf('%s.%s', $packCode, 'red'),
        ], [
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundColorCircleLayer::make(Color::fromRgba(211, 0, 0))
                    ->setLayerPosition(512 / 2, 512 / 2),
                InputTextLayer::make(Color::fromRgba(255, 255, 255))
                    ->setLayerControl(75, 75, 350, 350),
            ]
        ]);
        $sticker->syncTags(['red']);
        unset($sticker);

        //MAGENTA
        $sticker = $pack->stickers()->updateOrCreate([
            'code' => sprintf('%s.%s', $packCode, 'magenta'),
        ], [
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundColorCircleLayer::make(Color::fromRgba(255, 0, 255))
                    ->setLayerPosition(512 / 2, 512 / 2),
                InputTextLayer::make(Color::fromRgba(255, 255, 255))
                    ->setLayerControl(75, 75, 350, 350),
            ]
        ]);
        $sticker->syncTags(['magenta']);
        unset($sticker);

        //DARK YELLOW
        $sticker = $pack->stickers()->updateOrCreate([
            'code' => sprintf('%s.%s', $packCode, 'dark-yellow'),
        ], [
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundColorCircleLayer::make(Color::fromRgba(204, 211, 0))
                    ->setLayerPosition(512 / 2, 512 / 2),
                InputTextLayer::make(Color::fromRgba(255, 255, 255))
                    ->setLayerControl(75, 75, 350, 350),
            ]
        ]);
        $sticker->syncTags(['dark-yellow']);
        unset($sticker);

        //BROWN
        $sticker = $pack->stickers()->updateOrCreate([
            'code' => sprintf('%s.%s', $packCode, 'brown'),
        ], [
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundColorCircleLayer::make(Color::fromRgba(211, 119, 0))
                    ->setLayerPosition(512 / 2, 512 / 2),
                InputTextLayer::make(Color::fromRgba(255, 255, 255))
                    ->setLayerControl(75, 75, 350, 350),
            ]
        ]);
        $sticker->syncTags(['brown']);
        unset($sticker);
    }
}
