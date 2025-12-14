<?php

namespace App\Domain\Repositories\Filters\Products;

use Illuminate\Database\Eloquent\Builder;

class TagFilter
{
    public function __construct(
        private array $tagIds = []
    ) {}

    public function __invoke(Builder $query): void
    {
        $query->when(
            value: !empty($this->tagIds),
            callback: function (Builder $query): void {
                $query->whereHas(
                    relation: 'tags',
                    callback: function (Builder $q): void {
                        $q->whereIn(column: 'tags.id', values: $this->tagIds);
                    }
                );
            }
        );
    }
}
