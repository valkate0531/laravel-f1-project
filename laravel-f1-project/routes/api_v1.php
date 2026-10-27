<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\ProductController;

Route::get('/user', function (Request $request) {
    return $request->user();
});

Route::get('products/queries', [ProductController::class, 'queries'])->name('products.queries');
Route::apiResource('products', ProductController::class)->only(['index', 'show']);
Route::apiResource('/categories', \App\Http\Controllers\CategoryController::class);