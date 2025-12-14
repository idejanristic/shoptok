<?php

namespace App\View\Composer;

use App\Domain\Repositories\CategoryRepository;
use Illuminate\View\View;
use Illuminate\Support\Facades\Cache;

class CategoriesComposer
{

    public function __construct() {}

    public function compose(View $view): void
    {
        $categories = Cache::remember(
            key: 'cateogories_with_products_count',
            ttl: 3600, // 1 h, with null for indefinite
            callback: fn() => CategoryRepository::all()
        );

        $view->with(
            key: 'categories',
            value: $categories
        );
    }
}
