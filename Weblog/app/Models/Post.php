<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'body', 'is_premium', 'user_id'];

    protected $with = ['user', 'categories', 'image'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function image()
    {
        // TODO :: hasMany?
        return $this->hasOne(Image::class);
    }

    public function scopeFilter($query, array $filters)
    {
        // TODO check :: if statement mag hier weg
        // mijn todo was niet helemaal goed, zo zou hij moeten
        if ($filters['category'] ?? false) {
            $categories = $filters['category'];
            $query->whereHas('categories', function ($query) use ($categories) {
                $query->whereIn('id', $categories);
            });
        }
    }
}
