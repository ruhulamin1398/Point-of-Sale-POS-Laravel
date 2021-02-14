<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Models\customer;
use App\Models\onlineSync;
use App\Models\order;
use App\Models\setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use LengthException;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        if(! auth()->user()->hasPermissionTo('Customer Page')){
            return abort(401);
        }
         
        $settings = setting::where('table_name','customers')->first();
        $settings->setting= json_decode(  json_decode(  $settings->setting,true),true);
        
                
                $dataArray=[
                    'settings'=>$settings,
                    'items' => customer::all(),
                    'page_name'=>'Customer',
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
        
      $customer = customer::create($request->all());
       $this->onlineSync('customer','create',$customer->id);
       return redirect()->back()->withSuccess(['Successfully Created']);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(customer $customer, Request $request)
    {
        
        if(! auth()->user()->hasPermissionTo('Customer View')){
            return abort(401);
        }
        $monthStart= Carbon::now()->format('Y-m-01 00:00:00');
        $monthEnd= Carbon:: now()->format('Y-m-31 23:59:59');
        if(!is_null($request->month)){
            $monthStart= Carbon:: parse($request->month)->format('Y-m-01 00:00:00');
            $monthEnd= Carbon:: parse($request->month)->format('Y-m-31 23:59:59');
        }
       $month = Carbon:: parse($monthStart)->format('F');
        $orders= order::where('customer_id', $customer->id)->where('created_at','<=',$monthEnd)->where('created_at','>=',$monthStart)->get(); 
        
        $settings = setting::where('table_name', 'orders')->first();
        $settings->setting = json_decode(json_decode($settings->setting, true), true);


        $dataArray = [
            'settings' => $settings,
            'items' => $orders,
            'page_name' => 'Order',
        ];
        return view('customers.show',compact('customer','dataArray','month'));
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
    public function update(Request $request, customer $customer)
    {
        
        if(!is_null($request->phone))
        {
            $length= strlen($request->phone);
            if($length != 11){
                return Redirect::back()->withErrors(['Enter a valid phone' ]);
            }
            $customers = customer::where('phone',$request->phone)->first();
            if(!is_null($customers) && $customers->id != $request->id){
                return Redirect::back()->withErrors(['Phone is already Taken']);
            }
        }   
        $customer->update($request->all());
        $this->onlineSync('customer','update',$customer->id);
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
        
        // there some thinking is required 
        if($customer->id ==1 )
        {
            return Redirect::back()->withErrors(['This Customer Can not be Deleted' ]);

        }
        if($customer->due !=0 )
        {
            return Redirect::back()->withErrors(["Can not delete this customer. This customer has due" ]);
        }
        $customer->delete();   
        $this->onlineSync('customer','delete',$customer->id);
        return Redirect::back()->withErrors(["Item Deleted" ]);
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

// public function customersDue(Request $request)
// {
//     // return $request;
//     $customer = Customer::find($request->id);
//     return $customer;
//     $customer->due = $request->due;
//     $customer->save();
//     return $customer->due;
// }


public function customerFind(Request $request){
    $customer = customer::find($request->id);
    return $customer;
}






public function customerStore(Request $request){

    $customer= new customer;
    $customer->name = $request->name;
    $customer->phone = $request->phone;
    $customer->address = $request->address;
    $customer->company = $request->company;
    $customer->due = 0;
    $customer->save();

    
    $this->onlineSync('customer','create',$customer->id);
    return $customer;
    
}




}
