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
            'tags' => [
                'text-monochrome',
                'monochrome-text',
                'solid-background',
                'square',
                'square-background',
            ],
        ]);

        //BLACK
        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundColorLayer::make(Color::fromRgba(0, 0, 0)),
                InputTextLayer::make(Color::fromRgba(255, 255, 255)),
            ],
            'tags' => ['black'],
        ]);

        //BLUE
        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundColorLayer::make(Color::fromRgba(1, 0, 171)),
                InputTextLayer::make(Color::fromRgba(255, 255, 255)),
            ],
            'tags' => ['blue'],
        ]);

        //DARK GREEN
        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundColorLayer::make(Color::fromRgba(0, 170, 1)),
                InputTextLayer::make(Color::fromRgba(255, 255, 255)),
            ],
            'tags' => ['dark-green'],
        ]);

        //CYAN
        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundColorLayer::make(Color::fromRgba(6, 164, 167)),
                InputTextLayer::make(Color::fromRgba(255, 255, 255)),
            ],
            'tags' => ['cyan'],
        ]);

        //DARK RED
        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundColorLayer::make(Color::fromRgba(172, 0, 0)),
                InputTextLayer::make(Color::fromRgba(255, 255, 255)),
            ],
            'tags' => ['dark-red'],
        ]);

        //DARK MAGENTA
        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundColorLayer::make(Color::fromRgba(170, 0, 169)),
                InputTextLayer::make(Color::fromRgba(255, 255, 255)),
            ],
            'tags' => ['dark-magenta'],
        ]);

        //ORANGE
        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundColorLayer::make(Color::fromRgba(255, 170, 1)),
                InputTextLayer::make(Color::fromRgba(255, 255, 255)),
            ],
            'tags' => ['orange'],
        ]);

        //GRAY
        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundColorLayer::make(Color::fromRgba(170, 170, 170)),
                InputTextLayer::make(Color::fromRgba(255, 255, 255)),
            ],
            'tags' => ['gray'],
        ]);

        //DARK GRAY
        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundColorLayer::make(Color::fromRgba(85, 85, 85)),
                InputTextLayer::make(Color::fromRgba(255, 255, 255)),
            ],
            'tags' => ['dark-gray'],
        ]);

        //INDIGO
        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundColorLayer::make(Color::fromRgba(86, 84, 255)),
                InputTextLayer::make(Color::fromRgba(255, 255, 255)),
            ],
            'tags' => ['indigo'],
        ]);

        //LIGHT GREEN
        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundColorLayer::make(Color::fromRgba(85, 255, 86)),
                InputTextLayer::make(Color::fromRgba(255, 255, 255)),
            ],
            'tags' => ['light-green'],
        ]);

        //LIGHT CYAN
        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundColorLayer::make(Color::fromRgba(85, 255, 255)),
                InputTextLayer::make(Color::fromRgba(255, 255, 255)),
            ],
            'tags' => ['light-cyan'],
        ]);

        //LIGHT RED
        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundColorLayer::make(Color::fromRgba(255, 85, 85)),
                InputTextLayer::make(Color::fromRgba(255, 255, 255)),
            ],
            'tags' => ['light-red'],
        ]);

        //PINK
        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundColorLayer::make(Color::fromRgba(255, 85, 254)),
                InputTextLayer::make(Color::fromRgba(255, 255, 255)),
            ],
            'tags' => ['pink'],
        ]);

        //YELLOW
        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundColorLayer::make(Color::fromRgba(255, 255, 85)),
                InputTextLayer::make(Color::fromRgba(0, 0, 0)),
            ],
            'tags' => ['yellow'],
        ]);

        //WHITE
        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundColorLayer::make(Color::fromRgba(255, 255, 255)),
                InputTextLayer::make(Color::fromRgba(0, 0, 0)),
            ],
            'tags' => ['white'],
        ]);

        //VIOLET
        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundColorLayer::make(Color::fromRgba(42, 0, 211)),
                InputTextLayer::make(Color::fromRgba(255, 255, 255)),
            ],
            'tags' => ['violet'],
        ]);

        //LIGHT BLUE
        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundColorLayer::make(Color::fromRgba(0, 120, 255)),
                InputTextLayer::make(Color::fromRgba(255, 255, 255)),
            ],
            'tags' => ['light-blue'],
        ]);

        //GREEN
        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundColorLayer::make(Color::fromRgba(36, 198, 0)),
                InputTextLayer::make(Color::fromRgba(255, 255, 255)),
            ],
            'tags' => ['green'],
        ]);

        //AQUA
        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundColorLayer::make(Color::fromRgba(0, 211, 137)),
                InputTextLayer::make(Color::fromRgba(255, 255, 255)),
            ],
            'tags' => ['aqua'],
        ]);

        //RED
        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundColorLayer::make(Color::fromRgba(211, 0, 0)),
                InputTextLayer::make(Color::fromRgba(255, 255, 255)),
            ],
            'tags' => ['red'],
        ]);

        //MAGENTA
        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundColorLayer::make(Color::fromRgba(255, 0, 255)),
                InputTextLayer::make(Color::fromRgba(255, 255, 255)),
            ],
            'tags' => ['magenta'],
        ]);

        //DARK YELLOW
        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundColorLayer::make(Color::fromRgba(204, 211, 0)),
                InputTextLayer::make(Color::fromRgba(255, 255, 255)),
            ],
            'tags' => ['dark-yellow'],
        ]);

        //BROWN
        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundColorLayer::make(Color::fromRgba(211, 119, 0)),
                InputTextLayer::make(Color::fromRgba(255, 255, 255)),
            ],
            'tags' => ['brown'],
        ]);
    }
}
