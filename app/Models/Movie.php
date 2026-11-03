<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Movie extends Model
{
    protected $connection = 'mongodb';
    protected $table = 'movies';

    protected $fillable = [
        'title',
        'description',
        'year',
        'genre',
        'image',
        'image_name',
        'comments',
        'ratings'
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class, 'movie_id');
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class, 'movie_id');
    }

    public function averageRating()
    {
        $ratings = $this->ratings()->get();
        if ($ratings->isEmpty()) return 0;
        return round($ratings->avg('rating'), 1);
    }
}
