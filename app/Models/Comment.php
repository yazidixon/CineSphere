<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Comment extends Model
{
    protected $connection = 'mongodb';
    protected $table = 'comments';

    protected $fillable = [
        'user_id',
        'movie_id',
        'content',
        'votes'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function movie()
    {
        return $this->belongsTo(Movie::class, 'movie_id');
    }

    public function votes()
    {
        return $this->hasMany(CommentVote::class, 'comment_id');
    }
}
