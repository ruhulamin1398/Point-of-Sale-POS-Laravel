<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use App\customerCashReceive;
use App\Order;
use App\Supplier;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $suppliers = Supplier::all();
        $customers = Customer::all();


        return view('customer.view', compact('customers', 'suppliers'));
    }

    public function apiIndex()
    {
        $customers = Customer::all();
        return ($customers);
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
        $request->validate([
            'phone' => 'required|unique:customers|max:11|min:11',
        ]);

        $customer = new Customer();

        $customer->phone = $request->phone;
        $customer->name = $request->name;
        $customer->address = $request->address;
        $customer->due = 0;
        $customer->save();
        return back();
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
            return 'hhhaha';
    }
    public function ApiShow(Request $request)
    {
        ///   return $request->phone;
        $customer = Customer::where('phone', $request->phone)->first();
        return $customer;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {

        Customer::find($id)->delete();
        return redirect(route('customers.index'))->with('successMsg', 'Customer Successfully Deleted');
    }
    public function customersupdate(Request $request)
    {
        //  return $request;
        $request->validate([
            'phone' => 'required|unique:customers|max:11|min:11',
        ]);



        $customer = Customer::find($request->id);
        //  return $customer;
        $customer->phone = $request->phone;
        $customer->name = $request->name;
        $customer->address = $request->address;

        $customer->save();
        //return $customer;

        return redirect(route('customers.index'))->with('successMsg', 'Customer Successfully updated');
    }



    public function apiCustomerCheck(Request $request)
    {

        $phone = $request->phone;
        /// return $phone;


        $customer = Customer::where('phone', $phone)->first();
        // return $supplier;

        if (is_null($customer)) {
            return 0;
        } else
            return 1;
    }
    public function customersDue(Request $request)
    {
        // return $request;
        $customer = Customer::find($request->id);
        $customer->due = $request->due;
        $customer->save();
        return $customer->due;
    }

    public function customersCashReceiveCreate(Request $request)
    {
        $orders = Order::all();
        return view('customer.cashReceive', compact('orders'));
    }


    public function customersCashReceiveStore(Request $request)
    {

        // return $request;
        $customerCashReceive = new customerCashReceive;
        $customerCashReceive->user_id = 1;
        $customerCashReceive->customer_id = $request->customer_id;
        $customerCashReceive->amount = $request->amount;
        $customerCashReceive->comment = $request->comment;  
        $customerCashReceive->pre_due= $request->pre_due;
        $customerCashReceive->save();

        $customer = Customer::find( $request->customer_id);
        $customer->due -= $request->amount;
        $customer->save();
      

        return view( "receipt.customerCashReceive",compact('customerCashReceive', 'customerCashReceive') );
    }

    
    public function customersCashReceiveIndex(){

        $customerCashReceives = customerCashReceive::all();
        
        return view('customer.customerCashReceiveAll',compact('customerCashReceives'));
    }

    
}
