<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_detail extends Model
{
    
    public function order()
    {
        return $this->belongsTo('App\Order');
    }

    public function puroduct()
    {
        return $this->belongsTo('App\Product');
    }
    public function product()
    {
        return $this->belongsTo('App\Order');
    }

    public function product_detils(){
        return $this->hasOne('App\Product','id', 'product_id');
    }
  
}
