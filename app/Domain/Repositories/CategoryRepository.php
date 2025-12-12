<?php

namespace App\Domain\Repositories;

use App\Domain\Models\Category;

class CategoryRepository
{
    /**
     * @param string $name
     * @return Category|null
     */
    public function findByName(string $name): Category|null
    {
        return Category::where(column: 'name', operator: $name)->first();
    }
}
