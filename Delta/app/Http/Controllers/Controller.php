<?php

namespace App\Http\Controllers;

use App\Models\unit;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function calPricePerUnit($sell,$unit_id){

        $unit = unit::find($unit_id);
        $price_per_unit=  $sell/$unit->value;
        return $price_per_unit;

    }

}
