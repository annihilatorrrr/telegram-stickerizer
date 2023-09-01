<?php

namespace Database\Seeders\BasePacks;

use App\Models\Pack;
use App\Stickerizer\Layers\BackgroundImageLayer;
use App\Stickerizer\Layers\InputTextLayer;
use App\Stickerizer\Styles\Color;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class BackgroundImageSeeder extends Seeder
{
    public function run(): void
    {
        $packCode = 'BackgroundImage';

        if (Pack::where('code', $packCode)->exists()) {
            $this->command->line('Skipping ' . $packCode . ' pack creation, already exists');
            return;
        }

        $pack = Pack::create([
            'name' => 'Background Image',
            'code' => $packCode,
            'tags' => [
                'text-monochrome',
                'monochrome-text',
                'image-background',
                'facebook',
                'events',
                'image',
            ],
        ]);

        File::copyDirectory(
            resource_path('img/BasePacks/BackgroundImage/'),
            Storage::disk('packs')->path('BackgroundImage')
        );

        $pack->stickers()->create($this->createSticker('arrows.png', ['arrows', 'blue', 'red', 'gradient']));
        $pack->stickers()->create($this->createSticker('baloons.png', ['baloons', 'blue', 'cyan', 'party', 'heart']));
        $pack->stickers()->create($this->createSticker('beach.png', ['beach', 'blue', 'sky', 'clouds', 'cyan']));
        $pack->stickers()->create($this->createSticker('birthday.png', ['birthday', 'cake', 'party', 'blue', 'event']));
        $pack->stickers()->create($this->createSticker('cake.png', ['cake', 'icecream', 'pink', 'party', 'event']));
        $pack->stickers()->create($this->createSticker('cancel.png', ['cancel', 'red', 'gray', 'cross', 'x']));
        $pack->stickers()->create($this->createSticker('christmas.png', ['christmas', 'tree', 'snow', 'winter', 'event', 'red', 'white']));
        $pack->stickers()->create($this->createSticker('cold.png', ['cold', 'purple', 'pink', 'cyan', 'blue', 'gradient']));
        $pack->stickers()->create($this->createSticker('decoration.png', ['decoration', 'purple', 'abstract', 'flowers']));
        $pack->stickers()->create($this->createSticker('diamond.png', ['diamond', 'red', 'jewelry']));
        $pack->stickers()->create($this->createSticker('fall.png', ['fall', 'autumn', 'orange', 'yellow', 'brown', 'tree', 'leafs', 'sky']));
        $pack->stickers()->create($this->createSticker('fast.png', ['fast', 'speed', 'flash', 'orange', 'purple', 'lightning', 'yellow', 'thunder']));
        $pack->stickers()->create($this->createSticker('flower.png', ['flower', 'yellow', 'green', 'pink', 'lines', 'tulip']));
        $pack->stickers()->create($this->createSticker('flowers.png', ['flowers', 'pink', 'green', 'orange', 'bee']));
        $pack->stickers()->create($this->createSticker('fun.png', ['fun', 'event', 'party', 'yellow', 'orange', 'red', 'blue', 'black', 'decoration']));
        $pack->stickers()->create($this->createSticker('gifts.png', ['gifts', 'event', 'party', 'gray', 'yellow', 'red', 'green', 'cyan']));
        $pack->stickers()->create($this->createSticker('gloves.png', ['gloves', 'cyan', 'blue', 'winter', 'cold']));
        $pack->stickers()->create($this->createSticker('happy.png', ['happy', 'event', 'party', 'yellow', 'orange', 'red', 'blue', 'decoration']));
        $pack->stickers()->create($this->createSticker('holiday.png', ['holiday', 'pink', 'sky', 'star', 'night', 'comet', 'purple', 'yellow', 'orange', 'gradient']));
        $pack->stickers()->create($this->createSticker('hot.png', ['hot', 'yellow', 'orange', 'pink', 'purple', 'gradient']));
        $pack->stickers()->create($this->createSticker('hug.png', ['hug', 'hands', 'blue', 'cyan', 'fingers', 'clock']));
        $pack->stickers()->create($this->createSticker('ice.png', ['ice', 'penguin', 'cold', 'winter', 'blue', 'white', 'fishing']));
        $pack->stickers()->create($this->createSticker('leaves.png', ['leaves', 'green']));
        $pack->stickers()->create($this->createSticker('love.png', ['love', 'heart', 'red', 'baloon']));
        $pack->stickers()->create($this->createSticker('melon.png', ['melon', 'watermelon', 'green', 'red', 'fruit', 'seeds', 'white']));
        $pack->stickers()->create($this->createSticker('music.png', ['music', 'pink', 'red', 'black', 'cyan', 'gray', 'table', 'gramophone', 'vinil']));
        $pack->stickers()->create($this->createSticker('news.png', ['news', 'white', 'cyan', 'blue', 'surprise', 'event']));
        $pack->stickers()->create($this->createSticker('night.png', ['night', 'sky', 'stars', 'moon', 'comet', 'blue', 'yellow', 'white', 'clouds']));
        $pack->stickers()->create($this->createSticker('peace.png', ['peace', 'green']));
        $pack->stickers()->create($this->createSticker('pencils.png', ['pencils', 'eraser', 'pink', 'purple', 'indigo', 'white']));
        $pack->stickers()->create($this->createSticker('sky.png', ['sky', 'clouds', 'blue', 'white', 'cyan', 'birds']));
        $pack->stickers()->create($this->createSticker('snow.png', ['snow', 'white', 'blue', 'cyan', 'sky', 'winter', 'cold']));
        $pack->stickers()->create($this->createSticker('soccer.png', ['soccer', 'ball', 'green', 'white', 'sport', 'football']));
        $pack->stickers()->create($this->createSticker('space.png', ['space', 'abstract', 'satellite', 'stars', 'purple', 'planets', 'geometry']));
        $pack->stickers()->create($this->createSticker('spring.png', ['spring', 'flowers', 'green', 'yellow', 'red', 'white']));
        $pack->stickers()->create($this->createSticker('sun.png', ['sun', 'gradient', 'yellow', 'orange']));
        $pack->stickers()->create($this->createSticker('sunset.png', ['sunset', 'sky', 'sun', 'sea', 'ocean', 'gradient', 'blue', 'white', 'black']));
        $pack->stickers()->create($this->createSticker('trees.png', ['trees', 'red', 'black', 'winter', 'cold', 'snow']));
        $pack->stickers()->create($this->createSticker('vinil.png', ['vinil', 'music', 'song', 'black', 'orange', 'gren', 'table']));
        $pack->stickers()->create($this->createSticker('violet.png', ['violet', 'gradient', 'purple', 'pink', 'violet']));
    }

    protected function createSticker(string $imagePath, array $tags = []): array
    {
        return [
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make(Storage::disk('packs')->path('BackgroundImage/'.$imagePath)),
                InputTextLayer::make(
                    fontColor: Color::fromRgba(255, 255, 255),
                    strokeSize: 2,
                    strokeColor: Color::fromRgba(0, 0, 0),
                ),
            ],
            'tags' => $tags,
        ];
    }
}
