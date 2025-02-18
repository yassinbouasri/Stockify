<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category_id' => Category::factory(),
            'name' => fake()->word,
            'sku' => fake()->unique()->randomNumber(4) . '-' . fake()->unique()->randomNumber(4) ,
            'price' => fake()->randomNumber(3),
            'description' => fake()->sentence,
            'image' => "http://picsum.photos/seed/" . rand(0, 10000) . "/900",
        ];
    }
}
