<?php

namespace App\View\Composer;

use Illuminate\View\View;
use Illuminate\Support\Facades\Cache;
use App\Domain\Repositories\BrandRepository;

class BrandsComposer
{
    public function __construct() {}

    public function compose(View $view): void
    {
        $brands = Cache::remember(
            key: 'brands_with_products_count',
            ttl: 3600, // 1 h, with null for indefinite
            callback: fn() => BrandRepository::all()
        );

        $view->with(
            key: 'brands',
            value: $brands
        );
    }
}
