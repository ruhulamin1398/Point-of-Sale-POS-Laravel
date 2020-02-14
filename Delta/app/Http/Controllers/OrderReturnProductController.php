<?php

namespace App\Http\Controllers;

use App\orderReturnProduct;
use Illuminate\Http\Request;

class OrderReturnProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orderReturnProducts = orderReturnProduct::all();
        return view('customer.orderReturnProduct',compact('orderReturnProducts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
  ///
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
     * @param  \App\orderReturnProduct  $orderReturnProduct
     * @return \Illuminate\Http\Response
     */
    public function show(orderReturnProduct $orderReturnProduct)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\orderReturnProduct  $orderReturnProduct
     * @return \Illuminate\Http\Response
     */
    public function edit(orderReturnProduct $orderReturnProduct)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\orderReturnProduct  $orderReturnProduct
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, orderReturnProduct $orderReturnProduct)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\orderReturnProduct  $orderReturnProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy(orderReturnProduct $orderReturnProduct)
    {
        //
    }
}
