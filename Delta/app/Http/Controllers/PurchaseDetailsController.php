<?php

namespace App\Http\Controllers;

use App\Product;
use App\Purchase_details;
use Illuminate\Http\Request;

class PurchaseDetailsController extends Controller
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
        /////;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */



    public function addQuantity($id, $quantity)
    {
        $product = Product::find($id);
        $product->stock += $quantity;
        $product->save();
    }


    public function updateCost($id, $quantity, $cost)
    {

        $newCost = $cost / $quantity;
        $product = Product::find($id);
         $product->cost = $newCost;
        $product->save();
    }

    
    public function store(Request $request)
    {
        $purchase_details = new Purchase_details();
        $purchase_details->purchase_id = $request->purchase_id;
        $purchase_details->product_id = $request->product_id;
        $purchase_details->price = $request->price;
        $purchase_details->quantity = $request->quantity;
        $purchase_details->total = $request->total;
        $purchase_details->save();

        $this->addQuantity($request->product_id, $request->quantity);
        $this->updateCost($request->product_id, $request->quantity, $request->total);

        return ($purchase_details->id);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Purchase_details  $purchase_details
     * @return \Illuminate\Http\Response
     */
    public function show(Purchase_details $purchase_details)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Purchase_details  $purchase_details
     * @return \Illuminate\Http\Response
     */
    public function edit(Purchase_details $purchase_details)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Purchase_details  $purchase_details
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Purchase_details $purchase_details)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Purchase_details  $purchase_details
     * @return \Illuminate\Http\Response
     */
    public function destroy(Purchase_details $purchase_details)
    {
        //
    }
}
