<?php

namespace App\Domain\Dtos;

class TagDto
{
    public function __construct(
        public readonly string $name,
    ) {}

    public static function fromArray(array $data): array
    {
        $tags = [];
        foreach ($data as $tagName) {
            $tags[] = new self(name: $tagName);
        }
        return $tags;
    }
}
