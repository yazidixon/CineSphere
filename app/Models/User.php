<?php

namespace App\Models;

use MongoDB\Laravel\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $connection = 'mongodb';
    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'role'
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed'
        ];
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'user_id');
    }

    public function commentVotes()
    {
        return $this->hasMany(CommentVote::class, 'user_id');
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class, 'user_id');
    }
}
