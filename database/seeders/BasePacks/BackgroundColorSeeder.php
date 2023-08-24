<?php

namespace Database\Seeders\BasePacks;

use App\Models\Pack;
use App\Stickerizer\Layers\BackgroundColorLayer;
use App\Stickerizer\Layers\InputTextLayer;
use App\Stickerizer\Styles\Color;
use Illuminate\Database\Seeder;

class BackgroundColorSeeder extends Seeder
{
    public function run(): void
    {
        $packCode = 'BackgroundColor';

        if (Pack::where('code', $packCode)->exists()) {
            $this->command->line('Skipping ' . $packCode . ' pack creation, already exists');
            return;
        }

        $pack = Pack::create([
            'name' => 'Background Color',
            'code' => $packCode,
        ]);

        //BLACK
        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundColorLayer::make(Color::fromRgba(0, 0, 0)),
                InputTextLayer::make(Color::fromRgba(255, 255, 255)),
            ]
        ]);

        //BLUE
        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundColorLayer::make(Color::fromRgba(1, 0, 171)),
                InputTextLayer::make(Color::fromRgba(255, 255, 255)),
            ]
        ]);

        //DARK GREEN
        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundColorLayer::make(Color::fromRgba(0, 170, 1)),
                InputTextLayer::make(Color::fromRgba(255, 255, 255)),
            ]
        ]);

        //CYAN
        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundColorLayer::make(Color::fromRgba(6, 164, 167)),
                InputTextLayer::make(Color::fromRgba(255, 255, 255)),
            ]
        ]);

        //DARK RED
        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundColorLayer::make(Color::fromRgba(172, 0, 0)),
                InputTextLayer::make(Color::fromRgba(255, 255, 255)),
            ]
        ]);

        //DARK MAGENTA
        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundColorLayer::make(Color::fromRgba(170, 0, 169)),
                InputTextLayer::make(Color::fromRgba(255, 255, 255)),
            ]
        ]);

        //ORANGE
        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundColorLayer::make(Color::fromRgba(255, 170, 1)),
                InputTextLayer::make(Color::fromRgba(255, 255, 255)),
            ]
        ]);

        //GRAY
        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundColorLayer::make(Color::fromRgba(170, 170, 170)),
                InputTextLayer::make(Color::fromRgba(255, 255, 255)),
            ]
        ]);

        //DARK GRAY
        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundColorLayer::make(Color::fromRgba(85, 85, 85)),
                InputTextLayer::make(Color::fromRgba(255, 255, 255)),
            ]
        ]);

        //INDIGO
        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundColorLayer::make(Color::fromRgba(86, 84, 255)),
                InputTextLayer::make(Color::fromRgba(255, 255, 255)),
            ]
        ]);

        //LIGHT GREEN
        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundColorLayer::make(Color::fromRgba(85, 255, 86)),
                InputTextLayer::make(Color::fromRgba(255, 255, 255)),
            ]
        ]);

        //LIGHT CYAN
        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundColorLayer::make(Color::fromRgba(85, 255, 255)),
                InputTextLayer::make(Color::fromRgba(255, 255, 255)),
            ]
        ]);

        //LIGHT RED
        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundColorLayer::make(Color::fromRgba(255, 85, 85)),
                InputTextLayer::make(Color::fromRgba(255, 255, 255)),
            ]
        ]);

        //PINK
        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundColorLayer::make(Color::fromRgba(255, 85, 254)),
                InputTextLayer::make(Color::fromRgba(255, 255, 255)),
            ]
        ]);

        //YELLOW
        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundColorLayer::make(Color::fromRgba(255, 255, 85)),
                InputTextLayer::make(Color::fromRgba(0, 0, 0)),
            ]
        ]);

        //WHITE
        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundColorLayer::make(Color::fromRgba(255, 255, 255)),
                InputTextLayer::make(Color::fromRgba(0, 0, 0)),
            ]
        ]);

        //VIOLET
        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundColorLayer::make(Color::fromRgba(42, 0, 211)),
                InputTextLayer::make(Color::fromRgba(255, 255, 255)),
            ]
        ]);

        //LIGHT BLUE
        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundColorLayer::make(Color::fromRgba(0, 120, 255)),
                InputTextLayer::make(Color::fromRgba(255, 255, 255)),
            ]
        ]);

        //GREEN
        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundColorLayer::make(Color::fromRgba(36, 198, 0)),
                InputTextLayer::make(Color::fromRgba(255, 255, 255)),
            ]
        ]);

        //AQUA
        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundColorLayer::make(Color::fromRgba(0, 211, 137)),
                InputTextLayer::make(Color::fromRgba(255, 255, 255)),
            ]
        ]);

        //RED
        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundColorLayer::make(Color::fromRgba(211, 0, 0)),
                InputTextLayer::make(Color::fromRgba(255, 255, 255)),
            ]
        ]);

        //MAGENTA
        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundColorLayer::make(Color::fromRgba(255, 0, 255)),
                InputTextLayer::make(Color::fromRgba(255, 255, 255)),
            ]
        ]);

        //DARK YELLOW
        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundColorLayer::make(Color::fromRgba(204, 211, 0)),
                InputTextLayer::make(Color::fromRgba(255, 255, 255)),
            ]
        ]);

        //BROWN
        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundColorLayer::make(Color::fromRgba(211, 119, 0)),
                InputTextLayer::make(Color::fromRgba(255, 255, 255)),
            ]
        ]);
    }
}
