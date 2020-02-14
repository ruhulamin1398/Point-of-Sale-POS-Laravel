<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BarCodePrinterController extends Controller
{
    public function index(){
        return view('barcode.barcode');
    }

    public function print( Request $request){
        $id=$request->id;
        $amount= $request->amount;
        return view('barcode.barcodePrint',compact('amount','id'));
    }
}
