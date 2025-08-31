<?php

namespace App\Services;

use App\Models\CustomModels\Post;
use App\Models\Responses\PostResponse;
use App\Models\Responses\StatusResponse;
use App\Repositories\PostsRepository;

class PostsService
{
    public function __construct(protected PostsRepository $repository)
    {
    }

    public function createPost(string $name, ?string $description = null): Post
    {
        return $this->repository->create($name, $description);
    }

    public function getAllPosts(): array
    {
        return $this->repository->getAll();
    }

    public function getPostById(int $id): PostResponse|null
    {
        return $this->repository->getById($id);
    }

    public function updatePost($id, $attributes): PostResponse
    {
        return $this->repository->update($id, $attributes);
    }

    public function deletePost(int $id): bool
    {
        return $this->repository->delete($id);
    }
}
