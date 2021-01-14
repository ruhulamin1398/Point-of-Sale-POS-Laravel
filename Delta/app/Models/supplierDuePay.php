<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class supplierDuePay extends Model
{
    use HasFactory;
    use SoftDeletes;
    public function user(){
        return $this->belongsTo('App\Models\User','user_id','id')->withTrashed();
    }
    public function supplier(){
        return $this->belongsTo('App\Models\supplier','supplier','id')->withTrashed();
    }
}


