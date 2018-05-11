<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class friendship extends Model
{
     protected $fillable = ['reciever', 'user_id', 'status'];

  public $with =['user'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
