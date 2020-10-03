<?php

namespace App\Http\Controllers;

use App\Models\dutyStatus;
use Illuminate\Http\Request;

class DutyStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $dutyStatus = dutyStatus::all();
        return view('dutystatus.index',compact('dutyStatus'));
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
        return $request;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\dutyStatus  $dutyStatus
     * @return \Illuminate\Http\Response
     */
    public function show(dutyStatus $dutyStatus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\dutyStatus  $dutyStatus
     * @return \Illuminate\Http\Response
     */
    public function edit(dutyStatus $dutyStatus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\dutyStatus  $dutyStatus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, dutyStatus $dutyStatus)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\dutyStatus  $dutyStatus
     * @return \Illuminate\Http\Response
     */
    public function destroy(dutyStatus $dutyStatus)
    {
        //
    }
}
