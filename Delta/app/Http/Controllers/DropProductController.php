<?php

namespace App\Http\Controllers;

use App\Http\Requests\DropProductRequest;
use App\Models\dropProduct;
use App\Models\Product;
use App\Models\setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class DropProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (is_null($request->month)) {
            $monthstart = Carbon::now()->format("Y-m-01 00:00:00");
            $monthend = Carbon::now()->format("Y-m-31 23:59:59");
        } else {
            $monthstart = $request->month . "-01 00:00:00";
            $monthend = $request->month . "-31 23:59:59";
        }
        //return compact('monthstart','monthend');
        $settings = setting::where('table_name', 'drop_products')->first();
        $settings->setting = json_decode(json_decode($settings->setting, true), true);
        $dropProducts = dropProduct::where('created_at', '>=', $monthstart)->where('created_at', '<=', $monthend)->get();

        $dataArray = [
            'settings' => $settings,
            'items' => $dropProducts,
        ];


        return view('product.dropProduct.index', compact('dataArray'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $daystart = Carbon::now()->format("Y-m-d 00:00:00");
        $dayend = Carbon::now()->format("Y-m-d 23:59:59");
        $settings = setting::where('table_name', 'drop_products')->first();
        $settings->setting = json_decode(json_decode($settings->setting, true), true);
        $dropProducts = dropProduct::where('created_at', '>=', $daystart)->where('created_at', '<=', $dayend)->get();
        $dataArray = [
            'settings' => $settings,
            'items' => $dropProducts,
        ];


        $products = Product::all();
        return view('product.dropProduct.create',compact('dataArray','products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DropProductRequest $request)
    {
        if($request->quantity < 0 ){
            return redirect()->back()->withErrors(['Quantity must be greater than 0']);
        }
        $product = product::find($request->product_id);
        if ($product->stock >= $request->quantity) {

            $dropProduct = new dropProduct;
            $dropProduct->user_id = 1;  // auth must be added here
            $dropProduct->product_id = $request->product_id;
            $dropProduct->quantity = $request->quantity;
            $dropProduct->comment = $request->comment;
            $product->stock -= $dropProduct->quantity;
            $product->save();
            $dropProduct->save();
            return redirect()->back()->withSuccess(['Successfully Dropped']);
        }
        else{
            return redirect()->back()->withErrors(['Products Stock is less than Drop quantity']);
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\dropProduct  $dropProduct
     * @return \Illuminate\Http\Response
     */
    public function show(dropProduct $dropProduct)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\dropProduct  $dropProduct
     * @return \Illuminate\Http\Response
     */
    public function edit(dropProduct $dropProduct)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\dropProduct  $dropProduct
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, dropProduct $dropProduct)
    {
        if($request->quantity < 0 ){
            return redirect()->back()->withErrors(['Quantity must be greater than 0']);
        }
        $product = Product::find($dropProduct->product_id);
        $dropProduct->changed_quantity -= $dropProduct->quantity;
        $dropProduct->changed_quantity += $request->quantity;
        $changedNow = $request->quantity - $dropProduct->quantity;
        $dropProduct->quantity = $request->quantity;
        $dropProduct->comment = $request->comment;
        if( $changedNow >= $product->stock){
            return redirect()->back()->withErrors(['Products Stock is less than Drop quantity']);
        }
        $product->stock -= $changedNow;
        $product->save();
        $dropProduct->save();
        return redirect()->back()->withSuccess(['Successfully Updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\dropProduct  $dropProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy(dropProduct $dropProduct)
    {
        $product = Product:: find($dropProduct->product_id);
        $product->stock += $dropProduct->quantity;
        $product->save();
        $dropProduct->delete();
        return Redirect::back()->withErrors(["Item Deleted"]);
    }
}
