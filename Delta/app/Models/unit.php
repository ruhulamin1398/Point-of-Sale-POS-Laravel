<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class unit extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];


    public function product_type(){
        return $this->belongsTo('App\Models\productType','product_type_id','id')->withTrashed();
    }
    
    public function abasas(){
        $this->product_type = $this->product_type->name;
    }   
 
    
}
