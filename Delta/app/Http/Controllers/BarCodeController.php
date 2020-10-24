<?php

namespace App\Http\Controllers;

use App\Models\barCode;
use App\Models\Product;
use Illuminate\Http\Request;

class BarCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('product.barcode.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = product::find($request->product_id);
      
        $amount= $request->quantity;
        return view('product.barcode.print',compact('product','amount'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\barCode  $barCode
     * @return \Illuminate\Http\Response
     */
    public function show(barCode $barCode)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\barCode  $barCode
     * @return \Illuminate\Http\Response
     */
    public function edit(barCode $barCode)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\barCode  $barCode
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, barCode $barCode)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\barCode  $barCode
     * @return \Illuminate\Http\Response
     */
    public function destroy(barCode $barCode)
    {
        //
    }
}
