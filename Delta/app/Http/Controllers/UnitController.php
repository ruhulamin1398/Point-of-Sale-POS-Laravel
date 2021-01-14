<?php

namespace App\Http\Controllers;

use App\Models\productType;
use App\Models\setting;
use App\Models\unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $settings = setting::where('table_name','units')->first();
        $settings->setting= json_decode(  json_decode(  $settings->setting,true),true);

        $dataArray=[
            'settings'=>$settings,
            'items' => unit::all(),
            'product_types'=> productType::all(),
        ];


        return view('product.unit.index', compact('dataArray'));
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
        unit::create($request->all());
        return redirect()->back()->withSuccess(['Successfully Created']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function show(unit $unit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function edit(unit $unit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, unit $unit)
    {
        if($unit->id==1 ||$unit->id==2){
            $unit->name = $request->name;
            $unit->description = $request->description;
            $unit->save();


            return redirect()->back()->withSuccess(['Successfully Updated']);
        }
        $unit->update($request->all());
        return redirect()->back()->withSuccess(['Successfully Updated']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function destroy(unit $unit)
    {
        if($unit->id==1 ||$unit->id==2){
            return redirect()->back()->withErrors(["Can't Delete This Unit"]);
        }
        $unit->delete();
        return redirect()->back()->withErrors(['Item Deleted']);

    }
}
