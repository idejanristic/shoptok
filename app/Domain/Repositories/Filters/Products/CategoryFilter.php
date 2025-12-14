<?php

namespace App\Domain\Repositories\Filters\Products;

use Illuminate\Database\Eloquent\Builder;

class CategoryFilter
{
    public function __construct(
        private int $categoryId = 0
    ) {}

    public function __invoke(Builder $query): void
    {
        $query->when(
            value: $this->categoryId !== 0,
            callback: function (Builder $query): void {
                $query->where(column: 'category_id', operator: $this->categoryId);
            }
        );
    }
}
