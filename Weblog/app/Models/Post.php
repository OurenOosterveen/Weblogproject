<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['text', 'body', 'is_premium', 'user_id'];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
