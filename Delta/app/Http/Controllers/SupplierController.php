<?php

namespace App\Http\Controllers;

use App\Http\Requests\SupplierRequest;
use App\Models\Product;
use App\Models\setting;
use App\Models\supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
$settings = setting::where('table_name','suppliers')->first();
$settings->setting= json_decode(  json_decode(  $settings->setting,true),true);

        
        $dataArray=[
            'settings'=>$settings,
            'items' => supplier::all(),
        ];
 
        // return $dataArray;

        return view('suppliers.index', compact('dataArray'));


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
    public function store(SupplierRequest $request)
    {
      //  return $request;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(supplier $supplier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(SupplierRequest $request, supplier $supplier)
    {
        $supplier->name= $request->name;
        $supplier->phone= $request->phone;
        $supplier->address= $request->address;
        $supplier->company= $request->company;
        $supplier->save();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(supplier $supplier)
    {
        $supplier->delete();
        return back();
    }

 



    public function supplierCheck(Request $request){



        $supplier = supplier::where('phone',$request->phone)->first();
        if (is_null($supplier)) {
            return 0;
        } else{
           
            return $supplier;
        }

    }






    public function supplierStore(Request $request){

        $supplier= new supplier;
        $supplier->name = $request->name;
        $supplier->phone = $request->phone;
        $supplier->address = $request->address;
        $supplier->company = $request->company;
        $supplier->due = 0;
        $supplier->save();
        return $supplier;
        
    }
}



