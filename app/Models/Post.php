<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $name
 * @property string $description
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Post extends Model
{
    protected $fillable = ['name', 'description'];

    public function images(): BelongsToMany{
        return $this->belongsToMany(Image::class, 'post_image');
    }
}
