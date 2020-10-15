<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class expenseMonthly extends Model
{
    use HasFactory;    
    protected $guarded = [];

    public function employee(){
        return $this->belongsTo('App\Models\employee','employee_id','id');
    }


    public function abasas(){
        $this->employee = $this->employee->name;
    }
}
