<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class CommentVote extends Model
{
    protected $connection = 'mongodb';
    protected $table = 'comment_votes';

    protected $fillable = [
        'user_id',
        'comment_id',
        'type'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comment()
    {
        return $this->belongsTo(Comment::class, 'comment_id');
    }
}
