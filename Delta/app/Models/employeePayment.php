<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class employeePayment extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function employees(){
        return $this->belongsTo('App\Models\employee','employee_id','id');
    }
    

    public function salary_status(){
        return $this->belongsTo('App\Models\salaryStatus','salary_status_id','id');
    }
    





}
