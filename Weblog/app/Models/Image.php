<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    public function post() {
        return $this->belongsTo(Post::class);
    }

    // https://codesource.io/complete-laravel-8-image-upload-tutorial-with-example/
}
