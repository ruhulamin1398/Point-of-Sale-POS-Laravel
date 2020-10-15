<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class employeeSalary extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];

public  function employee()
{
   return  $this->belongsTo('App\Models\employee','employee_id','id');
}
public  function salaryStatus()
{
   return  $this->belongsTo('App\Models\salaryStatus','salary_status_id','id');
}
 
    public function abasas(){
        $this->employee = $this->employee->name;
        $this->salary_status = $this->salaryStatus->name;
        $this->month =Carbon::parse( $this->month)->format('F, Y');
    }   
}
