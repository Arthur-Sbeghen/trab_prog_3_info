<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Movie extends Model
{
    public function category():BelongsTo {
        return $this->belongsTo(Category::class);
    }
}
