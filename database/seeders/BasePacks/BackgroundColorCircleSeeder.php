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

        if (Pack::where('code', $packCode)->exists()) {
            $this->command->line('Skipping ' . $packCode . ' pack creation, already exists');
            return;
        }

        $pack = Pack::create([
            'name' => 'Background Color (Circle)',
            'code' => $packCode,
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
        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundColorCircleLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerPosition(512 / 2, 512 / 2),
                InputTextLayer::make(Color::fromRgba(255, 255, 255))
                    ->setLayerControl(75, 75, 350, 350),
            ],
            'tags' => ['black'],
        ]);

        //BLUE
        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundColorCircleLayer::make(Color::fromRgba(1, 0, 171))
                    ->setLayerPosition(512 / 2, 512 / 2),
                InputTextLayer::make(Color::fromRgba(255, 255, 255))
                    ->setLayerControl(75, 75, 350, 350),
            ],
            'tags' => ['blue'],
        ]);

        //DARK GREEN
        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundColorCircleLayer::make(Color::fromRgba(0, 170, 1))
                    ->setLayerPosition(512 / 2, 512 / 2),
                InputTextLayer::make(Color::fromRgba(255, 255, 255))
                    ->setLayerControl(75, 75, 350, 350),
            ],
            'tags' => ['dark-green'],
        ]);

        //CYAN
        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundColorCircleLayer::make(Color::fromRgba(6, 164, 167))
                    ->setLayerPosition(512 / 2, 512 / 2),
                InputTextLayer::make(Color::fromRgba(255, 255, 255))
                    ->setLayerControl(75, 75, 350, 350),
            ],
            'tags' => ['cyan'],
        ]);

        //DARK RED
        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundColorCircleLayer::make(Color::fromRgba(172, 0, 0))
                    ->setLayerPosition(512 / 2, 512 / 2),
                InputTextLayer::make(Color::fromRgba(255, 255, 255))
                    ->setLayerControl(75, 75, 350, 350),
            ],
            'tags' => ['dark-red'],
        ]);

        //DARK MAGENTA
        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundColorCircleLayer::make(Color::fromRgba(170, 0, 169))
                    ->setLayerPosition(512 / 2, 512 / 2),
                InputTextLayer::make(Color::fromRgba(255, 255, 255))
                    ->setLayerControl(75, 75, 350, 350),
            ],
            'tags' => ['dark-magenta'],
        ]);

        //ORANGE
        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundColorCircleLayer::make(Color::fromRgba(255, 170, 1))
                    ->setLayerPosition(512 / 2, 512 / 2),
                InputTextLayer::make(Color::fromRgba(255, 255, 255))
                    ->setLayerControl(75, 75, 350, 350),
            ],
            'tags' => ['orange'],
        ]);

        //GRAY
        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundColorCircleLayer::make(Color::fromRgba(170, 170, 170))
                    ->setLayerPosition(512 / 2, 512 / 2),
                InputTextLayer::make(Color::fromRgba(255, 255, 255))
                    ->setLayerControl(75, 75, 350, 350),
            ],
            'tags' => ['gray'],
        ]);

        //DARK GRAY
        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundColorCircleLayer::make(Color::fromRgba(85, 85, 85))
                    ->setLayerPosition(512 / 2, 512 / 2),
                InputTextLayer::make(Color::fromRgba(255, 255, 255))
                    ->setLayerControl(75, 75, 350, 350),
            ],
            'tags' => ['dark-gray'],
        ]);

        //INDIGO
        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundColorCircleLayer::make(Color::fromRgba(86, 84, 255))
                    ->setLayerPosition(512 / 2, 512 / 2),
                InputTextLayer::make(Color::fromRgba(255, 255, 255))
                    ->setLayerControl(75, 75, 350, 350),
            ],
            'tags' => ['indigo'],
        ]);

        //LIGHT GREEN
        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundColorCircleLayer::make(Color::fromRgba(85, 255, 86))
                    ->setLayerPosition(512 / 2, 512 / 2),
                InputTextLayer::make(Color::fromRgba(255, 255, 255))
                    ->setLayerControl(75, 75, 350, 350),
            ],
            'tags' => ['light-green'],
        ]);

        //LIGHT CYAN
        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundColorCircleLayer::make(Color::fromRgba(85, 255, 255))
                    ->setLayerPosition(512 / 2, 512 / 2),
                InputTextLayer::make(Color::fromRgba(255, 255, 255))
                    ->setLayerControl(75, 75, 350, 350),
            ],
            'tags' => ['light-cyan'],
        ]);

        //LIGHT RED
        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundColorCircleLayer::make(Color::fromRgba(255, 85, 85))
                    ->setLayerPosition(512 / 2, 512 / 2),
                InputTextLayer::make(Color::fromRgba(255, 255, 255))
                    ->setLayerControl(75, 75, 350, 350),
            ],
            'tags' => ['light-red'],
        ]);

        //PINK
        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundColorCircleLayer::make(Color::fromRgba(255, 85, 254))
                    ->setLayerPosition(512 / 2, 512 / 2),
                InputTextLayer::make(Color::fromRgba(255, 255, 255))
                    ->setLayerControl(75, 75, 350, 350),
            ],
            'tags' => ['pink'],
        ]);

        //YELLOW
        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundColorCircleLayer::make(Color::fromRgba(255, 255, 85))
                    ->setLayerPosition(512 / 2, 512 / 2),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(75, 75, 350, 350),
            ],
            'tags' => ['yellow'],
        ]);

        //WHITE
        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundColorCircleLayer::make(Color::fromRgba(255, 255, 255))
                    ->setLayerPosition(512 / 2, 512 / 2),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(75, 75, 350, 350),
            ],
            'tags' => ['white'],
        ]);

        //VIOLET
        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundColorCircleLayer::make(Color::fromRgba(42, 0, 211))
                    ->setLayerPosition(512 / 2, 512 / 2),
                InputTextLayer::make(Color::fromRgba(255, 255, 255))
                    ->setLayerControl(75, 75, 350, 350),
            ],
            'tags' => ['violet'],
        ]);

        //LIGHT BLUE
        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundColorCircleLayer::make(Color::fromRgba(0, 120, 255))
                    ->setLayerPosition(512 / 2, 512 / 2),
                InputTextLayer::make(Color::fromRgba(255, 255, 255))
                    ->setLayerControl(75, 75, 350, 350),
            ],
            'tags' => ['light-blue'],
        ]);

        //GREEN
        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundColorCircleLayer::make(Color::fromRgba(36, 198, 0))
                    ->setLayerPosition(512 / 2, 512 / 2),
                InputTextLayer::make(Color::fromRgba(255, 255, 255))
                    ->setLayerControl(75, 75, 350, 350),
            ],
            'tags' => ['green'],
        ]);

        //AQUA
        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundColorCircleLayer::make(Color::fromRgba(0, 211, 137))
                    ->setLayerPosition(512 / 2, 512 / 2),
                InputTextLayer::make(Color::fromRgba(255, 255, 255))
                    ->setLayerControl(75, 75, 350, 350),
            ],
            'tags' => ['acqua'],
        ]);

        //RED
        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundColorCircleLayer::make(Color::fromRgba(211, 0, 0))
                    ->setLayerPosition(512 / 2, 512 / 2),
                InputTextLayer::make(Color::fromRgba(255, 255, 255))
                    ->setLayerControl(75, 75, 350, 350),
            ],
            'tags' => ['red'],
        ]);

        //MAGENTA
        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundColorCircleLayer::make(Color::fromRgba(255, 0, 255))
                    ->setLayerPosition(512 / 2, 512 / 2),
                InputTextLayer::make(Color::fromRgba(255, 255, 255))
                    ->setLayerControl(75, 75, 350, 350),
            ],
            'tags' => ['magenta'],
        ]);

        //DARK YELLOW
        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundColorCircleLayer::make(Color::fromRgba(204, 211, 0))
                    ->setLayerPosition(512 / 2, 512 / 2),
                InputTextLayer::make(Color::fromRgba(255, 255, 255))
                    ->setLayerControl(75, 75, 350, 350),
            ],
            'tags' => ['dark-yellow'],
        ]);

        //BROWN
        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundColorCircleLayer::make(Color::fromRgba(211, 119, 0))
                    ->setLayerPosition(512 / 2, 512 / 2),
                InputTextLayer::make(Color::fromRgba(255, 255, 255))
                    ->setLayerControl(75, 75, 350, 350),
            ],
            'tags' => ['brown'],
        ]);
    }
}
