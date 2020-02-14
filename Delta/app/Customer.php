<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public function customer_type(){
        return $this->belongsTo('App\Customer_type');
    }
    public function orders(){
        return $this->hasMany('App\orders');
    }
    public function payments(){
        return $this->hasMany('App\payment');
    }
}
