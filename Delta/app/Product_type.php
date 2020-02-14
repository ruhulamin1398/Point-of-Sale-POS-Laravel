<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_type extends Model
{
   
    public function products(){
        return $this->hasMany('App\Product');
    }
}
