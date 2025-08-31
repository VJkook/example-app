<?php

namespace App\Models\CustomModels;

use Illuminate\Support\Carbon;

class Post
{
    private int $id;
    private string $name;
    private string|null $description = null;
    private Carbon $createdAt;
    private Carbon $updatedAt;

    public function __construct(int $id, string $name, Carbon $createdAt, Carbon $updatedAt, string|null $description = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->description = $description;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getCreatedAt(): Carbon
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): Carbon
    {
        return $this->updatedAt;
    }

}
