<?php

namespace App\Domain\Dtos;

class ProductDto
{
    public function __construct(
        public readonly string $productId,
        public readonly int $discount,
        public readonly string $brand,
        public readonly string $name,
        public readonly string $image,
        public readonly string $link,
        public readonly float $price,
        public readonly ?array $tags = null,
        public readonly ?string $shops = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            productId: $data['id'] ?? '',
            discount: $data['discount'] ? (int)$data['discount'] : 0,
            brand: $data['brand'] ?? '',
            name: $data['name'] ?? '',
            image: $data['image'] ?? '',
            link: $data['link'] ?? '',
            price: $data['price'] ?? 0.0,
            tags: $data['tags']  ? TagDto::fromArray($data['tags']) : null,
            shops: $data['shops'] ?? null,
        );
    }
}
