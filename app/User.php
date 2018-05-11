<?php

namespace App;

use App\Likes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Cache;
use App\Traits\Frendable;
class User extends Authenticatable implements JWTSubject
{
    use Notifiable;
    use Frendable;
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



    // Rest omitted for brevity

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }


   
    public function posts()
    {
        return  $this->hasMany('App\Post')->orderBy('created_at', 'dec');
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
