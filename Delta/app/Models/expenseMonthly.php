<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class expenseMonthly extends Model
{
    use HasFactory;  
    use SoftDeletes;  
    protected $guarded = [];

    public function employee(){
        return $this->belongsTo('App\Models\employee','employee_id','id')->withTrashed();
    }


    public function abasas(){
        $this->employee = $this->employee->name;
    }
}
