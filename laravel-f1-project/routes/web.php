<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/students', [StudentController::class, 'index']);
Route::get('/global-variable', [StudentController::class, 'read']);
Route::get('/greet/{name}', [StudentController::class, 'greet']);

Route::prefix('students')->group(function () {
    Route::get('/global-variable', [StudentController::class, 'read']);
    Route::get('/global-variable/greet', function () {
        return app(StudentController::class)->greet('jf');
    });
    Route::get('/global-variable/greet/{name}', [StudentController::class, 'greet']);
});
