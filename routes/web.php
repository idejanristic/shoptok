<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get(
    uri: '/',
    action: [ProductController::class, 'index']
)
    ->name(name: 'home');

Route::get(
    uri: '/products',
    action: [ProductController::class, 'index']
)
    ->name(name: 'products.index');
