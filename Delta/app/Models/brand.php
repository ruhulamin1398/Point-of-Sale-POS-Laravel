<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class brand extends Model
{
    use HasFactory;

    use SoftDeletes;
    protected $guarded = [];

    
    public function product(){
        return $this->hasMany('App\Models\product');
    }


    public function abasas(){
        //
    }   
}
