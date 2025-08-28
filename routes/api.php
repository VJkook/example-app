<?php

use App\Http\Controllers\Posts\PostsController;
use Illuminate\Support\Facades\Route;

Route::get('/posts',[PostsController::class, 'index'])->name('posts.index');
