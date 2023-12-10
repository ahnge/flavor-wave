<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define the number of products you want to create
        $numberOfProducts = 10;

        // Create products using the Product factory
        Product::factory($numberOfProducts)->create();
    }
}
