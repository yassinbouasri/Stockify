<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use App\Models\Stock;
use App\Models\User;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->withPersonalTeam()->create();

        User::factory()->withPersonalTeam()->create(['name' => 'Test User', 'email' => 'test@example.com',]);

        Category::factory(10)->create();
        Product::factory(100)->create();
        Stock::factory(20)->create();
        Customer::factory(10)->create();
        Order::factory(20)->create();
    }
}
