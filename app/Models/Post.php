<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
class Post extends Model
{
    protected $fillable = ['name', 'description'];

    public function images(): BelongsToMany{
        return $this->belongsToMany(Image::class, 'post_image');
    }
}
