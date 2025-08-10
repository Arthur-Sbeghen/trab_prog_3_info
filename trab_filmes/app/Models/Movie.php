<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Movie extends Model
{
    protected $fillable = ['title', 'year', 'synopsis', 'image', 'trailer_link', 'category_id'];
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public static function getIdFromUrl($url)
    {
        $reg = '/(?:youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]{11})/';
        if (preg_match($reg, $url, $match)) {
            return $match[1];
        }
        return null;
    }
}
