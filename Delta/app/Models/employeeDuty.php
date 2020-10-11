<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class employeeDuty extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function dutyStatus(){
        return $this->belongsTo('App\Models\dutyStatus','duty_status_id','id');
    }

    
      public function employee(){
        return $this->belongsTo('App\Models\employee');
    }



    
    public function abasas(){
        $this->duty_status_name=$this->dutyStatus->name;
 
     }
}
