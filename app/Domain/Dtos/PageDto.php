<?php

namespace App\Domain\Dtos;

class PageDto
{
    public function __construct(
        public readonly int $perPage = 10,
        public readonly ?int $page = 1,
        public readonly ?string $pageName = 'page',
        public readonly ?array $columns = ["*"]
    ) {}

    public static function apply(array $data): PageDto
    {
        return new self(
            perPage: $data['perPage'] ?? 10,
            page: $data['page'] ?? 1,
            pageName: $data['pageName'] ?? 'page',
            columns: $data['columns'] ?? ['*']
        );
    }
}
