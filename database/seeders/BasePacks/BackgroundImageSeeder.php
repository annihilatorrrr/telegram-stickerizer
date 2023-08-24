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
        ]);

        $packsDisk = Storage::disk('packs');

        File::copyDirectory(
            resource_path('img/BasePacks/BackgroundImage/'),
            $packsDisk->path('BackgroundImage')
        );

        foreach ($packsDisk->allFiles('BackgroundImage') as $imagePath) {
            $pack->stickers()->create([
                'width' => 512,
                'height' => 512,
                'layers' => [
                    BackgroundImageLayer::make($packsDisk->path($imagePath)),
                    InputTextLayer::make(
                        fontColor: Color::fromRgba(255, 255, 255),
                        strokeSize: 2,
                        strokeColor: Color::fromRgba(0, 0, 0),
                    ),
                ]
            ]);
        }
    }
}
