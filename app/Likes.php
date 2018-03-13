<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Likes extends Model
{

 public $fillable=['likes', 'post_id', 'user_id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function posts()
    {
        return $this->belongsTo('App\Post');
    }

    public $with=['user', 'posts'];
}
