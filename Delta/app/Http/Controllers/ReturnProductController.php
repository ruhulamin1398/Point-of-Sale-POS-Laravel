<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReturnProductRequest;
use App\Models\customer;
use App\Models\Product;
use App\Models\returnProduct;
use App\Models\setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ReturnProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $settings = setting::where('table_name', 'return_products')->first();
        $settings->setting = json_decode(json_decode($settings->setting, true), true);


        $dataArray = [
            'settings' => $settings,
            'items' => returnProduct::all(),
            'products' => Product::all(),
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
        //
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
        return Redirect::back()->withSuccess(["Item Deleted" ]);


    }
}
