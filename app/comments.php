<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Post;
use App\comments;
use App\User;
class comments extends Model
{
 public $fillable =[ 'user_id', 'comment','post_id'];

   public function posts()
   {
      return $this->belongsTo('App\Post');
   }

   public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function reply()
    {
        return $this->hasMany('App\Reply');
    }

    public $with = ['user'];
    
}
