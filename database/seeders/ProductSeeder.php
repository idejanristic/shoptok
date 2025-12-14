<?php

namespace Database\Seeders;

use App\Domain\Models\Tag;
use App\Domain\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::factory()->count(count: 1000)->create()->each(
            callback: function (Product $product): void {
                $tags = Tag::inRandomOrder()->take(value: rand(min: 1, max: 3))->pluck(column: 'id');

                $product->tags()->attach(ids: $tags);
            }
        );
    }
}
