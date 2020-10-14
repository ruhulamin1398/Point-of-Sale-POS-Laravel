<?php

namespace App\Http\Controllers;

use App\Models\paymentSystem;
use App\Models\setting;
use Illuminate\Http\Request;

class PaymentSystemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       

        $settings = setting::where('table_name','payment_systems')->first();
        $settings->setting= json_decode(  json_decode(  $settings->setting,true),true);
        
                
                $dataArray=[
                    'settings'=>$settings,
                    'items' => paymentSystem::all(),
                ];
        
        
                return view('payment-system.index', compact('dataArray'));
        
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
        // only crateable non editable or delatable 


        // paymentSystem::create($request->all());
        // return redirect()->back()->withSuccess(['Successfully Created']);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\paymentSystem  $paymentSystem
     * @return \Illuminate\Http\Response
     */
    public function show(paymentSystem $paymentSystem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\paymentSystem  $paymentSystem
     * @return \Illuminate\Http\Response
     */
    public function edit(paymentSystem $paymentSystem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\paymentSystem  $paymentSystem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, paymentSystem $paymentSystem)
    {
        return back();

        
        // $paymentSystem->update($request->all());
        // return redirect()->back()->withSuccess(['Successfully Updated']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\paymentSystem  $paymentSystem
     * @return \Illuminate\Http\Response
     */
    public function destroy(paymentSystem $paymentSystem)
    {
        return back();


        // $dropProduct->delete();
        // return Redirect::back()->withErrors(["Item Deleted" ]);

    }
}
