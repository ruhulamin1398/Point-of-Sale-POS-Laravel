<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class dropProduct extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];
    public function user(){
        return $this->hasOne('App\Models\employee','user_id','user_id');
    }
    public function product(){
        return $this->belongsTo('App\Models\product','product_id','id');
    }
    public function abasas(){
        // $this->products_count = $this->products->count();
         $this->user = $this->user->name;
         $this->product = $this->product->name;
    }   
}
