<?php

namespace App\Http\Controllers;

use App\Models\dutyStatus;
use App\Models\employee;
use App\Models\employeeDuty;
use Illuminate\Http\Request;

class EmployeeDutyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 

        $employees = employee::all();
        $dutyStatuses = dutyStatus::all();
        return view('employees.duty',compact('employees','dutyStatuses'));
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
     * @param  \App\Models\employeeDuty  $employeeDuty
     * @return \Illuminate\Http\Response
     */
    public function show(employeeDuty $employeeDuty)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\employeeDuty  $employeeDuty
     * @return \Illuminate\Http\Response
     */
    public function edit(employeeDuty $employeeDuty)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\employeeDuty  $employeeDuty
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, employeeDuty $employeeDuty)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\employeeDuty  $employeeDuty
     * @return \Illuminate\Http\Response
     */
    public function destroy(employeeDuty $employeeDuty)
    {
        //
    }
}
