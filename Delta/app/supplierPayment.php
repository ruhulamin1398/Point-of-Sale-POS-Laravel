<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class supplierPayment extends Model
{
    public function purches()
    {
        return $this->hasMany('App\Purchase');
    }
        
    public function user()
    {
        return $this->belongsTo('App\User');
    }
        public function supplier()
    {
        return $this->belongsTo('App\Supplier');
    }
}
