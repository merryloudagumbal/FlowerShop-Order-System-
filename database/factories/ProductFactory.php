<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = ['Bouquet', 'Arrangement', 'Single Flower', 'Accessory', 'Vase'];

        return [
            'name' => fake()->words(3, true),
            'category' => fake()->randomElement($categories),
            'description' => fake()->sentence(12),
            'price' => fake()->randomFloat(2, 50, 2000),
            'stock' => fake()->numberBetween(0, 100),
        ];
    }
}
