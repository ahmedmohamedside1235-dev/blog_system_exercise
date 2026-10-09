<?php

use App\Http\Controllers\web\Blog\BlogController;
use App\Http\Controllers\web\Home\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');


Route::prefix('dashboard')->name('dashboard.')->controller(BlogController::class)->group(function () {

    Route::get('/', 'index')->name('index');

    Route::get('/create', 'create')->name('create');
    Route::post('/create', 'store')->name('store');

    Route::get('/edit/{id}', 'edit')->name('edit')->whereUuid('id');
    Route::post('/update/{id}', 'update')->name('update')->whereUuid('id');

    Route::get('/delete/{id}', 'destroy')->name('destroy')->whereUuid('id');
    Route::get('/force_delete/{id}', 'force_delete')->name('force_delete')->whereUuid('id');

    Route::get('/restore/{id}', 'restore')->name('restore')->whereUuid('id');
});
