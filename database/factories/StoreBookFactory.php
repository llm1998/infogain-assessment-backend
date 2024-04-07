<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\Store;
use App\Models\StoreBook;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StoreBook>
 */
class StoreBookFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = StoreBook::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'book_id' => $this->faker->numberBetween(1, Book::count()),
            'store_id' => $this->faker->numberBetween(1, Store::count())
        ];
    }
}
