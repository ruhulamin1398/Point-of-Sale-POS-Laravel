<?php

namespace App;
use App\Purchase;
use Illuminate\Database\Eloquent\Model;

class Purchase_details extends Model
{
    public function order()
    {
        return $this->belongsTo('App\purchase');
    }

    public function puroduct()
    {
        return $this->belongsTo('App\Product');
    }
    public function product()
    {
        return $this->belongsTo('App\purchase');
    }

    public function product_detils(){
        return $this->hasOne('App\Product','id', 'product_id');
    }
}
