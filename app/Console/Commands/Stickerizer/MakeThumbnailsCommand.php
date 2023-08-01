<?php

namespace App\Console\Commands\Stickerizer;

use App\Models\Pack;
use File;
use Illuminate\Console\Command;

class MakeThumbnailsCommand extends Command
{
    protected $signature = 'stickerizer:make:thumbnails';

    protected $description = 'Generate thumbnails for all stickers';

    public function handle(): void
    {
        foreach (Pack::lazy() as $pack) {
            $this->warn("Generating thumbnails for pack {$pack->name}");

            $dir = storage_path("app/public/thumbnails/{$pack->id}/");
            if (!File::exists($dir)) {
                File::makeDirectory($dir, 0775, true);
            }

            foreach ($pack->stickers()->lazy() as $sticker) {
                $this->warn("    Generating thumbnail for sticker {$sticker->id}");

                $sticker
                    ->getGenerator()
                    ->generate('Your text here')
                    ->resize(100, 100)
                    ->save($dir . "{$sticker->id}.png");
            }
        }
        $this->info("Done");
    }
}
