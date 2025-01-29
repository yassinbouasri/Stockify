<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'customer_id' => Customer::factory(),
            'invoice_number' => fake()->randomNumber(8) . '-' . fake()->randomNumber(8) . '-' . fake()->randomNumber(8),
            'total_price' => fake()->randomNumber(3),
            'status' => fake()->randomElement(['pending', 'delivered', 'canceled']),
            'payment_method' => fake()->randomElement(['cash', 'card']),
        ];
    }
}
