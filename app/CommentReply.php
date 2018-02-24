<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentReply extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'comment_id', 'author', 'email', 'photo', 'is_active', 'body'
    ];

    public function comment(){
        return $this->belongsTo('App\Comment');
    }
}
