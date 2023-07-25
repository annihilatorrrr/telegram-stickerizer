<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Seeders\BasePacks\BackgroundColorSeeder;
use Database\Seeders\BasePacks\BackgroundImageSeeder;
use Database\Seeders\BasePacks\BackgroundSpecialSeeder;
use Database\Seeders\BasePacks\TextColorSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(TextColorSeeder::class);
        $this->call(BackgroundColorSeeder::class);
        $this->call(BackgroundImageSeeder::class);
        $this->call(BackgroundSpecialSeeder::class);
    }
}
