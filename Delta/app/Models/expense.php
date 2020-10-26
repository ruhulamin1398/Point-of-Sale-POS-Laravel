<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class expense extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];
   
    public function employee()
    {
        return $this->belongsTo('App\Models\employee','employee_id','id')->withTrashed();
    }
    public function expenseType()
    {
        return $this->belongsTo('App\Models\expenseType','expense_type_id','id')->withTrashed();
    }


    public function abasas(){
        $this->employee = $this->employee->name;
        $this->expense_type = $this->expenseType->name;
        $this->date = Carbon::parse($this->created_at)->format('d M, Y');
       
    }   
}
