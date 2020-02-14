<?php

namespace App\Http\Controllers;

use App\Order_detail;
use App\Product;
use Illuminate\Http\Request;

class OrderDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //
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



    public function removeQuantity($id, $quantity)
    {
        $product = Product::find($id);
        $product->stock -= $quantity;
        $product->save();
    }





    public function store(Request $request)
    {

        $order_detail = new Order_detail();
        $order_detail->order_id = $request->order_id;
        $order_detail->product_id = $request->product_id;
        $order_detail->price = $request->price;
        $order_detail->quantity = $request->quantity;
        $order_detail->total = $request->total;
        $order_detail->save();

        $this->removeQuantity($request->product_id, $request->quantity);

        return ($order_detail->id);
    }






    /**
     * Display the specified resource.
     *
     * @param  \App\Order_detail  $order_detail
     * @return \Illuminate\Http\Response
     */
    public function show(Order_detail $order_detail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order_detail  $order_detail
     * @return \Illuminate\Http\Response
     */
    public function edit(Order_detail $order_detail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order_detail  $order_detail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order_detail $order_detail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order_detail  $order_detail
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order_detail $order_detail)
    {
        //
    }
}
