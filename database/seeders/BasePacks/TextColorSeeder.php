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
        $pack = Pack::create([
            'name' => 'Text Color',
            'code' => 'TextColor',
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
            ]
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
            ]
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
            ]
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
            ]
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
            ]
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
            ]
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
            ]
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
            ]
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
            ]
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
            ]
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
            ]
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
            ]
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
            ]
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
            ]
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
            ]
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
            ]
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
            ]
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
            ]
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
            ]
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
            ]
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
            ]
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
            ]
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
            ]
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
            ]
        ]);
    }
}
