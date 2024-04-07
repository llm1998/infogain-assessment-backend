<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\Mock\BookSeeder;
use Database\Seeders\Mock\StoreBookSeeder;
use Database\Seeders\Mock\StoreSeeder;
use Database\Seeders\Mock\UserSeeder;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            BookSeeder::class,
            StoreSeeder::class,
            StoreBookSeeder::class
        ]);
    }
}
