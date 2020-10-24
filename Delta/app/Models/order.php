<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class order extends Model
{
    use HasFactory;
    use SoftDeletes;
    public function user(){
        return $this->belongsTo('App\Models\User','user_id','id');
    }
    public function customer(){
        return $this->belongsTo('App\Models\customer','customer_id','id');
    }
}
