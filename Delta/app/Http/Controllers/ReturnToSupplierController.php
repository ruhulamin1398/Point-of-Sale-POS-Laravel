<?php

namespace App\Http\Controllers;

use App\Models\returnToSupplier;
use App\Models\setting;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReturnToSupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $monthStart=Carbon::now()->format('Y-m-01 00:00:00');
        $monthEnd=Carbon::now()->format('Y-m-31 23:59:59');
        if( ! is_null($request->month)){
            $monthStart=Carbon::parse($request->month)->format('Y-m-01 00:00:00');
            $monthEnd=Carbon::parse($request->month)->format('Y-m-31 23:59:59');
        }
       // return compact('monthStart','monthEnd');
        $settings = setting::where('table_name', 'return_to_suppliers')->first();
        $settings->setting = json_decode(json_decode($settings->setting, true), true);
        $returnProducts =  returnToSupplier::where('created_at','>=',$monthStart)->where('created_at','<=',$monthEnd)->get();
        $dataArray = [
            'settings' => $settings,
            'items' =>$returnProducts,
        ];


        return view('product.return-product.supplier.index', compact('dataArray'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\returnToSupplier  $returnToSupplier
     * @return \Illuminate\Http\Response
     */
    public function show(returnToSupplier $returnToSupplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\returnToSupplier  $returnToSupplier
     * @return \Illuminate\Http\Response
     */
    public function edit(returnToSupplier $returnToSupplier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\returnToSupplier  $returnToSupplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, returnToSupplier $returnToSupplier)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\returnToSupplier  $returnToSupplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(returnToSupplier $returnToSupplier)
    {
        //
    }
}
