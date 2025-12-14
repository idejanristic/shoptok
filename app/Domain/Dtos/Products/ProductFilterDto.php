<?php

namespace App\Domain\Dtos\Products;

class ProductFilterDto
{

    public function __construct(
        public readonly ?int $categoryId = 0,
    ) {}

    public static function apply(array $data): ProductFilterDto
    {
        return new ProductFilterDto(
            categoryId: $data['categoryId']
        );
    }
}
