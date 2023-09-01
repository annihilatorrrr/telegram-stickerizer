<?php

namespace Database\Seeders\BasePacks;

use App\Models\Pack;
use App\Stickerizer\Layers\InputTextLayer;
use App\Stickerizer\Styles\Color;
use Illuminate\Database\Seeder;

class TextColorSeeder extends Seeder
{
    public function run(): void
    {
        $packCode = 'TextColor';

        if (Pack::where('code', $packCode)->exists()) {
            $this->command->line('Skipping ' . $packCode . ' pack creation, already exists');
            return;
        }

        $pack = Pack::create([
            'name' => 'Text Color',
            'code' => $packCode,
            'tags' => [
                'text-only',
                'text-color',
                'colored-text',
                'transparent-background',
            ],
        ]);

        //BLACK
        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                InputTextLayer::make(
                    fontColor: Color::fromRgba(0, 0, 0),
                    strokeSize: 2,
                    strokeColor: Color::fromRgba(255, 255, 255),
                ),
            ],
            'tags' => ['black'],
        ]);

        //BLUE
        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                InputTextLayer::make(
                    fontColor: Color::fromRgba(1, 0, 171),
                    strokeSize: 2,
                    strokeColor: Color::fromRgba(255, 255, 255),
                ),
            ],
            'tags' => ['blue'],
        ]);

        //DARK GREEN
        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                InputTextLayer::make(
                    fontColor: Color::fromRgba(0, 170, 1),
                    strokeSize: 2,
                    strokeColor: Color::fromRgba(255, 255, 255),
                ),
            ],
            'tags' => ['dark-green'],
        ]);

        //CYAN
        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                InputTextLayer::make(
                    fontColor: Color::fromRgba(6, 164, 167),
                    strokeSize: 2,
                    strokeColor: Color::fromRgba(255, 255, 255),
                ),
            ],
            'tags' => ['cyan'],
        ]);

        //DARK RED
        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                InputTextLayer::make(
                    fontColor: Color::fromRgba(172, 0, 0),
                    strokeSize: 2,
                    strokeColor: Color::fromRgba(255, 255, 255),
                ),
            ],
            'tags' => ['dark-red'],
        ]);

        //DARK MAGENTA
        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                InputTextLayer::make(
                    fontColor: Color::fromRgba(170, 0, 169),
                    strokeSize: 2,
                    strokeColor: Color::fromRgba(255, 255, 255),
                ),
            ],
            'tags' => ['dark-magenta'],
        ]);

        //ORANGE
        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                InputTextLayer::make(
                    fontColor: Color::fromRgba(255, 170, 1),
                    strokeSize: 2,
                    strokeColor: Color::fromRgba(255, 255, 255),
                ),
            ],
            'tags' => ['orange'],
        ]);

        //GRAY
        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                InputTextLayer::make(
                    fontColor: Color::fromRgba(170, 170, 170),
                    strokeSize: 2,
                    strokeColor: Color::fromRgba(255, 255, 255),
                ),
            ],
            'tags' => ['gray'],
        ]);

        //DARK GRAY
        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                InputTextLayer::make(
                    fontColor: Color::fromRgba(85, 85, 85),
                    strokeSize: 2,
                    strokeColor: Color::fromRgba(255, 255, 255),
                ),
            ],
            'tags' => ['dark-gray'],
        ]);

        //INDIGO
        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                InputTextLayer::make(
                    fontColor: Color::fromRgba(86, 84, 255),
                    strokeSize: 2,
                    strokeColor: Color::fromRgba(255, 255, 255),
                ),
            ],
            'tags' => ['indigo'],
        ]);

        //LIGHT GREEN
        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                InputTextLayer::make(
                    fontColor: Color::fromRgba(85, 255, 86),
                    strokeSize: 2,
                    strokeColor: Color::fromRgba(255, 255, 255),
                ),
            ],
            'tags' => ['light-green'],
        ]);

        //LIGHT CYAN
        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                InputTextLayer::make(
                    fontColor: Color::fromRgba(85, 255, 255),
                    strokeSize: 2,
                    strokeColor: Color::fromRgba(255, 255, 255),
                ),
            ],
            'tags' => ['light-cyan'],
        ]);

        //LIGHT RED
        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                InputTextLayer::make(
                    fontColor: Color::fromRgba(255, 85, 85),
                    strokeSize: 2,
                    strokeColor: Color::fromRgba(255, 255, 255),
                ),
            ],
            'tags' => ['light-red'],
        ]);

        //PINK
        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                InputTextLayer::make(
                    fontColor: Color::fromRgba(255, 85, 254),
                    strokeSize: 2,
                    strokeColor: Color::fromRgba(255, 255, 255),
                ),
            ],
            'tags' => ['pink'],
        ]);

        //YELLOW
        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                InputTextLayer::make(
                    fontColor: Color::fromRgba(255, 255, 85),
                    strokeSize: 2,
                    strokeColor: Color::fromRgba(0, 0, 0),
                ),
            ],
            'tags' => ['yellow'],
        ]);

        //WHITE
        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                InputTextLayer::make(
                    fontColor: Color::fromRgba(255, 255, 255),
                    strokeSize: 2,
                    strokeColor: Color::fromRgba(0, 0, 0),
                ),
            ],
            'tags' => ['white'],
        ]);

        //VIOLET
        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                InputTextLayer::make(
                    fontColor: Color::fromRgba(42, 0, 211),
                    strokeSize: 2,
                    strokeColor: Color::fromRgba(255, 255, 255),
                ),
            ],
            'tags' => ['violet'],
        ]);

        //LIGHT BLUE
        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                InputTextLayer::make(
                    fontColor: Color::fromRgba(0, 120, 255),
                    strokeSize: 2,
                    strokeColor: Color::fromRgba(255, 255, 255),
                ),
            ],
            'tags' => ['light-blue'],
        ]);

        //GREEN
        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                InputTextLayer::make(
                    fontColor: Color::fromRgba(36, 198, 0),
                    strokeSize: 2,
                    strokeColor: Color::fromRgba(255, 255, 255),
                ),
            ],
            'tags' => ['green'],
        ]);

        //AQUA
        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                InputTextLayer::make(
                    fontColor: Color::fromRgba(0, 211, 137),
                    strokeSize: 2,
                    strokeColor: Color::fromRgba(255, 255, 255),
                ),
            ],
            'tags' => ['aqua'],
        ]);

        //RED
        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                InputTextLayer::make(
                    fontColor: Color::fromRgba(211, 0, 0),
                    strokeSize: 2,
                    strokeColor: Color::fromRgba(255, 255, 255),
                ),
            ],
            'tags' => ['red'],
        ]);

        //MAGENTA
        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                InputTextLayer::make(
                    fontColor: Color::fromRgba(255, 0, 255),
                    strokeSize: 2,
                    strokeColor: Color::fromRgba(255, 255, 255),
                ),
            ],
            'tags' => ['magenta'],
        ]);

        //DARK YELLOW
        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                InputTextLayer::make(
                    fontColor: Color::fromRgba(204, 211, 0),
                    strokeSize: 2,
                    strokeColor: Color::fromRgba(255, 255, 255),
                ),
            ],
            'tags' => ['dark-yellow'],
        ]);

        //BROWN
        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                InputTextLayer::make(
                    fontColor: Color::fromRgba(211, 119, 0),
                    strokeSize: 2,
                    strokeColor: Color::fromRgba(255, 255, 255),
                ),
            ],
            'tags' => ['brown'],
        ]);
    }
}
