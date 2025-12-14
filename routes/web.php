<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get(uri: '/', action: [ProductController::class, 'index'])
    ->name(name: 'home');

Route::get(uri: '/products', action: [ProductController::class, 'index'])
    ->name(name: 'products.index');
Route::get(uri: '/products/ajax', action: [ProductController::class, 'ajax'])
    ->name(name: 'products.index.ajax');

Route::get(uri: '/products/{id}/category', action: [ProductController::class, 'category'])
    ->name(name: 'products.category');
Route::get(uri: '/products/{id}/category/ajax', action: [ProductController::class, 'categoryAjax'])
    ->name(name: 'products.category.ajax');
