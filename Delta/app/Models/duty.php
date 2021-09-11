<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class duty extends Model
{
    use HasFactory;
    protected $guarded = [];

    
    
    
    public function Status(){
        return $this->belongsTo('App\Models\dutyStatus','status_id','id')->withTrashed();
    }



    public function abasas(){
        //////
    } 
}
