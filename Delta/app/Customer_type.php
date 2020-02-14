<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer_type extends Model
{
    public function customer(){
        return $this->hasMany('App\Customer');
    }
}
