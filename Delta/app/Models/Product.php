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
    public function type(){
        return $this->belongsTo('App\Models\productType','type_id','id')->withTrashed();
    }
    public function warrenty(){
        return $this->belongsTo('App\Models\warrenty','warrenty_id','id')->withTrashed();
    }
    public function taxType(){
        return $this->belongsTo('App\Models\taxType','tax_type_id','id')->withTrashed();
    }
    public function unit(){
        return $this->belongsTo('App\Models\unit','unit_id','id')->withTrashed();
    }
    public function stockAlert(){
        return $this->hasOne('App\Models\stockAlert','product_id','id')->withTrashed();
    }
    public function abasas(){
        $this->brand = $this->brand->name;
        $this->warrenty = $this->warrenty->name;
        $this->category = $this->category->name;
        $this->cost = $this->cost_per_unit * $this->unit->value ;
        $this->price = $this->price_per_unit * $this->unit->value ;
        $this->real_stock = $this->stock / $this->unit->value ;
        $this->tax_with_type = $this->tax ." (" . $this->taxType->name . ")" ;
    }
    

   

}
