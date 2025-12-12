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
        Product::factory()->count(count: 500)->create()->each(
            callback: function (Product $product): void {
                $tags = Tag::inRandomOrder()->take(value: rand(min: 1, max: 5))->pluck(column: 'id');

                $product->tags()->attach(ids: $tags);
            }
        );
    }
}
