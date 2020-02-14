<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->belongsTo('App\Role');
    }
    public function orders(){
        return $this->hasMany('App\Orders');
    }
    public function payments(){
        return $this->hasMany('App\payment');
    }
    
    public function drop_product(){
        return $this->hasMany('App\drop_product');
    }

    public function purches(){
        return $this->hasMany('App\Purchase');
    }  
      public function costs(){
        return $this->hasMany('App\Purchase');
    }

}
