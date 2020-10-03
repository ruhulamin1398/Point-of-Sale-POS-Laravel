<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function __construct(){
    


    }

    public function category(){
        return $this->belongsTo('App\Models\category','category_id','id');
    }
    
    
    public function category_name(){

  $this->category_name =  $this->category->name;
    }


//   protected  $name =  $this->category_name();
   
   

}
