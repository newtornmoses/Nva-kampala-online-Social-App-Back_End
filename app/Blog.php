<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable= [ 'image', 'body', 'user_id'];

    public $with = ['user', 'comments'];

    public function user()
    {
        return  $this->belongsTo('App\User');
    }

    public function comments()
    {
        return $this->hasMany('App\comments');
    }

    public function likes()
    {
        return $this->hasMany('App\Likes');
    }
}
