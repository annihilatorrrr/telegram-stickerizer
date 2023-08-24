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
        ]);

        $packsDisk = Storage::disk('packs');

        File::copyDirectory(
            resource_path('img/BasePacks/SpecialImage/'),
            $packsDisk->path('SpecialImage')
        );

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packsDisk->path('SpecialImage/gunter.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(0, 295, 480, 200),
            ]
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packsDisk->path('SpecialImage/trashdoves.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(20, 155, 390, 330),
            ]
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packsDisk->path('SpecialImage/staff.png')),
                InputTextLayer::make(Color::fromRgba(200, 0, 0))
                    ->setLayerControl(35, 30, 420, 110),
            ]
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packsDisk->path('SpecialImage/platypus.png')),
                InputTextLayer::make(
                    fontColor: Color::fromRgba(255, 0, 0),
                    strokeSize: 2,
                    strokeColor: Color::fromRgba(255, 200, 14),
                )->setLayerControl(40, 40, 420, 120),
            ]
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packsDisk->path('SpecialImage/yoshi.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))->setLayerControl(0, 0, 480, 220),
            ]
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
            ]
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packsDisk->path('SpecialImage/minecraft.png')),
                InputTextLayer::make(
                    fontColor: Color::fromRgba(255, 255, 255),
                    fontFamily: resource_path('fonts/minecraftia.ttf'),
                    strokeSize: 3,
                    strokeColor: Color::fromRgba(0, 0, 0),
                    lineHeight: 1.2,
                    baseLine: -0.5,
                ),
            ]
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packsDisk->path('SpecialImage/spongebob1.png')),
                InputTextLayer::make(strokeSize: 3),
            ]
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packsDisk->path('SpecialImage/keepcalm.png')),
                InputTextLayer::make(
                    fontFamily: resource_path('fonts/keepcalm.ttf'),
                    lineHeight: 1.2,
                )->setLayerControl(20, 275, 460, 230),
            ]
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packsDisk->path('SpecialImage/ghost.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(20, 20, 480, 180),
            ]
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packsDisk->path('SpecialImage/squidward.png')),
                InputTextLayer::make(
                    strokeSize: 2,
                    strokeColor: Color::fromRgba(0, 0, 0),
                )->setLayerControl(25, 25, 460, 300),
            ]
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packsDisk->path('SpecialImage/jakeA.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(20, 230, 470, 260),
                BackgroundImageLayer::make($packsDisk->path('SpecialImage/jakeB.png')),
            ]
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packsDisk->path('SpecialImage/google.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(20, 230, 470, 160),
            ]
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packsDisk->path('SpecialImage/balloon-white.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(90, 135, 335, 205),
            ]
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packsDisk->path('SpecialImage/balloon-black.png')),
                InputTextLayer::make(Color::fromRgba(255, 255, 255))
                    ->setLayerControl(90, 135, 335, 205),
            ]
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packsDisk->path('SpecialImage/woman.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(10, 90, 320, 195),
            ]
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packsDisk->path('SpecialImage/arrow-top.png')),
                InputTextLayer::make()->setLayerControl(0, 215, 500, 290),
            ]
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packsDisk->path('SpecialImage/arrow-bottom.png')),
                InputTextLayer::make()->setLayerControl(0, 0, 500, 300),
            ]
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packsDisk->path('SpecialImage/arrow-left.png')),
                InputTextLayer::make()->setLayerControl(0, 0, 500, 250),
            ]
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packsDisk->path('SpecialImage/arrow-top-bottom.png')),
                InputTextLayer::make()->setLayerControl(0, 140, 500, 230),
            ]
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packsDisk->path('SpecialImage/girl1.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(120, 260, 215, 180),
            ]
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packsDisk->path('SpecialImage/red-button1.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(25, 35, 455, 90),
            ]
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packsDisk->path('SpecialImage/stitch.png')),
                InputTextLayer::make(
                    fontColor: Color::fromRgba(244, 154, 189),
                    fontFamily: resource_path('fonts/fingerpaint.ttf'),
                    strokeSize: 2,
                    strokeColor: Color::fromRgba(0, 0, 0),
                )->setLayerControl(10, 10, 500, 160),
            ]
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packsDisk->path('SpecialImage/coupon.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(30, 150, 450, 210),
            ]
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packsDisk->path('SpecialImage/balloon-purple.png')),
                InputTextLayer::make(
                    strokeSize: 4,
                    strokeColor: Color::fromRgba(83, 30, 85),
                    lineHeight: 1.2,
                )->setLayerControl(80, 40, 290, 350),
            ]
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packsDisk->path('SpecialImage/blackboard.png')),
                InputTextLayer::make()->setLayerControl(85, 130, 320, 210),
            ]
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundColorLayer::make(Color::fromRgba(1, 85, 154)),
                InputTextLayer::make(
                    fontSize: 30,
                    verticalAlignment: VerticalAlignment::TOP,
                    lineHeight: 1.2,
                )->setLayerControl(20, 280, 490, 230),
                BackgroundImageLayer::make($packsDisk->path('SpecialImage/loader.png')),
            ]
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packsDisk->path('SpecialImage/mario.png')),
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

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packsDisk->path('SpecialImage/red-button2.png')),
                InputTextLayer::make()->setLayerControl(65, 365, 395, 100),
            ]
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packsDisk->path('SpecialImage/potato.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(70, 270, 360, 190),
            ]
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packsDisk->path('SpecialImage/warning.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(22, 250, 466, 150),
            ]
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packsDisk->path('SpecialImage/sonic.png')),
                InputTextLayer::make(
                    fontColor: Color::fromRgba(215, 192, 90),
                    strokeSize: 2,
                )->setLayerControl(30, 130, 290, 250),
            ]
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packsDisk->path('SpecialImage/girl2A.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(120, 280, 300, 230),
                BackgroundImageLayer::make($packsDisk->path('SpecialImage/girl2B.png')),
            ]
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packsDisk->path('SpecialImage/girl3.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(80, 290, 420, 220),
            ]
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packsDisk->path('SpecialImage/hamster.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(60, 285, 390, 195),
            ]
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packsDisk->path('SpecialImage/minecraft-sign.png')),
                InputTextLayer::make(
                    fontColor: Color::fromRgba(0, 0, 0),
                    fontFamily: resource_path('fonts/minecraftia.ttf'),
                    lineHeight: 1.2,
                    baseLine: -0.2
                )->setLayerControl(45, 25, 420, 195),
            ]
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packsDisk->path('SpecialImage/bear.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(230, 45, 250, 125),
            ]
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packsDisk->path('SpecialImage/boy1.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(30, 30, 440, 130),
            ]
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packsDisk->path('SpecialImage/boy2.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(110, 245, 290, 195),
            ]
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packsDisk->path('SpecialImage/flanders.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(165, 300, 175, 160),
            ]
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packsDisk->path('SpecialImage/girl4.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(15, 210, 265, 290),
            ]
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packsDisk->path('SpecialImage/girl5.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(280, 256, 200, 200),
            ]
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packsDisk->path('SpecialImage/girl6.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(140, 275, 240, 175),
            ]
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packsDisk->path('SpecialImage/kermit.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(145, 310, 235, 170),
            ]
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packsDisk->path('SpecialImage/kirbyA.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(40, 50, 280, 310),
                BackgroundImageLayer::make($packsDisk->path('SpecialImage/kirbyB.png')),
            ]
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packsDisk->path('SpecialImage/patrick.png')),
                InputTextLayer::make(
                    fontColor: Color::fromRgba(0, 0, 0),
                    horizontalAlignment: HorizontalAlignment::LEFT,
                    verticalAlignment: VerticalAlignment::TOP,
                )->setLayerControl(135, 150, 245, 290),
            ]
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packsDisk->path('SpecialImage/seal.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(45, 30, 435, 150),
            ]
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packsDisk->path('SpecialImage/spongebob2.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(45, 50, 400, 90),
            ]
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packsDisk->path('SpecialImage/rufyA.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(40, 105, 270, 285),
                BackgroundImageLayer::make($packsDisk->path('SpecialImage/rufyB.png')),
            ]
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packsDisk->path('SpecialImage/balloon-blue.png')),
                InputTextLayer::make()->setLayerControl(85, 95, 335, 325),
            ]
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packsDisk->path('SpecialImage/bugsbunny.png')),
                InputTextLayer::make(Color::fromRgba(255, 255, 255))
                    ->setLayerControl(25, 20, 325, 220),
            ]
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packsDisk->path('SpecialImage/deadpool.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(10, 10, 490, 120),
            ]
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packsDisk->path('SpecialImage/goodbye.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(8, 50, 210, 270),
            ]
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packsDisk->path('SpecialImage/flareonA.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(125, 290, 175, 150),
                BackgroundImageLayer::make($packsDisk->path('SpecialImage/flareonB.png')),
            ]
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packsDisk->path('SpecialImage/willy.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(270, 15, 235, 145),
            ]
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packsDisk->path('SpecialImage/yugioh.png')),
                InputTextLayer::make(
                    fontColor: Color::fromRgba(0, 0, 0),
                    angle: 10,
                )->setLayerControl(30, 10, 285, 320),
            ]
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packsDisk->path('SpecialImage/bart-simpsonA.png')),
                InputTextLayer::make(
                    fontColor: Color::fromRgba(255, 255, 255),
                    horizontalAlignment: HorizontalAlignment::LEFT,
                    verticalAlignment: VerticalAlignment::TOP,
                )->setLayerControl(40, 65, 420, 365),
                BackgroundImageLayer::make($packsDisk->path('SpecialImage/bart-simpsonB.png')),
            ]
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packsDisk->path('SpecialImage/dog.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(45, 280, 415, 180),
            ]
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packsDisk->path('SpecialImage/dab.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(50, 330, 275, 150),
            ]
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packsDisk->path('SpecialImage/lisa-simpson.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(35, 75, 445, 205),
            ]
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packsDisk->path('SpecialImage/professor-oak.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(30, 390, 450, 90),
            ]
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packsDisk->path('SpecialImage/spongebob4.png')),
                InputTextLayer::make(
                    fontColor: Color::fromRgba(255, 255, 255),
                    strokeSize: 3,
                    strokeColor: Color::fromRgba(0, 0, 0),
                )->setLayerControl(10, 10, 490, 215),
            ]
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packsDisk->path('SpecialImage/mickey1.png')),
                InputTextLayer::make(
                    fontColor: Color::fromRgba(255, 255, 255),
                    strokeSize: 3,
                    strokeColor: Color::fromRgba(0, 0, 0),
                )->setLayerControl(10, 10, 490, 170),
            ]
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packsDisk->path('SpecialImage/mickey2.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(30, 405, 450, 65),
            ]
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packsDisk->path('SpecialImage/ampolla.png')),
                InputTextLayer::make(Color::fromRgba(0, 0, 0))
                    ->setLayerControl(148, 315, 218, 100),
            ]
        ]);

        $pack->stickers()->create([
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make($packsDisk->path('SpecialImage/dinkleberg.png')),
                InputTextLayer::make(
                    fontColor: Color::fromRgba(255, 255, 255),
                    strokeSize: 3,
                    strokeColor: Color::fromRgba(0, 0, 0),
                )->setLayerControl(10, 10, 490, 160),
            ]
        ]);
    }
}
