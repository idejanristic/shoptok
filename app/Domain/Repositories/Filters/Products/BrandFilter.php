<?php

namespace App\Domain\Repositories\Filters\Products;

use Illuminate\Database\Eloquent\Builder;

class BrandFilter
{
    public function __construct(
        private array $brandIds = []
    ) {}

    public function __invoke(Builder $query): void
    {
        $query->when(
            value: !empty($this->brandIds),
            callback: function (Builder $query): void {
                $query->whereIn(column: 'brand_id', values: $this->brandIds);
            }
        );
    }
}
