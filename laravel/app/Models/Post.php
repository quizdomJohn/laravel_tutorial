<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
        'user_id',
    ];

    // in order to find the name of the creator of the post
    // we use the field ofthe associative id that the post has
    public function findTheAuthor(){
        return $this->belongsTo(User::class,'user_id'); // this post belongs to a user, the relationalship field
    }
}

