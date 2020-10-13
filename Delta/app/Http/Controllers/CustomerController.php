<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Models\customer;
use App\Models\setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         
        $settings = setting::where('table_name','customers')->first();
        $settings->setting= json_decode(  json_decode(  $settings->setting,true),true);
        
                
                $dataArray=[
                    'settings'=>$settings,
                    'items' => customer::all(),
                ];
        
        
                return view('customers.index', compact('dataArray'));


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
    public function store(CustomerRequest $request)
    {
        customer::create($request->all());
        return redirect()->back()->withSuccess(['Successfully Created']);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerRequest $request, customer $customer)
    {
        
        
        $customer->update($request->all());
        return redirect()->back()->withSuccess(['Successfully Updated']);

    
        // $customer->name= $request->name;
        // $customer->phone= $request->phone;
        // $customer->address= $request->address;
        // $customer->company= $request->company;
        // $customer->save();
        // return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(customer $customer)
    {
        $customer->delete();    
        return Redirect::back()->withSuccess(["Item Deleted" ]);
    }






//   Api Area Start

public function apiIndex()
{
    $customers = Customer::all();
    return ($customers);
}

public function ApiShow(Request $request)
{
    ///   return $request->phone;
    $customer = Customer::where('phone', $request->phone)->first();
    if($customer->id ==1)
    {   

        $customer->due=0;
        $customer->save();
    }
    return $customer;
}

 public function apiCustomerCheck(Request $request,customer $customer)
{
    $phone = $request->phone;
   $customer = customer::where('phone',$phone)->first();
      
//    return $customer;
    
 if (is_null($customer))
 {
   return 0;

 }else{
     return 1;
 }

}

public function customersDue(Request $request)
{
    // return $request;
    $customer = Customer::find($request->id);
    return $customer;
    $customer->due = $request->due;
    $customer->save();
    return $customer->due;
}






}
