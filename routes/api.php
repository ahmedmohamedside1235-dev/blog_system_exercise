<?php

use App\Http\Controllers\api\Blog\BlogController;
use Illuminate\Support\Facades\Route;

Route::post('post/getAll', [BlogController::class, 'getAll']);

Route::prefix('post')->controller(BlogController::class)->group(function () {
    Route::post('/create', 'store');

    Route::post('/update', 'update');

    Route::delete('/delete', 'destroy');

    Route::delete('/force_delete', 'force_delete');

    Route::post('/restore', 'restore');

    Route::post('/getPost', 'getPost');
});
