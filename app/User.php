<?php

namespace App;
use App\Post;
use App\Likes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Cache;
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'profile_image'
    ];
    

  
    

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

   
    public function posts()
    {
        return  $this->hasMany('App\Post');
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
        return $this->hasOne('App\Likes');
    }


    public function friendships()
    {
        return $this->hasMany('App\friendship');
    }

    public function online()
    {    
        return Cache::has('user_is_online'.$this->id);
    }

    public function lastseen()
    {
        
        return Cache::get('lastseen'.$this->id);
        
    }
}
