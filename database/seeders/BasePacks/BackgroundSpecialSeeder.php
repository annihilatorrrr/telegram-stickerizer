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

        $pack = Pack::updateOrCreate([
            'code' => $packCode,
        ], [
            'name' => 'Special Image',
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

        $sticker = $pack->stickers()->updateOrCreate([
            'code' => sprintf('%s.%s', $packCode, 'gunter'),
        ], [
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/gunter.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(0, 295, 480, 200),
            ]
        ]);
        $sticker->syncTags(['gunter', 'penguin', 'adventure-time', 'sign']);
        unset($sticker);

        $sticker = $pack->stickers()->updateOrCreate([
            'code' => sprintf('%s.%s', $packCode, 'trashdoves'),
        ], [
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/trashdoves.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(20, 155, 390, 330),
            ]
        ]);
        $sticker->syncTags(['trashdove', 'dove', 'bird', 'facebook', 'sign']);
        unset($sticker);

        $sticker = $pack->stickers()->updateOrCreate([
            'code' => sprintf('%s.%s', $packCode, 'staff'),
        ], [
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/staff.png')),
                InputTextLayer::make(Color::fromRgba(200, 0, 0))
                    ->setLayerControl(35, 30, 420, 110),
            ]
        ]);
        $sticker->syncTags(['staff', 'sound', 'music', 'sign', 'event']);
        unset($sticker);

        $sticker = $pack->stickers()->updateOrCreate([
            'code' => sprintf('%s.%s', $packCode, 'platypus'),
        ], [
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/platypus.png')),
                InputTextLayer::make(
                    fontColor: Color::fromRgba(255, 0, 0),
                    strokeSize: 2,
                    strokeColor: Color::fromRgba(255, 200, 14),
                )->setLayerControl(40, 40, 420, 120),
            ]
        ]);
        $sticker->syncTags(['platypus', 'sign', 'yellow']);
        unset($sticker);

        $sticker = $pack->stickers()->updateOrCreate([
            'code' => sprintf('%s.%s', $packCode, 'yoshi'),
        ], [
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/yoshi.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))->setLayerControl(0, 0, 480, 220),
            ]
        ]);
        $sticker->syncTags(['yoshi', 'baloon', 'green', 'mario', 'nintendo', 'game', 'videogame']);
        unset($sticker);

        $sticker = $pack->stickers()->updateOrCreate([
            'code' => sprintf('%s.%s', $packCode, 'gta'),
        ], [
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundColorLayer::make(Color::fromRgba(0, 0, 0)),
                InputTextLayer::make(
                    fontColor: Color::fromRgba(200, 0, 0),
                    fontFamily: resource_path('fonts/wasted.ttf'),
                ),
            ]
        ]);
        $sticker->syncTags(['wasted', 'gta', 'videogame', 'game', 'red', 'black', 'meme']);
        unset($sticker);

        $sticker = $pack->stickers()->updateOrCreate([
            'code' => sprintf('%s.%s', $packCode, 'minecraft'),
        ], [
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
            ]
        ]);
        $sticker->syncTags(['minecraft', 'videogame', 'game', 'grass', 'dirt', 'brown', 'green']);
        unset($sticker);

        $sticker = $pack->stickers()->updateOrCreate([
            'code' => sprintf('%s.%s', $packCode, 'spongebob1'),
        ], [
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/spongebob1.png')),
                InputTextLayer::make(strokeSize: 3),
            ]
        ]);
        $sticker->syncTags(['spongebob', 'stupid', 'meme', 'yellow', 'grammar']);
        unset($sticker);

        $sticker = $pack->stickers()->updateOrCreate([
            'code' => sprintf('%s.%s', $packCode, 'keepcalm'),
        ], [
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/keepcalm.png')),
                InputTextLayer::make(
                    fontFamily: resource_path('fonts/keepcalm.ttf'),
                )->setLayerControl(20, 275, 460, 230),
            ]
        ]);
        $sticker->syncTags(['keepcalm', 'red', 'white', 'keep-calm', 'calm', 'carry-on']);
        unset($sticker);

        $sticker = $pack->stickers()->updateOrCreate([
            'code' => sprintf('%s.%s', $packCode, 'ghost'),
        ], [
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/ghost.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(20, 20, 480, 180),
            ]
        ]);
        $sticker->syncTags(['ghost', 'boo', 'halloween', 'white', 'scary', 'spooky', 'fear', 'horror', 'sign']);
        unset($sticker);

        $sticker = $pack->stickers()->updateOrCreate([
            'code' => sprintf('%s.%s', $packCode, 'squidward'),
        ], [
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/squidward.png')),
                InputTextLayer::make(
                    strokeSize: 2,
                    strokeColor: Color::fromRgba(0, 0, 0),
                )->setLayerControl(25, 25, 460, 300),
            ]
        ]);
        $sticker->syncTags(['squidward', 'spongebob', 'flex', 'ocean', 'sea', 'blue', 'dab']);
        unset($sticker);

        $sticker = $pack->stickers()->updateOrCreate([
            'code' => sprintf('%s.%s', $packCode, 'jake'),
        ], [
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/jakeA.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(20, 230, 470, 260),
                BackgroundImageLayer::make($packDisk->path('SpecialImage/jakeB.png')),
            ]
        ]);
        $sticker->syncTags(['jake', 'dog', 'adventure-time', 'yellow']);
        unset($sticker);

        $sticker = $pack->stickers()->updateOrCreate([
            'code' => sprintf('%s.%s', $packCode, 'google'),
        ], [
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/google.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(20, 230, 470, 160),
            ]
        ]);
        $sticker->syncTags([
            'google',
            'search',
            'engine',
            'logo',
            'internet',
            'web',
            'www',
            'site',
            'website',
            'search-engine'
        ]);
        unset($sticker);

        $sticker = $pack->stickers()->updateOrCreate([
            'code' => sprintf('%s.%s', $packCode, 'balloon-white'),
        ], [
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/balloon-white.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(90, 135, 335, 205),
            ]
        ]);
        $sticker->syncTags(['baloon', 'white']);
        unset($sticker);

        $sticker = $pack->stickers()->updateOrCreate([
            'code' => sprintf('%s.%s', $packCode, 'balloon-black'),
        ], [
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/balloon-black.png')),
                InputTextLayer::make(Color::fromRgba(255, 255, 255))
                    ->setLayerControl(90, 135, 335, 205),
            ]
        ]);
        $sticker->syncTags(['baloon', 'black']);
        unset($sticker);

        $sticker = $pack->stickers()->updateOrCreate([
            'code' => sprintf('%s.%s', $packCode, 'woman'),
        ], [
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/woman.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(10, 90, 320, 195),
            ]
        ]);
        $sticker->syncTags(['woman', 'sign']);
        unset($sticker);

        $sticker = $pack->stickers()->updateOrCreate([
            'code' => sprintf('%s.%s', $packCode, 'arrow-top'),
        ], [
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/arrow-top.png')),
                InputTextLayer::make()->setLayerControl(0, 215, 500, 290),
            ]
        ]);
        $sticker->syncTags(['arrow', 'top', 'blue', 'sign', 'direction', 'up']);
        unset($sticker);

        $sticker = $pack->stickers()->updateOrCreate([
            'code' => sprintf('%s.%s', $packCode, 'arrow-bottom'),
        ], [
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/arrow-bottom.png')),
                InputTextLayer::make()->setLayerControl(0, 0, 500, 300),
            ]
        ]);
        $sticker->syncTags(['arrow', 'bottome', 'orange', 'sign', 'direction', 'down']);
        unset($sticker);

        $sticker = $pack->stickers()->updateOrCreate([
            'code' => sprintf('%s.%s', $packCode, 'arrow-left'),
        ], [
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/arrow-left.png')),
                InputTextLayer::make()->setLayerControl(0, 0, 500, 250),
            ]
        ]);
        $sticker->syncTags(['arrow', 'left', 'red', 'sign', 'direction']);
        unset($sticker);

        $sticker = $pack->stickers()->updateOrCreate([
            'code' => sprintf('%s.%s', $packCode, 'arrow-top-bottom'),
        ], [
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/arrow-top-bottom.png')),
                InputTextLayer::make()->setLayerControl(0, 140, 500, 230),
            ]
        ]);
        $sticker->syncTags([
            'arrow',
            'top',
            'bottom',
            'green',
            'arrows',
            'sign',
            'direction',
            'directions',
            'up',
            'down'
        ]);
        unset($sticker);

        $sticker = $pack->stickers()->updateOrCreate([
            'code' => sprintf('%s.%s', $packCode, 'girl1'),
        ], [
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/girl1.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(120, 260, 215, 180),
            ]
        ]);
        $sticker->syncTags(['girl', 'manga', 'sign', 'black', 'white']);
        unset($sticker);

        $sticker = $pack->stickers()->updateOrCreate([
            'code' => sprintf('%s.%s', $packCode, 'red-button1'),
        ], [
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/red-button1.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(25, 35, 455, 90),
            ]
        ]);
        $sticker->syncTags(['red', 'button', 'sign', 'event']);
        unset($sticker);

        $sticker = $pack->stickers()->updateOrCreate([
            'code' => sprintf('%s.%s', $packCode, 'stitch'),
        ], [
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
            ]
        ]);
        $sticker->syncTags(['stitch', 'lilo', 'disney', 'blue', 'alien', 'cartoon', 'movie', 'film', 'animation']);
        unset($sticker);

        $sticker = $pack->stickers()->updateOrCreate([
            'code' => sprintf('%s.%s', $packCode, 'coupon'),
        ], [
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/coupon.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(30, 150, 450, 210),
            ]
        ]);
        $sticker->syncTags(['coupon', 'discount', 'sale', 'sign', 'event']);
        unset($sticker);

        $sticker = $pack->stickers()->updateOrCreate([
            'code' => sprintf('%s.%s', $packCode, 'balloon-purple'),
        ], [
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/balloon-purple.png')),
                InputTextLayer::make(
                    strokeSize: 4,
                    strokeColor: Color::fromRgba(83, 30, 85),
                )->setLayerControl(80, 40, 290, 350),
            ]
        ]);
        $sticker->syncTags(['baloon', 'purple', 'event', 'party', 'square']);
        unset($sticker);

        $sticker = $pack->stickers()->updateOrCreate([
            'code' => sprintf('%s.%s', $packCode, 'blackboard'),
        ], [
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/blackboard.png')),
                InputTextLayer::make()->setLayerControl(85, 130, 320, 210),
            ]
        ]);
        $sticker->syncTags(['blackboard', 'green', 'sign', 'school', 'chalkboard', 'black-board', 'black', 'board']);
        unset($sticker);

        $sticker = $pack->stickers()->updateOrCreate([
            'code' => sprintf('%s.%s', $packCode, 'loader'),
        ], [
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundColorLayer::make(Color::fromRgba(1, 85, 154)),
                InputTextLayer::make(
                    fontSize: 30,
                    verticalAlignment: VerticalAlignment::TOP,
                )->setLayerControl(20, 280, 490, 230),
                BackgroundImageLayer::make($packDisk->path('SpecialImage/loader.png')),
            ]
        ]);
        $sticker->syncTags([
            'loader',
            'loading',
            'blue',
            'sign',
            'event',
            'wait',
            'waiting',
            'load',
            'screen',
            'loading-screen'
        ]);
        unset($sticker);

        $sticker = $pack->stickers()->updateOrCreate([
            'code' => sprintf('%s.%s', $packCode, 'mario'),
        ], [
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
            ]
        ]);
        $sticker->syncTags(['super', 'mario', 'videogame', 'game', 'nintendo', 'red', 'brother', 'opinion']);
        unset($sticker);

        $sticker = $pack->stickers()->updateOrCreate([
            'code' => sprintf('%s.%s', $packCode, 'red-button2'),
        ], [
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/red-button2.png')),
                InputTextLayer::make()->setLayerControl(65, 365, 395, 100),
            ]
        ]);
        $sticker->syncTags(['red', 'button', 'sign', 'event']);
        unset($sticker);

        $sticker = $pack->stickers()->updateOrCreate([
            'code' => sprintf('%s.%s', $packCode, 'potato'),
        ], [
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/potato.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(70, 270, 360, 190),
            ]
        ]);
        $sticker->syncTags([
            'potato',
            'yellow',
            'sign',
            'food',
            'vegetable',
            'veggie',
            'tuber',
            'spud',
            'root',
            'carbohydrate',
            'carb',
            'carbs'
        ]);
        unset($sticker);

        $sticker = $pack->stickers()->updateOrCreate([
            'code' => sprintf('%s.%s', $packCode, 'warning'),
        ], [
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/warning.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(22, 250, 466, 150),
            ]
        ]);
        $sticker->syncTags(['warning', 'sign', 'yellow', 'black']);
        unset($sticker);

        $sticker = $pack->stickers()->updateOrCreate([
            'code' => sprintf('%s.%s', $packCode, 'sonic'),
        ], [
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/sonic.png')),
                InputTextLayer::make(
                    fontColor: Color::fromRgba(215, 192, 90),
                    strokeSize: 2,
                )->setLayerControl(30, 130, 290, 250),
            ]
        ]);
        $sticker->syncTags([
            'sonic',
            'videogame',
            'game',
            'blue',
            'hedgehog',
            'sega',
            'speed',
            'fast',
            'run',
            'running',
            'sign'
        ]);
        unset($sticker);

        $sticker = $pack->stickers()->updateOrCreate([
            'code' => sprintf('%s.%s', $packCode, 'girl2'),
        ], [
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/girl2A.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(120, 280, 300, 230),
                BackgroundImageLayer::make($packDisk->path('SpecialImage/girl2B.png')),
            ]
        ]);
        $sticker->syncTags(['girl', 'manga', 'sign']);
        unset($sticker);

        $sticker = $pack->stickers()->updateOrCreate([
            'code' => sprintf('%s.%s', $packCode, 'girl3'),
        ], [
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/girl3.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(80, 290, 420, 220),
            ]
        ]);
        $sticker->syncTags(['girl', 'manga', 'sign']);
        unset($sticker);

        $sticker = $pack->stickers()->updateOrCreate([
            'code' => sprintf('%s.%s', $packCode, 'hamster'),
        ], [
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/hamster.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(60, 285, 390, 195),
            ]
        ]);
        $sticker->syncTags(['hamster', 'sign', 'animal', 'pet', 'rodent', 'cute', 'fluffy']);
        unset($sticker);

        $sticker = $pack->stickers()->updateOrCreate([
            'code' => sprintf('%s.%s', $packCode, 'minecraft-sign'),
        ], [
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/minecraft-sign.png')),
                InputTextLayer::make(
                    fontColor: Color::fromRgba(0, 0, 0),
                    fontFamily: resource_path('fonts/minecraftia.ttf'),
                    baseLine: -0.2
                )->setLayerControl(45, 25, 420, 195),
            ]
        ]);
        $sticker->syncTags(['minecraft', 'sign', 'videogame', 'game', 'wood', 'plank']);
        unset($sticker);

        $sticker = $pack->stickers()->updateOrCreate([
            'code' => sprintf('%s.%s', $packCode, 'bear'),
        ], [
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/bear.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(230, 45, 250, 125),
            ]
        ]);
        $sticker->syncTags(['bear', 'sign', 'angry']);
        unset($sticker);

        $sticker = $pack->stickers()->updateOrCreate([
            'code' => sprintf('%s.%s', $packCode, 'boy1'),
        ], [
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/boy1.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(30, 30, 440, 130),
            ]
        ]);
        $sticker->syncTags(['boy', 'manga', 'sign']);
        unset($sticker);

        $sticker = $pack->stickers()->updateOrCreate([
            'code' => sprintf('%s.%s', $packCode, 'boy2'),
        ], [
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/boy2.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(110, 245, 290, 195),
            ]
        ]);
        $sticker->syncTags(['boy', 'manga', 'sign']);
        unset($sticker);

        $sticker = $pack->stickers()->updateOrCreate([
            'code' => sprintf('%s.%s', $packCode, 'flanders'),
        ], [
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/flanders.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(165, 300, 175, 160),
            ]
        ]);
        $sticker->syncTags(['flanders', 'sign', 'simpson', 'ned', 'cartoon']);
        unset($sticker);

        $sticker = $pack->stickers()->updateOrCreate([
            'code' => sprintf('%s.%s', $packCode, 'girl4'),
        ], [
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/girl4.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(15, 210, 265, 290),
            ]
        ]);
        $sticker->syncTags(['girl', 'sign', 'manga', 'sign']);
        unset($sticker);

        $sticker = $pack->stickers()->updateOrCreate([
            'code' => sprintf('%s.%s', $packCode, 'girl5'),
        ], [
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/girl5.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(280, 256, 200, 200),
            ]
        ]);
        $sticker->syncTags(['girl', 'sign', 'manga', 'sign']);
        unset($sticker);

        $sticker = $pack->stickers()->updateOrCreate([
            'code' => sprintf('%s.%s', $packCode, 'girl6'),
        ], [
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/girl6.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(140, 275, 240, 175),
            ]
        ]);
        $sticker->syncTags(['girl', 'sign', 'manga', 'sign']);
        unset($sticker);

        $sticker = $pack->stickers()->updateOrCreate([
            'code' => sprintf('%s.%s', $packCode, 'kermit'),
        ], [
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/kermit.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(145, 310, 235, 170),
            ]
        ]);
        $sticker->syncTags(['kermit', 'frog', 'sign', 'green', 'amphibian', 'animal', 'muppet', 'puppet']);
        unset($sticker);

        $sticker = $pack->stickers()->updateOrCreate([
            'code' => sprintf('%s.%s', $packCode, 'kirby'),
        ], [
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/kirbyA.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(40, 50, 280, 310),
                BackgroundImageLayer::make($packDisk->path('SpecialImage/kirbyB.png')),
            ]
        ]);
        $sticker->syncTags(['kirby', 'pink', 'videogame', 'game', 'nintendo', 'cute', 'sign']);
        unset($sticker);

        $sticker = $pack->stickers()->updateOrCreate([
            'code' => sprintf('%s.%s', $packCode, 'patrick'),
        ], [
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/patrick.png')),
                InputTextLayer::make(
                    fontColor: Color::fromRgba(0, 0, 0),
                    horizontalAlignment: HorizontalAlignment::LEFT,
                    verticalAlignment: VerticalAlignment::TOP,
                )->setLayerControl(135, 150, 245, 290),
            ]
        ]);
        $sticker->syncTags(['patrick', 'spongebob', 'star', 'fish', 'pink', 'cartoon', 'todo', 'list']);
        unset($sticker);

        $sticker = $pack->stickers()->updateOrCreate([
            'code' => sprintf('%s.%s', $packCode, 'seal'),
        ], [
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/seal.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(45, 30, 435, 150),
            ]
        ]);
        $sticker->syncTags(['seal', 'sign', 'animal', 'sea', 'ocean', 'water', 'cute']);
        unset($sticker);

        $sticker = $pack->stickers()->updateOrCreate([
            'code' => sprintf('%s.%s', $packCode, 'spongebob2'),
        ], [
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/spongebob2.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(45, 50, 400, 90),
            ]
        ]);
        $sticker->syncTags([
            'spongebob',
            'sign',
            'lemonade',
            'cartoon',
            'yellow',
            'drink',
            'glass',
            'cup',
            'beverage',
            'juice',
            'lemon',
            'citrus',
            'fruit',
            'money'
        ]);
        unset($sticker);

        $sticker = $pack->stickers()->updateOrCreate([
            'code' => sprintf('%s.%s', $packCode, 'rufy'),
        ], [
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/rufyA.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(40, 105, 270, 285),
                BackgroundImageLayer::make($packDisk->path('SpecialImage/rufyB.png')),
            ]
        ]);
        $sticker->syncTags([
            'rufy',
            'one-piece',
            'anime',
            'manga',
            'sign',
            'strawhat',
            'pirate',
            'cartoon',
            'monkey',
            'luffy',
            'rubber',
            'gum',
            'elastic'
        ]);
        unset($sticker);

        $sticker = $pack->stickers()->updateOrCreate([
            'code' => sprintf('%s.%s', $packCode, 'balloon-blue'),
        ], [
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/balloon-blue.png')),
                InputTextLayer::make()->setLayerControl(85, 95, 335, 325),
            ]
        ]);
        $sticker->syncTags(['baloon', 'blue', 'circle', 'round']);
        unset($sticker);

        $sticker = $pack->stickers()->updateOrCreate([
            'code' => sprintf('%s.%s', $packCode, 'bugsbunny'),
        ], [
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/bugsbunny.png')),
                InputTextLayer::make(Color::fromRgba(255, 255, 255))
                    ->setLayerControl(25, 20, 325, 220),
            ]
        ]);
        $sticker->syncTags([
            'bugsbunny',
            'bunny',
            'rabbit',
            'cartoon',
            'looney',
            'tunes',
            'warner',
            'bros',
            'sign',
            'red',
            'green'
        ]);
        unset($sticker);

        $sticker = $pack->stickers()->updateOrCreate([
            'code' => sprintf('%s.%s', $packCode, 'deadpool'),
        ], [
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/deadpool.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(10, 10, 490, 120),
            ]
        ]);
        $sticker->syncTags([
            'spiderman',
            'deadpool',
            'red',
            'baloon',
            'marvel',
            'comics',
            'superhero',
            'hero',
            'antihero'
        ]);
        unset($sticker);

        $sticker = $pack->stickers()->updateOrCreate([
            'code' => sprintf('%s.%s', $packCode, 'goodbye'),
        ], [
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/goodbye.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(8, 50, 210, 270),
            ]
        ]);
        $sticker->syncTags(['goodbye', 'bye', 'farewell', 'see', 'you', 'later', 'baloon', 'purple', 'die', 'dead']);
        unset($sticker);

        $sticker = $pack->stickers()->updateOrCreate([
            'code' => sprintf('%s.%s', $packCode, 'flareon'),
        ], [
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/flareonA.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(125, 290, 175, 150),
                BackgroundImageLayer::make($packDisk->path('SpecialImage/flareonB.png')),
            ]
        ]);
        $sticker->syncTags(['flareon', 'pokemon', 'videogame', 'game', 'fire', 'fox', 'orange', 'sign']);
        unset($sticker);

        $sticker = $pack->stickers()->updateOrCreate([
            'code' => sprintf('%s.%s', $packCode, 'willy'),
        ], [
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/willy.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(270, 15, 235, 145),
            ]
        ]);
        $sticker->syncTags(['willy', 'coyote', 'looney', 'tunes', 'warner', 'bros', 'cartoon', 'sign', 'acme']);
        unset($sticker);

        $sticker = $pack->stickers()->updateOrCreate([
            'code' => sprintf('%s.%s', $packCode, 'yugioh'),
        ], [
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/yugioh.png')),
                InputTextLayer::make(
                    fontColor: Color::fromRgba(0, 0, 0),
                    angle: 10,
                )->setLayerControl(30, 10, 285, 320),
            ]
        ]);
        $sticker->syncTags([
            'yugioh',
            'yu-gi-oh',
            'anime',
            'manga',
            'cartoon',
            'pharaoh',
            'egyptian',
            'cards',
            'game',
            'duel',
            'monsters'
        ]);
        unset($sticker);

        $sticker = $pack->stickers()->updateOrCreate([
            'code' => sprintf('%s.%s', $packCode, 'bart-simpson'),
        ], [
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
            ]
        ]);
        $sticker->syncTags([
            'bart',
            'simpson',
            'cartoon',
            'green',
            'blackboard',
            'school',
            'chalkboard',
            'black-board',
            'black',
            'board'
        ]);
        unset($sticker);

        $sticker = $pack->stickers()->updateOrCreate([
            'code' => sprintf('%s.%s', $packCode, 'dog'),
        ], [
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/dog.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(45, 280, 415, 180),
            ]
        ]);
        $sticker->syncTags(['dog', 'sign', 'furry']);
        unset($sticker);

        $sticker = $pack->stickers()->updateOrCreate([
            'code' => sprintf('%s.%s', $packCode, 'dab'),
        ], [
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/dab.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(50, 330, 275, 150),
            ]
        ]);
        $sticker->syncTags(['girl', 'manga', 'dab', 'sign']);
        unset($sticker);

        $sticker = $pack->stickers()->updateOrCreate([
            'code' => sprintf('%s.%s', $packCode, 'lisa-simpson'),
        ], [
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/lisa-simpson.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(35, 75, 445, 205),
            ]
        ]);
        $sticker->syncTags(['lisa', 'simpson', 'presentation', 'white', 'explain', 'disappoint']);
        unset($sticker);

        $sticker = $pack->stickers()->updateOrCreate([
            'code' => sprintf('%s.%s', $packCode, 'professor-oak'),
        ], [
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/professor-oak.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(30, 390, 450, 90),
            ]
        ]);
        $sticker->syncTags(['professor', 'oak', 'pokemon', 'baloon', 'white']);
        unset($sticker);

        $sticker = $pack->stickers()->updateOrCreate([
            'code' => sprintf('%s.%s', $packCode, 'spongebob4'),
        ], [
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/spongebob4.png')),
                InputTextLayer::make(
                    fontColor: Color::fromRgba(255, 255, 255),
                    strokeSize: 3,
                    strokeColor: Color::fromRgba(0, 0, 0),
                )->setLayerControl(10, 10, 490, 215),
            ]
        ]);
        $sticker->syncTags(['spongebob', 'rainbow', 'care', 'colors', 'cartoon']);
        unset($sticker);

        $sticker = $pack->stickers()->updateOrCreate([
            'code' => sprintf('%s.%s', $packCode, 'mickey1'),
        ], [
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/mickey1.png')),
                InputTextLayer::make(
                    fontColor: Color::fromRgba(255, 255, 255),
                    strokeSize: 3,
                    strokeColor: Color::fromRgba(0, 0, 0),
                )->setLayerControl(10, 10, 490, 170),
            ]
        ]);
        $sticker->syncTags(['mickey', 'mouse', 'disney', 'cartoon', 'tool', 'later', 'meme']);
        unset($sticker);

        $sticker = $pack->stickers()->updateOrCreate([
            'code' => sprintf('%s.%s', $packCode, 'mickey2'),
        ], [
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/mickey2.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(30, 405, 450, 65),
            ]
        ]);
        $sticker->syncTags(['mickey', 'mouse', 'disney', 'cartoon', 'sign']);
        unset($sticker);

        $sticker = $pack->stickers()->updateOrCreate([
            'code' => sprintf('%s.%s', $packCode, 'ampolla'),
        ], [
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/ampolla.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(148, 315, 218, 100),
            ]
        ]);
        $sticker->syncTags(['ampolla', 'sign', 'purple', 'label']);
        unset($sticker);

        $sticker = $pack->stickers()->updateOrCreate([
            'code' => sprintf('%s.%s', $packCode, 'dinkleberg'),
        ], [
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packDisk->path('SpecialImage/dinkleberg.png')),
                InputTextLayer::make(
                    fontColor: Color::fromRgba(255, 255, 255),
                    strokeSize: 3,
                    strokeColor: Color::fromRgba(0, 0, 0),
                )->setLayerControl(10, 10, 490, 160),
            ]
        ]);
        $sticker->syncTags([
            'dinkleberg',
            'neighbour',
            'cartoon',
            'timmy',
            'turner',
            'odd',
            'parents',
            'fairy',
            'wanda',
            'cosmo'
        ]);
        unset($sticker);
    }
}
