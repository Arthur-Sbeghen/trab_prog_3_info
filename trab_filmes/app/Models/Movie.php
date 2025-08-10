<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Movie extends Model
{
    protected $fillable = ['title', 'year', 'synopsis', 'image','trailer_link', 'category_id'];
    public function category():BelongsTo {
        return $this->belongsTo(Category::class);
    }
}
