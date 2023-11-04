<?php

namespace App\Models\Shop;

use App\Models\Comment;
use App\Models\Management\User;
use Awcodes\Curator\Models\Media;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Product extends Model
{
    use HasFactory;

    protected $casts = [
        'colors' => 'array',
        'sizes' => 'array',
        'platforms' => 'array',
        'images' => 'array',
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(ShopCategory::class, 'category_id');
    }

    public function material(): BelongsTo
    {
        return $this->belongsTo(ShopMaterial::class, 'material_id');
    }

    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function productPictures(): BelongsToMany
    {
        return $this
            ->belongsToMany(Media::class, 'product_pictures', 'product_id', 'media_id')
            ->withPivot('order')
            ->orderByPivot('order');
    }

    public function getCoverAttribute(): Media
    {
        return $this->productPictures->first();
    }
}
