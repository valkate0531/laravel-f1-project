<?php

use App\Http\Controllers\HumanResourceController;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/payroll', [HumanResourceController::class, 'pay']);
Route::post('/payroll/calculate', [HumanResourceController::class, 'calculate']);
Route::post('/calculator', [HumanResourceController::class, 'employment']);
Route::get('/posts', [PostController::class, 'index']);
Route::post('/posts', [PostController::class, 'store']);
