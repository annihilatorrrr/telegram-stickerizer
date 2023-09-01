<?php

namespace Database\Seeders\BasePacks;

use App\Models\Pack;
use App\Stickerizer\Layers\BackgroundColorLayer;
use App\Stickerizer\Layers\BackgroundImageLayer;
use App\Stickerizer\Layers\InputTextLayer;
use App\Stickerizer\Styles\Color;
use App\Stickerizer\Styles\HorizontalAlignment;
use App\Stickerizer\Styles\VerticalAlignment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class BackgroundSpecialSeeder extends Seeder
{
    public function run(): void
    {
        $packCode = 'SpecialImage';

        if (Pack::where('code', $packCode)->exists()) {
            $this->command->line('Skipping ' . $packCode . ' pack creation, already exists');
            return;
        }

        $pack = Pack::create([
            'name' => 'Special Image',
            'code' => $packCode,
            'tags' => [
                'text-color',
                'colored-text',
                'image-background',
                'events',
                'meme',
                'image',
            ],
        ]);

        $packDisk = Storage::disk('packs');

        File::copyDirectory(
            resource_path('img/BasePacks/SpecialImage/'),
            $packDisk->path('SpecialImage')
        );

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/gunter.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(0, 295, 480, 200),
            ],
            'tags' => ['gunter', 'penguin', 'adventure-time', 'sign'],
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/trashdoves.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(20, 155, 390, 330),
            ],
            'tags' => ['trashdove', 'dove', 'bird', 'facebook', 'sign'],
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/staff.png')),
                InputTextLayer::make(Color::fromRgba(200, 0, 0))
                    ->setLayerControl(35, 30, 420, 110),
            ],
            'tags' => ['staff', 'sound', 'music', 'sign', 'event'],
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/platypus.png')),
                InputTextLayer::make(
                    fontColor: Color::fromRgba(255, 0, 0),
                    strokeSize: 2,
                    strokeColor: Color::fromRgba(255, 200, 14),
                )->setLayerControl(40, 40, 420, 120),
            ],
            'tags' => ['platypus', 'sign', 'yellow'],
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/yoshi.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))->setLayerControl(0, 0, 480, 220),
            ],
            'tags' => ['yoshi', 'baloon', 'green', 'mario', 'nintendo', 'game', 'videogame'],
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundColorLayer::make(Color::fromRgba(0, 0, 0)),
                InputTextLayer::make(
                    fontColor: Color::fromRgba(200, 0, 0),
                    fontFamily: resource_path('fonts/wasted.ttf'),
                ),
            ],
            'tags' => ['wasted', 'gta', 'videogame', 'game', 'red', 'black', 'meme'],
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/minecraft.png')),
                InputTextLayer::make(
                    fontColor: Color::fromRgba(255, 255, 255),
                    fontFamily: resource_path('fonts/minecraftia.ttf'),
                    strokeSize: 3,
                    strokeColor: Color::fromRgba(0, 0, 0),
                    baseLine: -0.5,
                ),
            ],
            'tags' => ['minecraft', 'videogame', 'game', 'grass', 'dirt', 'brown', 'green'],
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/spongebob1.png')),
                InputTextLayer::make(strokeSize: 3),
            ],
            'tags' => ['spongebob', 'stupid', 'meme', 'yellow', 'grammar'],
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/keepcalm.png')),
                InputTextLayer::make(
                    fontFamily: resource_path('fonts/keepcalm.ttf'),
                )->setLayerControl(20, 275, 460, 230),
            ],
            'tags' => ['keepcalm', 'red', 'white', 'keep-calm', 'calm', 'carry-on'],
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/ghost.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(20, 20, 480, 180),
            ],
            'tags' => ['ghost', 'boo', 'halloween', 'white', 'scary', 'spooky', 'fear', 'horror', 'sign'],
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/squidward.png')),
                InputTextLayer::make(
                    strokeSize: 2,
                    strokeColor: Color::fromRgba(0, 0, 0),
                )->setLayerControl(25, 25, 460, 300),
            ],
            'tags' => ['squidward', 'spongebob', 'flex', 'ocean', 'sea', 'blue', 'dab'],
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/jakeA.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(20, 230, 470, 260),
                BackgroundImageLayer::make($packDisk->path('SpecialImage/jakeB.png')),
            ],
            'tags' => ['jake', 'dog', 'adventure-time', 'yellow'],
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/google.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(20, 230, 470, 160),
            ],
            'tags' => ['google', 'search', 'engine', 'logo', 'internet', 'web', 'www', 'site', 'website', 'search-engine'],
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/balloon-white.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(90, 135, 335, 205),
            ],
            'tags' => ['baloon', 'white'],
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/balloon-black.png')),
                InputTextLayer::make(Color::fromRgba(255, 255, 255))
                    ->setLayerControl(90, 135, 335, 205),
            ],
            'tags' => ['baloon', 'black'],
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/woman.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(10, 90, 320, 195),
            ],
            'tags' => ['woman', 'sign'],
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/arrow-top.png')),
                InputTextLayer::make()->setLayerControl(0, 215, 500, 290),
            ],
            'tags' => ['arrow', 'top', 'blue', 'sign', 'direction', 'up'],
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/arrow-bottom.png')),
                InputTextLayer::make()->setLayerControl(0, 0, 500, 300),
            ],
            'tags' => ['arrow', 'bottome', 'orange', 'sign', 'direction', 'down'],
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/arrow-left.png')),
                InputTextLayer::make()->setLayerControl(0, 0, 500, 250),
            ],
            'tags' => ['arrow', 'left', 'red', 'sign', 'direction'],
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/arrow-top-bottom.png')),
                InputTextLayer::make()->setLayerControl(0, 140, 500, 230),
            ],
            'tags' => ['arrow', 'top', 'bottom', 'green', 'arrows', 'sign', 'direction', 'directions', 'up', 'down'],
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/girl1.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(120, 260, 215, 180),
            ],
            'tags' => ['girl', 'manga', 'sign', 'black', 'white'],
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/red-button1.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(25, 35, 455, 90),
            ],
            'tags' => ['red', 'button', 'sign', 'event'],
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/stitch.png')),
                InputTextLayer::make(
                    fontColor: Color::fromRgba(244, 154, 189),
                    fontFamily: resource_path('fonts/fingerpaint.ttf'),
                    strokeSize: 2,
                    strokeColor: Color::fromRgba(0, 0, 0),
                )->setLayerControl(10, 10, 500, 160),
            ],
            'tags' => ['stitch', 'lilo', 'disney', 'blue', 'alien', 'cartoon', 'movie', 'film', 'animation'],
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/coupon.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(30, 150, 450, 210),
            ],
            'tags' => ['coupon', 'discount', 'sale', 'sign', 'event'],
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/balloon-purple.png')),
                InputTextLayer::make(
                    strokeSize: 4,
                    strokeColor: Color::fromRgba(83, 30, 85),
                )->setLayerControl(80, 40, 290, 350),
            ],
            'tags' => ['baloon', 'purple', 'event', 'party', 'square'],
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/blackboard.png')),
                InputTextLayer::make()->setLayerControl(85, 130, 320, 210),
            ],
            'tags' => ['blackboard', 'green', 'sign', 'school', 'chalkboard', 'black-board', 'black', 'board'],
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundColorLayer::make(Color::fromRgba(1, 85, 154)),
                InputTextLayer::make(
                    fontSize: 30,
                    verticalAlignment: VerticalAlignment::TOP,
                )->setLayerControl(20, 280, 490, 230),
                BackgroundImageLayer::make($packDisk->path('SpecialImage/loader.png')),
            ],
            'tags' => ['loader', 'loading', 'blue', 'sign', 'event', 'wait', 'waiting', 'load', 'screen', 'loading-screen'],
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/mario.png')),
                InputTextLayer::make(
                    fontColor: Color::fromRgba(230, 0, 20),
                    strokeSize: 2,
                    strokeColor: Color::fromRgba(255, 255, 255),
                    shadowColor: Color::fromRgba(90, 90, 90),
                    shadowOffsetX: 3,
                    shadowOffsetY: 3,
                )->setLayerControl(20, 10, 480, 290),
            ],
            'tags' => ['super', 'mario', 'videogame', 'game', 'nintendo', 'red', 'brother', 'opinion'],
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/red-button2.png')),
                InputTextLayer::make()->setLayerControl(65, 365, 395, 100),
            ],
            'tags' => ['red', 'button', 'sign', 'event'],
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/potato.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(70, 270, 360, 190),
            ],
            'tags' => ['potato', 'yellow', 'sign', 'food', 'vegetable', 'veggie', 'tuber', 'spud', 'root', 'carbohydrate', 'carb', 'carbs'],
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/warning.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(22, 250, 466, 150),
            ],
            'tags' => ['warning', 'sign', 'yellow', 'black'],
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/sonic.png')),
                InputTextLayer::make(
                    fontColor: Color::fromRgba(215, 192, 90),
                    strokeSize: 2,
                )->setLayerControl(30, 130, 290, 250),
            ],
            'tags' => ['sonic', 'videogame', 'game', 'blue', 'hedgehog', 'sega', 'speed', 'fast', 'run', 'running', 'sign'],
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/girl2A.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(120, 280, 300, 230),
                BackgroundImageLayer::make($packDisk->path('SpecialImage/girl2B.png')),
            ],
            'tags' => ['girl', 'manga', 'sign'],
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/girl3.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(80, 290, 420, 220),
            ],
            'tags' => ['girl', 'manga', 'sign'],
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/hamster.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(60, 285, 390, 195),
            ],
            'tags' => ['hamster', 'sign', 'animal', 'pet', 'rodent', 'cute', 'fluffy'],
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/minecraft-sign.png')),
                InputTextLayer::make(
                    fontColor: Color::fromRgba(0, 0, 0),
                    fontFamily: resource_path('fonts/minecraftia.ttf'),
                    baseLine: -0.2
                )->setLayerControl(45, 25, 420, 195),
            ],
            'tags' => ['minecraft', 'sign', 'videogame', 'game', 'wood', 'plank'],
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/bear.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(230, 45, 250, 125),
            ],
            'tags' => ['bear', 'sign', 'angry'],
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/boy1.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(30, 30, 440, 130),
            ],
            'tags' => ['boy', 'manga', 'sign'],
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/boy2.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(110, 245, 290, 195),
            ],
            'tags' => ['boy', 'manga', 'sign'],
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/flanders.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(165, 300, 175, 160),
            ],
            'tags' => ['flanders', 'sign', 'simpson', 'ned', 'cartoon'],
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/girl4.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(15, 210, 265, 290),
            ],
            'tags' => ['girl', 'sign', 'manga', 'sign'],
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/girl5.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(280, 256, 200, 200),
            ],
            'tags' => ['girl', 'sign', 'manga', 'sign'],
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/girl6.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(140, 275, 240, 175),
            ],
            'tags' => ['girl', 'sign', 'manga', 'sign'],
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/kermit.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(145, 310, 235, 170),
            ],
            'tags' => ['kermit', 'frog', 'sign', 'green', 'amphibian', 'animal', 'muppet', 'puppet'],
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/kirbyA.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(40, 50, 280, 310),
                BackgroundImageLayer::make($packDisk->path('SpecialImage/kirbyB.png')),
            ],
            'tags' => ['kirby', 'pink', 'videogame', 'game', 'nintendo', 'cute', 'sign'],
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/patrick.png')),
                InputTextLayer::make(
                    fontColor: Color::fromRgba(0, 0, 0),
                    horizontalAlignment: HorizontalAlignment::LEFT,
                    verticalAlignment: VerticalAlignment::TOP,
                )->setLayerControl(135, 150, 245, 290),
            ],
            'tags' => ['patrick', 'spongebob', 'star', 'fish', 'pink', 'cartoon', 'todo', 'list'],
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/seal.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(45, 30, 435, 150),
            ],
            'tags' => ['seal', 'sign', 'animal', 'sea', 'ocean', 'water', 'cute'],
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/spongebob2.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(45, 50, 400, 90),
            ],
            'tags' => ['spongebob', 'sign', 'lemonade', 'cartoon', 'yellow', 'drink', 'glass', 'cup', 'beverage', 'juice', 'lemon', 'citrus', 'fruit', 'money'],
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/rufyA.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(40, 105, 270, 285),
                BackgroundImageLayer::make($packDisk->path('SpecialImage/rufyB.png')),
            ],
            'tags' => ['rufy', 'one-piece', 'anime', 'manga', 'sign', 'strawhat', 'pirate', 'cartoon', 'monkey', 'luffy', 'rubber', 'gum', 'elastic'],
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/balloon-blue.png')),
                InputTextLayer::make()->setLayerControl(85, 95, 335, 325),
            ],
            'tags' => ['baloon', 'blue', 'circle', 'round'],
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/bugsbunny.png')),
                InputTextLayer::make(Color::fromRgba(255, 255, 255))
                    ->setLayerControl(25, 20, 325, 220),
            ],
            'tags' => ['bugsbunny', 'bunny', 'rabbit', 'cartoon', 'looney', 'tunes', 'warner', 'bros', 'sign', 'red', 'green'],
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/deadpool.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(10, 10, 490, 120),
            ],
            'tags' => ['spiderman', 'deadpool', 'red', 'baloon', 'marvel', 'comics', 'superhero', 'hero', 'antihero'],
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/goodbye.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(8, 50, 210, 270),
            ],
            'tags' => ['goodbye', 'bye', 'farewell', 'see', 'you', 'later', 'baloon', 'purple', 'die', 'dead'],
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/flareonA.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(125, 290, 175, 150),
                BackgroundImageLayer::make($packDisk->path('SpecialImage/flareonB.png')),
            ],
            'tags' => ['flareon', 'pokemon', 'videogame', 'game', 'fire', 'fox', 'orange', 'sign'],
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/willy.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(270, 15, 235, 145),
            ],
            'tags' => ['willy', 'coyote', 'looney', 'tunes', 'warner', 'bros', 'cartoon', 'sign', 'acme'],
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/yugioh.png')),
                InputTextLayer::make(
                    fontColor: Color::fromRgba(0, 0, 0),
                    angle: 10,
                )->setLayerControl(30, 10, 285, 320),
            ],
            'tags' => ['yugioh', 'yu-gi-oh', 'anime', 'manga', 'cartoon', 'pharaoh', 'egyptian', 'cards', 'game', 'duel', 'monsters'],
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/bart-simpsonA.png')),
                InputTextLayer::make(
                    fontColor: Color::fromRgba(255, 255, 255),
                    horizontalAlignment: HorizontalAlignment::LEFT,
                    verticalAlignment: VerticalAlignment::TOP,
                )->setLayerControl(40, 65, 420, 365),
                BackgroundImageLayer::make($packDisk->path('SpecialImage/bart-simpsonB.png')),
            ],
            'tags' => ['bart', 'simpson', 'cartoon', 'green', 'blackboard', 'school', 'chalkboard', 'black-board', 'black', 'board'],
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/dog.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(45, 280, 415, 180),
            ],
            'tags' => ['dog', 'sign', 'furry'],
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/dab.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(50, 330, 275, 150),
            ],
            'tags' => ['girl', 'manga', 'dab', 'sign'],
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/lisa-simpson.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(35, 75, 445, 205),
            ],
            'tags' => ['lisa', 'simpson', 'presentation', 'white', 'explain', 'disappoint'],
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/professor-oak.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(30, 390, 450, 90),
            ],
            'tags' => ['professor', 'oak', 'pokemon', 'baloon', 'white'],
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/spongebob4.png')),
                InputTextLayer::make(
                    fontColor: Color::fromRgba(255, 255, 255),
                    strokeSize: 3,
                    strokeColor: Color::fromRgba(0, 0, 0),
                )->setLayerControl(10, 10, 490, 215),
            ],
            'tags' => ['spongebob', 'rainbow', 'care', 'colors', 'cartoon'],
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/mickey1.png')),
                InputTextLayer::make(
                    fontColor: Color::fromRgba(255, 255, 255),
                    strokeSize: 3,
                    strokeColor: Color::fromRgba(0, 0, 0),
                )->setLayerControl(10, 10, 490, 170),
            ],
            'tags' => ['mickey', 'mouse', 'disney', 'cartoon', 'tool', 'later', 'meme'],
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/mickey2.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(30, 405, 450, 65),
            ],
            'tags' => ['mickey', 'mouse', 'disney', 'cartoon', 'sign'],
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/ampolla.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(148, 315, 218, 100),
            ],
            'tags' => ['ampolla', 'sign', 'purple', 'label'],
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/dinkleberg.png')),
                InputTextLayer::make(
                    fontColor: Color::fromRgba(255, 255, 255),
                    strokeSize: 3,
                    strokeColor: Color::fromRgba(0, 0, 0),
                )->setLayerControl(10, 10, 490, 160),
            ],
            'tags' => ['dinkleberg', 'neighbour', 'cartoon', 'timmy', 'turner', 'odd', 'parents', 'fairy', 'wanda', 'cosmo'],
        ]);
    }
}
