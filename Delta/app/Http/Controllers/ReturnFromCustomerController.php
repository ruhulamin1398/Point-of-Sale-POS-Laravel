<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\returnFromCustomer;
use App\Models\setting;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReturnFromCustomerController extends Controller
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
        $settings = setting::where('table_name', 'return_from_customers')->first();
        $settings->setting = json_decode(json_decode($settings->setting, true), true);
        $returnProducts =  returnFromCustomer::where('created_at','>=',$monthStart)->where('created_at','<=',$monthEnd)->get();
        $dataArray = [
            'settings' => $settings,
            'items' =>$returnProducts,
        ];


        return view('product.return-product.customer.index', compact('dataArray'));
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
     * @param  \App\Models\returnFromCustomer  $returnFromCustomer
     * @return \Illuminate\Http\Response
     */
    public function show(returnFromCustomer $returnFromCustomer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\returnFromCustomer  $returnFromCustomer
     * @return \Illuminate\Http\Response
     */
    public function edit(returnFromCustomer $returnFromCustomer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\returnFromCustomer  $returnFromCustomer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, returnFromCustomer $returnFromCustomer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\returnFromCustomer  $returnFromCustomer
     * @return \Illuminate\Http\Response
     */
    public function destroy(returnFromCustomer $returnFromCustomer)
    {
        //
    }
}
