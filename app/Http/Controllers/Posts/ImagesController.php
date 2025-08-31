<?php

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ImagesController extends Controller
{
    public function index()
    {
        $image = Image::all();
        return response()->json($image);
    }

    public function show($id)
    {
        $image = Image::find($id);
        if (!$image) {
            return response("Image not found", 404);
        }
        return response()->json($image);
    }

    public function store(Request $request)
    {
        try {
            $validate = $request->validate([
                'url' => "required|string",
            ]);

            $image = Image::create($validate);
            return response()->json([
                "message" => "Image created",
                "data" => $image
            ], 201);
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

    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'url' => "required|string",
        ]);

        $image = Image::find($id);
        if (!$image) {
            return response("Image not found", 404);
        }
        $image->update($validate);
        return response()->json([
            "message" => "Image updated",
            "data" => $image,
        ], 200);
    }

}
