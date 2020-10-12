<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class returnProduct extends Model
{

    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];

    public function products(){
        return $this->belongsTo('App\Models\product','product_id','id');
    }
    public function customer(){
        return $this->belongsTo('App\Models\customer','customer_id','id');
    }
    public function user(){
        return $this->belongsTo('App\Models\User','user_id','id');
    }
    public function abasas(){
        $this->product = $this->products->name;
        $this->customer = $this->customer->name;
        $this->user = $this->user->name;
    }   
}
