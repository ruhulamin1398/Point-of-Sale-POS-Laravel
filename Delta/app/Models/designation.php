<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class designation extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];
    
    
    public function employee(){
        return $this->hasMany('App\Models\employee');
    }

    public function abasas(){
        //
    }   
   


}
