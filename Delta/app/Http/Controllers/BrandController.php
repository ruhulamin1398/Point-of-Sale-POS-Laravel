<?php

namespace App\Http\Controllers;

use App\Http\Requests\BrandRequest;
use App\Models\brand;
use App\Models\setting;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {    
                
        $settings = setting::where('table_name','brands')->first();
        $settings->setting= json_decode(  json_decode(  $settings->setting,true),true);
        
        $dataArray=[
            'settings'=>$settings,
            'items' => brand::all(),
        ];
        return view('product.brand.index', compact('dataArray'));
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
    public function store(BrandRequest $request)

    {
         //return $request;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(brand $brand)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(BrandRequest $request, brand $brand)
    {
        $brand->name= $request->name;
        $brand->description= $request->description;
        $brand->save();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(brand $brand)
    {
        $brand->delete();
        return back();
    }
}
