<?php

namespace App\View\Composer;

use App\Domain\Repositories\TagRepository;
use Illuminate\View\View;
use Illuminate\Support\Facades\Cache;

class TagsComposer
{
    public function __construct() {}

    public function compose(View $view): void
    {
        $tags = Cache::remember(
            key: 'tags_with_products_count',
            ttl: 3600, // 1 h, with null for indefinite
            callback: fn() => TagRepository::all()
        );

        $view->with(
            key: 'tags',
            value: $tags
        );
    }
}
