<?php

use App\Http\Controllers\api\Blog\BlogController;
use Illuminate\Support\Facades\Route;

Route::post('post/getAll', [BlogController::class, 'getAll']);

Route::prefix('post')->controller(BlogController::class)->group(function () {
    Route::post('/create', 'store');

    Route::match(['put', 'patch'], '/update/{id}', 'update');

    Route::delete('/delete/{id}', 'destroy');

    Route::delete('/force_delete/{id}', 'force_delete');

    Route::post('/restore/{id}', 'restore');
});
