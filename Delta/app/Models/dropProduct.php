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
        return $this->hasOne('App\Models\employee','user_id','user_id')->withTrashed();
    }
    public function products(){
        return $this->belongsTo('App\Models\product','product_id','id')->withTrashed();
    }
    public function abasas(){
        // $this->products_count = $this->products->count();
         $this->user = $this->user->name;
         $this->product = $this->products->name;
         $this->date = $this->created_at->format('d M, Y');
    }   
}
