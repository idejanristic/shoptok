<?php

namespace App\Domain\Dtos\Products;

class ProductFilterDto
{

    public function __construct(
        public readonly ?int $categoryId = 0,
        public readonly ?array $brandIds = [],
        public readonly ?array $tagIds = []
    ) {}

    public static function apply(array $data): ProductFilterDto
    {
        return new ProductFilterDto(
            categoryId: $data['categoryId'] ?? 0,
            brandIds: $data['brandIds'] ?? [],
            tagIds: $data['tagIds'] ?? []
        );
    }
}
