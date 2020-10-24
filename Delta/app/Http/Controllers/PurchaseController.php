<?php

namespace App\Http\Controllers;

use App\Models\paymentSystem;
use App\Models\Product;
use App\Models\purchase;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $monthStart = Carbon:: now()->format('Y-m-01 00:00:00');
        $monthEnd = Carbon:: now()->format('Y-m-31 23:59:59');
        if(! is_null($request->month)){
            $monthStart = Carbon:: parse($request->month)->format('Y-m-01 00:00:00');
            $monthEnd = Carbon:: parse($request->month)->format('Y-m-31 23:59:59');
        }
        $month = Carbon:: parse($monthStart)->format('F, Y');
        $purchases= purchase::where('created_at','>=',$monthStart)->where('created_at','<=',$monthEnd)->get();

        return view('product.purchase.index',compact('purchases','month'));
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $paymentSystems = paymentSystem::all();
        return view('product.purchase.create',compact('paymentSystems'));
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
     * @param  \App\Models\purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function show(purchase $purchase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function edit(purchase $purchase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, purchase $purchase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function destroy(purchase $purchase)
    {
        //
    }
}
