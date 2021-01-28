<?php

namespace App\Http\Controllers;

use App\Models\image;
use App\Models\posSetting;
use Illuminate\Http\Request;

class PosSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pos-setting.index');
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


        $posSetting = new posSetting;
        $posSetting->shop_name = $request->shop_name;
        $posSetting->shop_moto = $request->shop_moto;
        $posSetting->shop_phone = $request->shop_phone;
        $posSetting->shop_email = $request->shop_email;
        $posSetting->language = $request->language;
        $posSetting->due_system = $request->due_system;
        $posSetting->customer_due = $request->customer_due;
        $posSetting->supplier_due = $request->supplier_due;


        if(!is_null($request->logo)){

            $logoFileName = time() . $request->logo->getClientOriginalName();
            request()->logo->move(public_path('image'), $logoFileName);
            $posSetting->logo = $logoFileName;

        }

        

         $posSetting->save();
     
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\posSetting  $posSetting
     * @return \Illuminate\Http\Response
     */
    public function show(posSetting $posSetting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\posSetting  $posSetting
     * @return \Illuminate\Http\Response
     */
    public function edit(posSetting $posSetting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\posSetting  $posSetting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, posSetting $posSetting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\posSetting  $posSetting
     * @return \Illuminate\Http\Response
     */
    public function destroy(posSetting $posSetting)
    {
        //
    }
}
