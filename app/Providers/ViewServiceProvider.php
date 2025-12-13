<?php

namespace App\Providers;

use App\View\Composer\BrandsComposer;
use Illuminate\Support\Facades\View;
use App\View\Composer\TagsComposer;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer(
            views: 'layouts.*',
            callback: TagsComposer::class
        );

        View::composer(
            views: 'layouts.*',
            callback: BrandsComposer::class
        );
    }
}
