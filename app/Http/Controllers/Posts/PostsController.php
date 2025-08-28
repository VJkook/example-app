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

    public function show($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json(['error' => 'Post not found'], 404);
        }

        return response()->json($post);
    }

    public function store(Request $request)
    {
        try {
            // 1. ВАЛИДАЦИЯ данных
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',

            ]);

            // 2. СОЗДАНИЕ поста
            $post = Post::create($validatedData);


            return response()->json([
                'message' => 'Post created successfully',
                'data' => $post
            ], 201); // 201 - Created

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Обработка ошибок валидации
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422); // 422 - Unprocessable Entity

        } catch (\Exception $e) {
            // Обработка всех остальных ошибок
            return response()->json([
                'message' => 'Server error',
                'error' => $e->getMessage()
            ], 500); // 500 - Internal Server Error
        }
    }


    // POST /api/posts/{id} - обновить пост
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'description' => 'nullable|string',

        ]);

        $post = Post::find($id);

        if (!$post) {
            return response()->json([
                'error' => 'Post not found',
                'requested_id' => $id,
                'available_posts' => Post::pluck('id')->toArray()
            ], 404);
        }

        // обновляем только переданные поля
        $post->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Post updated successfully',
            'updated_post' => $post
        ], 200);
    }

//
//Потом реализуй POST (создание).

//
//Затем DELETE (удаление).

}
