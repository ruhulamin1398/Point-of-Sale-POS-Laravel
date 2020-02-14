<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class drop_product extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}
