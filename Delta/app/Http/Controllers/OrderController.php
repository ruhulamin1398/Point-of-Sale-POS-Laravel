<?php

namespace App\Http\Controllers;

use App\Models\order;
use App\Models\orderDetail;
use App\Models\paymentSystem;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('order.index');
    }
  

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
            
        $paymentSystems = paymentSystem::all();
       
        return view('product.order.create',compact('paymentSystems'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;
        // validation later
        $order = new order;
        $order->user_id= 1;
        $order->customer_id=$request->order['customer_id'];
        $order->payment_system_id= $request->order['payment_system_id'];
        $order->paid_amount= $request->order['paid_amount'];
        $order->tax= $request->order['tax'];
        $order->cost =$request->order['cost'];
        $order->pre_due=$request->order['pre_due'];
        $order->due=$request->order['due'];
        $order->discount=$request->order['discount'];
        $order->profit =$request->order['discount'];
        $order->total=$request->order['profit'];
        
        $order->save();
        
   

        foreach($request->order_details as $product){

            $orderDetail = new orderDetail;
            $orderDetail->order_id = $order->id;
            $orderDetail->product_id = $product['id'];
            $orderDetail->price = $product['price'];
            $orderDetail->quantity = $product['quantity'];
            $orderDetail->discount = $product['discount'];
            $orderDetail->tax = $product['tax'];
            
            $orderDetail->cost = $product['cost'];
            $orderDetail->total = $product['total'];
            $orderDetail->profit = $product['profit'];

             $product->save();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(order $order)
    {
        //
    }
}
