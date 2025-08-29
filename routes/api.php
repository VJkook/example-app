<?php

use App\Http\Controllers\Posts\PostsController;
use App\Http\Controllers\Posts\ImagesController;
use Illuminate\Support\Facades\Route;

//Route::get('/posts',[PostsController::class, 'index'])->name('posts.index');

Route::withoutMiddleware(['web', 'csrf'])->group(function () {
    Route::get('/posts', [PostsController::class, 'index']);
    Route::get('/posts/{id}', [PostsController::class, 'show']);
    Route::post('/posts', [PostsController::class, 'store']);
    Route::post('posts/{id}',[PostsController::class, 'update']);

    Route::get('/images', [ImagesController::class, 'index']);
    Route::get('/images/{id}', [ImagesController::class, 'show']);
    Route::post('/images', [ImagesController::class, 'store']);
    Route::post('/images/{id}', [ImagesController::class, 'update']);
});

