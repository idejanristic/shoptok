<?php

namespace Database\Seeders;

use App\Domain\Models\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Brand::factory()->count(count: 20)->create();
    }
}
