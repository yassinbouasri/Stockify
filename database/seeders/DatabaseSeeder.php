<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Stock;
use App\Models\Stock_Movements;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Factories\StockMovementsFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->withPersonalTeam()->create();

        User::factory()->withPersonalTeam()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        Category::factory(10)->create();
        Product::factory(100)->create();
        Stock::factory(20)->create();
    }
}
