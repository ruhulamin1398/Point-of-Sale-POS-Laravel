<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cost extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
