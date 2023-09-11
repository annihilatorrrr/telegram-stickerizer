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

        $pack = Pack::updateOrCreate([
            'code' => $packCode,
        ], [
            'name' => 'Background Image',
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

        $sticker = $pack->stickers()->updateOrCreate(...$this->createSticker($packCode, 'arrows'));
        $sticker->syncTags(['arrows', 'blue', 'red', 'gradient']);
        unset($sticker);

        $sticker = $pack->stickers()->updateOrCreate(...$this->createSticker($packCode, 'baloons'));
        $sticker->syncTags(['baloons', 'blue', 'cyan', 'party', 'heart']);
        unset($sticker);

        $sticker = $pack->stickers()->updateOrCreate(...$this->createSticker($packCode, 'beach'));
        $sticker->syncTags(['beach', 'blue', 'sky', 'clouds', 'cyan']);
        unset($sticker);

        $sticker = $pack->stickers()->updateOrCreate(...$this->createSticker($packCode, 'birthday'));
        $sticker->syncTags(['birthday', 'cake', 'party', 'blue', 'event']);
        unset($sticker);

        $sticker = $pack->stickers()->updateOrCreate(...$this->createSticker($packCode, 'cake'));
        $sticker->syncTags(['cake', 'icecream', 'pink', 'party', 'event']);
        unset($sticker);

        $sticker = $pack->stickers()->updateOrCreate(...$this->createSticker($packCode, 'cancel'));
        $sticker->syncTags(['cancel', 'red', 'gray', 'cross', 'x']);
        unset($sticker);

        $sticker = $pack->stickers()->updateOrCreate(...$this->createSticker($packCode, 'christmas'));
        $sticker->syncTags(['christmas', 'tree', 'snow', 'winter', 'event', 'red', 'white']);
        unset($sticker);

        $sticker = $pack->stickers()->updateOrCreate(...$this->createSticker($packCode, 'cold'));
        $sticker->syncTags(['cold', 'purple', 'pink', 'cyan', 'blue', 'gradient']);
        unset($sticker);

        $sticker = $pack->stickers()->updateOrCreate(...$this->createSticker($packCode, 'decoration'));
        $sticker->syncTags(['decoration', 'purple', 'abstract', 'flowers']);
        unset($sticker);

        $sticker = $pack->stickers()->updateOrCreate(...$this->createSticker($packCode, 'diamond'));
        $sticker->syncTags(['diamond', 'red', 'jewelry']);
        unset($sticker);

        $sticker = $pack->stickers()->updateOrCreate(...$this->createSticker($packCode, 'fall'));
        $sticker->syncTags(['fall', 'autumn', 'orange', 'yellow', 'brown', 'tree', 'leafs', 'sky']);
        unset($sticker);

        $sticker = $pack->stickers()->updateOrCreate(...$this->createSticker($packCode, 'fast'));
        $sticker->syncTags(['fast', 'speed', 'flash', 'orange', 'purple', 'lightning', 'yellow', 'thunder']);
        unset($sticker);

        $sticker = $pack->stickers()->updateOrCreate(...$this->createSticker($packCode, 'flower'));
        $sticker->syncTags(['flower', 'yellow', 'green', 'pink', 'lines', 'tulip']);
        unset($sticker);

        $sticker = $pack->stickers()->updateOrCreate(...$this->createSticker($packCode, 'flowers'));
        $sticker->syncTags(['flowers', 'pink', 'green', 'orange', 'bee']);
        unset($sticker);

        $sticker = $pack->stickers()->updateOrCreate(...$this->createSticker($packCode, 'fun'));
        $sticker->syncTags(['fun', 'event', 'party', 'yellow', 'orange', 'red', 'blue', 'black', 'decoration']);
        unset($sticker);

        $sticker = $pack->stickers()->updateOrCreate(...$this->createSticker($packCode, 'gifts'));
        $sticker->syncTags(['gifts', 'event', 'party', 'gray', 'yellow', 'red', 'green', 'cyan']);
        unset($sticker);

        $sticker = $pack->stickers()->updateOrCreate(...$this->createSticker($packCode, 'gloves'));
        $sticker->syncTags(['gloves', 'cyan', 'blue', 'winter', 'cold']);
        unset($sticker);

        $sticker = $pack->stickers()->updateOrCreate(...$this->createSticker($packCode, 'happy'));
        $sticker->syncTags(['happy', 'event', 'party', 'yellow', 'orange', 'red', 'blue', 'decoration']);
        unset($sticker);

        $sticker = $pack->stickers()->updateOrCreate(...$this->createSticker($packCode, 'holiday'));
        $sticker->syncTags([
            'holiday',
            'pink',
            'sky',
            'star',
            'night',
            'comet',
            'purple',
            'yellow',
            'orange',
            'gradient'
        ]);
        unset($sticker);

        $sticker = $pack->stickers()->updateOrCreate(...$this->createSticker($packCode, 'hot'));
        $sticker->syncTags(['hot', 'yellow', 'orange', 'pink', 'purple', 'gradient']);
        unset($sticker);

        $sticker = $pack->stickers()->updateOrCreate(...$this->createSticker($packCode, 'hug'));
        $sticker->syncTags(['hug', 'hands', 'blue', 'cyan', 'fingers', 'clock']);
        unset($sticker);

        $sticker = $pack->stickers()->updateOrCreate(...$this->createSticker($packCode, 'ice'));
        $sticker->syncTags(['ice', 'penguin', 'cold', 'winter', 'blue', 'white', 'fishing']);
        unset($sticker);

        $sticker = $pack->stickers()->updateOrCreate(...$this->createSticker($packCode, 'leaves'));
        $sticker->syncTags(['leaves', 'green']);
        unset($sticker);

        $sticker = $pack->stickers()->updateOrCreate(...$this->createSticker($packCode, 'love'));
        $sticker->syncTags(['love', 'heart', 'red', 'baloon']);
        unset($sticker);

        $sticker = $pack->stickers()->updateOrCreate(...$this->createSticker($packCode, 'melon'));
        $sticker->syncTags(['melon', 'watermelon', 'green', 'red', 'fruit', 'seeds', 'white']);
        unset($sticker);

        $sticker = $pack->stickers()->updateOrCreate(...$this->createSticker($packCode, 'music'));
        $sticker->syncTags(['music', 'pink', 'red', 'black', 'cyan', 'gray', 'table', 'gramophone', 'vinil']);
        unset($sticker);

        $sticker = $pack->stickers()->updateOrCreate(...$this->createSticker($packCode, 'news'));
        $sticker->syncTags(['news', 'white', 'cyan', 'blue', 'surprise', 'event']);
        unset($sticker);

        $sticker = $pack->stickers()->updateOrCreate(...$this->createSticker($packCode, 'night'));
        $sticker->syncTags(['night', 'sky', 'stars', 'moon', 'comet', 'blue', 'yellow', 'white', 'clouds']);
        unset($sticker);

        $sticker = $pack->stickers()->updateOrCreate(...$this->createSticker($packCode, 'peace'));
        $sticker->syncTags(['peace', 'green']);
        unset($sticker);

        $sticker = $pack->stickers()->updateOrCreate(...$this->createSticker($packCode, 'pencils'));
        $sticker->syncTags(['pencils', 'eraser', 'pink', 'purple', 'indigo', 'white']);
        unset($sticker);

        $sticker = $pack->stickers()->updateOrCreate(...$this->createSticker($packCode, 'sky'));
        $sticker->syncTags(['sky', 'clouds', 'blue', 'white', 'cyan', 'birds']);
        unset($sticker);

        $sticker = $pack->stickers()->updateOrCreate(...$this->createSticker($packCode, 'snow'));
        $sticker->syncTags(['snow', 'white', 'blue', 'cyan', 'sky', 'winter', 'cold']);
        unset($sticker);

        $sticker = $pack->stickers()->updateOrCreate(...$this->createSticker($packCode, 'soccer'));
        $sticker->syncTags(['soccer', 'ball', 'green', 'white', 'sport', 'football']);
        unset($sticker);

        $sticker = $pack->stickers()->updateOrCreate(...$this->createSticker($packCode, 'space'));
        $sticker->syncTags(['space', 'abstract', 'satellite', 'stars', 'purple', 'planets', 'geometry']);
        unset($sticker);

        $sticker = $pack->stickers()->updateOrCreate(...$this->createSticker($packCode, 'spring'));
        $sticker->syncTags(['spring', 'flowers', 'green', 'yellow', 'red', 'white']);
        unset($sticker);

        $sticker = $pack->stickers()->updateOrCreate(...$this->createSticker($packCode, 'sun'));
        $sticker->syncTags(['sun', 'gradient', 'yellow', 'orange']);
        unset($sticker);

        $sticker = $pack->stickers()->updateOrCreate(...$this->createSticker($packCode, 'sunset'));
        $sticker->syncTags(['sunset', 'sky', 'sun', 'sea', 'ocean', 'gradient', 'blue', 'white', 'black']);
        unset($sticker);

        $sticker = $pack->stickers()->updateOrCreate(...$this->createSticker($packCode, 'trees'));
        $sticker->syncTags(['trees', 'red', 'black', 'winter', 'cold', 'snow']);
        unset($sticker);

        $sticker = $pack->stickers()->updateOrCreate(...$this->createSticker($packCode, 'vinil'));
        $sticker->syncTags(['vinil', 'music', 'song', 'black', 'orange', 'gren', 'table']);
        unset($sticker);

        $sticker = $pack->stickers()->updateOrCreate(...$this->createSticker($packCode, 'violet'));
        $sticker->syncTags(['violet', 'gradient', 'purple', 'pink', 'violet']);
        unset($sticker);
    }

    protected function createSticker(string $packCode, string $imagePath): array
    {
        $attributes = [
            'code' => sprintf('%s.%s', $packCode, $imagePath),
        ];

        $values = [
            'width' => 512,
            'height' => 512,
            'layers' => [
                BackgroundImageLayer::make(Storage::disk('packs')->path(sprintf("BackgroundImage/%s", $imagePath))),
                InputTextLayer::make(
                    fontColor: Color::fromRgba(255, 255, 255),
                    strokeSize: 2,
                    strokeColor: Color::fromRgba(0, 0, 0),
                ),
            ],
        ];

        return [$attributes, $values];
    }
}
