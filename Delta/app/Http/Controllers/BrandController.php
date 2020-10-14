<?php

namespace App\Http\Controllers;

use App\Http\Requests\BrandRequest;
use App\Models\brand;
use App\Models\setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

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
        brand::create($request->all());
        return redirect()->back()->withSuccess(['Successfully Created']);

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
        $brand->update($request->all());
        return redirect()->back()->withSuccess(['Successfully Updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(brand $brand)
    {
        $counts = $brand->product->count();
        if( $counts != 0 ){
            return Redirect::back()->withErrors(["Can't delete.","This Brand has Products. To delete it please change Brand in Product. " ]);
        }
        else{
            $brand->delete();
            return Redirect::back()->withErrors(["Item Deleted" ]);
        }


    }
}
