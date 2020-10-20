<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReturnProductRequest;
use App\Models\customer;
use App\Models\Product;
use App\Models\returnProduct;
use App\Models\setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ReturnProductController extends Controller
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
        $settings = setting::where('table_name', 'return_products')->first();
        $settings->setting = json_decode(json_decode($settings->setting, true), true);
        $returnProducts =  returnProduct::where('created_at','>=',$monthStart)->where('created_at','<=',$monthEnd)->get();
        $products = Product::all();
        $dataArray = [
            'settings' => $settings,
            'items' =>$returnProducts,
            'products' =>$products,
            'customers' => customer::all(),
        ];


        return view('product.return-product.index', compact('dataArray'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.return-product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReturnProductRequest $request)
    {
        // return $request;
        returnProduct::create($request->all());
        return redirect()->back()->withSuccess(['Successfully Created']);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\returnProduct  $returnProduct
     * @return \Illuminate\Http\Response
     */
    public function show(returnProduct $returnProduct)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\returnProduct  $returnProduct
     * @return \Illuminate\Http\Response
     */
    public function edit(returnProduct $returnProduct)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\returnProduct  $returnProduct
     * @return \Illuminate\Http\Response
     */
    public function update(ReturnProductRequest $request, returnProduct $returnProduct)
    {
        
        $returnProduct->update($request->all());
        return redirect()->back()->withSuccess(['Successfully Updated']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\returnProduct  $returnProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy(returnProduct $returnProduct)
    {
       
        $returnProduct->delete();
        return Redirect::back()->withErrors(["Item Deleted" ]);


    }
}
