<?php

namespace Database\Factories;


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
            'title' => fake()->sentence(3),
            'price' => fake()->randomFloat(2, 10, 100),
            'product_photo' => fake()->imageUrl(),
            'pc_per_box' => fake()->numberBetween(1, 10),
            'total_box_count' => 100,
            'available_box_count' => 100,
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
