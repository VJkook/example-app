<?php

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Responses\ErrorResponse;
use App\Models\Responses\PostResponse;
use App\Models\Responses\StatusResponse;
use App\Services\PostsService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostsController extends Controller
{
    public function __construct(protected PostsService $service)
    {
    }

    /**
     * Mark the authenticated user's email address as verified.
     */
    public function index(): JsonResponse
    {
        $posts = $this->service->getAllPosts();
        return response()->json($posts);
    }

    public function show(int $id): ?JsonResponse
    {
        $post = $this->service->getPostById($id);
        if (!$post) {
            return response()->json(new ErrorResponse('Post not found'), 404);
        }
        return response()->json($post);
    }

    public function store(Request $request): JsonResponse
    {
        try {
            $validatedData = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',

            ]);

            if ($validatedData->fails()) {
                return response()->json($validatedData->errors()->getMessages(), 400);
            }

            $post = $this->service->createPost($request->get('name'), $request->get('description'));

            $response = new PostResponse(
                $post->getId(),
                $post->getName(),
                $post->getCreatedAt(),
                $post->getUpdatedAt(),
                $post->getDescription()
            );

            return response()->json($response, 201); // 201 - Created

        } catch (Exception $e) {
            return response()->json((new ErrorResponse($e->getMessage())), 500); // 500 - Internal Server Error
        }
    }

    public function update(Request $request, $id): JsonResponse
    {
        $validatedData = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',

        ]);
        if ($validatedData->fails()) {
            return response()->json($validatedData->errors()->getMessages(), 400);
        }
        $attributes = [];
        if (!is_null($request->name)) {
            $attributes['name'] = $request->name;
        }
        if (!is_null($request->description)) {
            $attributes['description'] = $request->description;
        }
        if (empty($attributes)) {
            $post = $this->service->getPostById($id);
            return response()->json($post);
        }

        $post = $this->service->updatePost($id, $attributes);
        return response()->json($post);

    }

    public function destroy(int $id): JsonResponse
    {
        $status=$this->service->deletePost($id);
        if(!$status){
            return response()->json(new ErrorResponse('Post not found'), 404);
        }
        return response()->json(new StatusResponse("Post has been deleted"), 204);
    }

}
