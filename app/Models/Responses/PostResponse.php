<?php

namespace App\Models\Responses;

use Illuminate\Support\Carbon;

class PostResponse
{
    public int $id;
    public string $name;
    public string|null $description = null;
    public string $createdAt;
    public string $updatedAt;

    private const DATE_FORMAT = 'Y-m-d H:i:s';

    public function __construct(int $id, string $name, Carbon $createdAt, Carbon $updatedAt, string|null $description = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->createdAt = $createdAt->format(self::DATE_FORMAT);
        $this->updatedAt = $updatedAt->format(self::DATE_FORMAT);
        $this->description = $description;
    }
}
