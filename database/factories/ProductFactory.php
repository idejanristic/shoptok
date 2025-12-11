<?php

namespace Database\Factories;

use App\Models\Brand;
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
            'name' => $this->faker->name(),
            'productId' => $this->faker->unique()->isbn13(),

            'brand_id' => Brand::inRandomOrder()->value('id'),
            'category_id' => Category::inRandomOrder()->value('id'),

            'price' => $this->faker->randomFloat(nbMaxDecimals: 2, min: 10, max: 2000),

            'discount' => $this->faker->boolean(chanceOfGettingTrue: 30) ?
                $this->faker->numberBetween(int1: 1, int2: 70) :
                null,

            'image' => $this->faker->imageUrl(width: 600, height: 600, category: 'product', randomize: true),

            'link' => $this->faker->url(),

            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
