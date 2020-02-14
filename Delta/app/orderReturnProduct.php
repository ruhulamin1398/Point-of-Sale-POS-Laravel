<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class orderReturnProduct extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }
        public function customer()
    {
        return $this->belongsTo('App\Customer');
    }

    public function product(){
        return $this->belongsTo('App\Product');
    }

}
