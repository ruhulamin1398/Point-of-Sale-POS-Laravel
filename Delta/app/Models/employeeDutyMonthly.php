<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class employeeDutyMonthly extends Model
{
    use HasFactory;
    use SoftDeletes; 
    
    
    
    public function employee(){
        return $this->belongsTo('App\Models\employee','employee_id','id')->withTrashed();
    }
    
    public function abasas(){
        $this->employee = $this->employee->name;
    } 
}
