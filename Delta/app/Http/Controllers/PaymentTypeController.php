<?php

namespace App\Http\Controllers;

use App\payment_type;
use Illuminate\Http\Request;

class PaymentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\payment_type  $payment_type
     * @return \Illuminate\Http\Response
     */
    public function show(payment_type $payment_type)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\payment_type  $payment_type
     * @return \Illuminate\Http\Response
     */
    public function edit(payment_type $payment_type)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\payment_type  $payment_type
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, payment_type $payment_type)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\payment_type  $payment_type
     * @return \Illuminate\Http\Response
     */
    public function destroy(payment_type $payment_type)
    {
        //
    }
}
