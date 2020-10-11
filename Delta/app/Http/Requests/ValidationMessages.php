<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidationMessages 
{
    public  function require($name){
        return $name . ' is Required';
    }
    public  function unique($name){
        return $name . ' is already taken';
    }
}
