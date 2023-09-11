<?php

namespace Database\Seeders;

use Database\Seeders\BasePacks\BackgroundColorCircleSeeder;
use Database\Seeders\BasePacks\BackgroundColorSeeder;
use Database\Seeders\BasePacks\BackgroundImageSeeder;
use Database\Seeders\BasePacks\BackgroundSpecialSeeder;
use Database\Seeders\BasePacks\TextColorSeeder;
use Illuminate\Database\Seeder;

class PacksSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(TextColorSeeder::class);
        $this->call(BackgroundColorSeeder::class);
        $this->call(BackgroundColorCircleSeeder::class);
        $this->call(BackgroundImageSeeder::class);
        $this->call(BackgroundSpecialSeeder::class);
    }
}
