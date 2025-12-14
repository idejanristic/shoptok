<?php

namespace Database\Seeders;

use App\Domain\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::factory()->count(count: 4)->create();
    }
}
