<?php

namespace App\Domain\Repositories;

use App\Domain\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use PhpParser\Node\Expr\Cast;

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

    /**
     * @param int $id
     * @return Category|null
     */
    public static function find(int $id): Category|null
    {
        return self::getCategoryQuery()
            ->where(column: 'id', operator: $id)
            ->first();
    }

    /**
     * @return Collection<int, Category>
     */
    public static function all(): Collection
    {
        return self::getCategoryQuery()
            ->get();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder<Category>
     */
    private static function getCategoryQuery()
    {
        return Category::query()
            ->withCount(relations: 'products');
    }
}
