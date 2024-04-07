<?php

namespace Database\Seeders\Mock;

use App\Models\StoreBook;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StoreBookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $storeBooks = StoreBook::factory()->count(500)->create();
    }
}
