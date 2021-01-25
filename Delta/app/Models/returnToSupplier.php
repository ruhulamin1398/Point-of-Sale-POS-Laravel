<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class returnToSupplier extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];

    public function products(){
        return $this->belongsTo('App\Models\Product','product_id','id')->withTrashed();
    }
    public function supplier(){
        return $this->belongsTo('App\Models\supplier','supplier_id','id')->withTrashed();
    }
    public function user(){
        return $this->belongsTo('App\Models\User','user_id','id')->withTrashed();
    }
    public function abasas(){
        $this->product = $this->products->name;
        $this->supplier = $this->supplier->name;
        $this->user = $this->user->name;
        $this->time = $this->created_at->format('d M, Y h:i:a');
    }

}
