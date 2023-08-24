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
            ]
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
            ]
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
            ]
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
            ]
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
            ]
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
            ]
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
            ]
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
            ]
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
            ]
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
            ]
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
            ]
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
            ]
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
            ]
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
            ]
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
            ]
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
            ]
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
            ]
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
            ]
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
            ]
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
            ]
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
            ]
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
            ]
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
            ]
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
            ]
        ]);
    }
}
