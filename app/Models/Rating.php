<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Rating extends Model
{
    protected $connection = 'mongodb';
    protected $table = 'ratings';

    protected $fillable = [
        'user_id',
        'movie_id',
        'rating'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function movie()
    {
        return $this->belongsTo(Movie::class, 'movie_id');
    }
}
