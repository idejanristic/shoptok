<?php

namespace App\Domain\Services;

use App\Domain\Dtos\SortDto;

class ProductService
{
    public function formatSortByParametar(?string $sortBy = ''): SortDto
    {
        $sortData = SortDto::apply([]);

        switch ($sortBy) {
            case 'minPrice':
                $sortData = SortDto::apply(
                    data: [
                        'sortBy' => 'price',
                        'sortDir' => 'asc'
                    ]
                );
                break;

            case 'maxPrice':
                $sortData = SortDto::apply(
                    data: [
                        'sortBy' => 'price',
                        'sortDir' => 'desc'
                    ]
                );
                break;

            case 'discount':
                $sortData = SortDto::apply(
                    data: [
                        'sortBy' => 'discount',
                        'sortDir' => 'desc'
                    ]
                );
                break;

            case 'brand':
                $sortData = SortDto::apply([
                    'sortBy' => 'brand',
                    'sortDir' => 'asc'
                ]);
                break;

            case '-brand':
                $sortData = SortDto::apply([
                    'sortBy' => 'brand',
                    'sortDir' => 'desc'
                ]);
                break;

            default:
                $sortData = SortDto::apply([
                    'sortBy' => 'price',
                    'sortDir' => 'desc'
                ]);
                break;
        }

        return $sortData;
    }
}
