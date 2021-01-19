<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','lastname','middlename','type','contact','profile'
    ];

    protected $attributes = [
      'type' => 'user',
      'middlename' => 'not set' ,
      'profile' => 'no_image.png'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function store() {
      return $this->hasOne('App\Store','user_id');
    }

    public function carts() {
      return $this->hasMany('App\Cart','user_id');
    }

    public function reviews() {
        return $this->hasMany('App\ProductReview');
    }

    public function favorites() {
        return $this->hasMany('App\Favorite','user_id');
    }
}
