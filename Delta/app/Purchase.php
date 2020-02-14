<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    public function supplier()
    {
        return $this->belongsTo('App\Supplier');
    }


    public function products(){
        return $this->hasMany('App\Purchase_details');
    }


  
    
}
