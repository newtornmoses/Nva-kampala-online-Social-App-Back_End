<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable= [ 'file', 'body', 'user_id', 'mime_type', 'slug'];

    public $with = ['user', 'comments', 'likes'];

    public function user()
    {
        return  $this->belongsTo('App\User');
    }

    public function comments()
    {
        return $this->hasMany('App\comments');
    }

    public function replies()
    {
        return $this->hasMany('App\Reply');
    }

    public function likes()
    {
        return $this->hasMany('App\Likes');
    }

//    public  $with=['replies'];
}
