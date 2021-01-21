<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class customerDueReceive extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];

    public function user(){
        return $this->belongsTo('App\Models\User','user_id','id')->withTrashed();
    }
    public function customer(){
        return $this->belongsTo('App\Models\customer','customer_id','id')->withTrashed();
    }
    
    public function abasas(){
        $this->user_name = $this->user->name;
        $this->customer = $this->customer->name;
        $this->time = $this->created_at->format('d M, Y h:i:a');
    }
}
