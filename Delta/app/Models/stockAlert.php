<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class stockAlert extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $guarded = [];


    public function product(){
        return $this->belongsTo('App\Models\Product','product_id','id')->withTrashed();
    }
    
    public function abasas(){
        
    }
}
