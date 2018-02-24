<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'post_id', 'author', 'email', 'photo', 'is_active', 'body'
    ];

    public function replies(){
        return $this->hasMany('App\CommentReply');
    }
}
