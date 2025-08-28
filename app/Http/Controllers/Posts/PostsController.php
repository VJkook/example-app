<?php

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PostsController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function index()
    {
//        $response = ['msg' => 'ok'];
//        return response()->json($response);
        // 1. Идем в базу через модель Post и берем ВСЕ записи
        $posts = Post::all();

        // 2. Автоматически преобразуем коллекцию постов в JSON и возвращаем
        return response()->json($posts);
    }

//Реализуй сначала все GET-запросы (читать все посты и один пост).

    // Альтернативная реализация с поиском вручную
    public function show($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json(['error' => 'Post not found'], 404);
        }

        return response()->json($post);
    }


//
//Потом реализуй POST (создание).
//
//Затем DELETE (удаление).

}
