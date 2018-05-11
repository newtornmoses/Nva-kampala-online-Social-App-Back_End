<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function blog()
    {
        return $this->belongsTo('App\Blog');
    }

    public function comments()
    {
        return $this->belongsTo('App\comments');
    }


    public $with =['user'];
}
