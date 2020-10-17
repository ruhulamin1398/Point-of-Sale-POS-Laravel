<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public function category(){
        return $this->belongsTo('App\Models\category','category_id','id')->withTrashed();
    }
    public function brand(){
        return $this->belongsTo('App\Models\brand','brand_id','id')->withTrashed();
    }
    public function abasas(){
        $this->brand = $this->brand->name;
    }
    

   

}
