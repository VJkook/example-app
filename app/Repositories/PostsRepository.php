<?php

namespace App\Repositories;

use App\Models\Post;
use App\Models\CustomModels\Post as MyPost;
use App\Models\Responses\PostResponse;
use App\Models\Responses\StatusResponse;

class PostsRepository
{


    public function getById(int $id): PostResponse|null
    {

        $post = Post::query()->find($id);
        if (!$post) {
            return null;
        }
        $postResponse = $this->buidPostResponse($post);
        return $postResponse;
    }

    public function getAll(): array
    {
        $posts = Post::all();
        $result = [];
        foreach ($posts as $post) {
            $postResponse = $this->buidPostResponse($post);
            $result[] = $postResponse;
        }
        return $result;
    }

    public function create(string $name, ?string $description = null): MyPost|null
    {
        $post = Post::query()->create([
            'name' => $name,
            'description' => $description,
        ]);

        if (!isset($post->id)) {
            return null;
        }

        return new MyPost($post->id, $post->name, $post->created_at, $post->updated_at, $post->description);
    }

    public function update(int $id, array $attributes): PostResponse|null
    {
        $post = Post::query()->find($id);
        if (!$post) {
            return null;
        }
        $post = Post::query()->update($attributes);

        return $this->getById($id);
    }

    public function delete(int $id): bool
    {
        $post = Post::query()->find($id);

        if (!$post) {
            return false;
        }

        return $post->delete();

    }

    private function buidPostResponse(Post $post): PostResponse
    {
        $postResponse = new PostResponse(
            $post->id,
            $post->name,
            $post->created_at,
            $post->updated_at,
            $post->description
        );
        return $postResponse;
    }
}
