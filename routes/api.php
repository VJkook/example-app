<?php

use App\Http\Controllers\Posts\PostsController;
use Illuminate\Support\Facades\Route;

//Route::get('/posts',[PostsController::class, 'index'])->name('posts.index');
Route::get('/posts', [PostsController::class, 'index']);
Route::get('/posts/{id}', [PostsController::class, 'show']);
