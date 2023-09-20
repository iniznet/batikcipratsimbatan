<?php

namespace App\Models\Homepage;

use Awcodes\Curator\Models\Media;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Carousel extends Model
{
    use HasFactory;

    public function attachedImage(): BelongsTo
    {
        return $this->belongsTo(Media::class, 'image_id', 'id');
    }
}
