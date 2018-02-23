<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
	protected $uploads = 'http://localhost/laravel-courses/application/public/images/';

    protected $fillable = [
        'file'
    ];

    public function getFileAttribute($photo){
    	return $this->uploads . $photo;
    }
}
