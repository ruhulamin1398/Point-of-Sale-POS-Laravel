<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class expenseType extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];


    public function expense(){
        return $this->hasMany('App\Models\expense');
    }

    public function abasas(){
        $this->expense_count = $this->expense->count();
    }   
}
