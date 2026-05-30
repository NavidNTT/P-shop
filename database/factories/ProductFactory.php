<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        $name = fake()->unique()->words(3, true);

        $categoryId = Category::query()->inRandomOrder()->value('id');

        return [
            'category_id' => $categoryId,
            'name' => $name,
            'slug' => Str::slug($name) . '-' . fake()->unique()->numberBetween(1000, 9999),
            'description' => fake()->paragraph(),
            'price' => fake()->numberBetween(50000, 25000000),
            'stock' => fake()->numberBetween(0, 100),
            'is_active' => fake()->boolean(90),
        ];
    }
}
