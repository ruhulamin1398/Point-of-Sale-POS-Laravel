<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class employee extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];

    public function designation()
    {
        
     return $this->belongsTo('App\Models\designation','designation_id','id');

    }

    public function userName()
    {
        
     return $this->belongsTo('App\Models\user','user_id','id');

    }
    


    public function abasas(){
        $this->designation = $this->designation->name;
    }   

    
}
