<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeDutyRequest;
use App\Models\dutyStatus;
use App\Models\employee;
use App\Models\employeeDuty;
use Carbon\Carbon;
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
    public function store(EmployeeDutyRequest $request)
    {
        //return $request;

       $employee=employee::find($request->employee_id);
        $employeeDuty = employeeDuty::where('employee_id',$request->employee_id)->where('date',$request->date)->first();
        if(is_null($employeeDuty)){
            $employeeDuty= new employeeDuty;
            $employeeDuty->employee_id=$request->employee_id;
            $employeeDuty->date=$request->date;
        }
        $employeeDuty->duty_status_id=$request->duty_status_id;
        $employeeDuty->fixed_duty_hour=$employee->fixed_duty_hour;
        $employeeDuty->comment=$request->comment;
        if($employeeDuty->duty_status_id==1)
        {
            if(!is_null($request->enter_time)){
                $employeeDuty->enter_time=$request->enter_time;
               
            }
            if(!is_null($request->exit_time)){
                $employeeDuty->exit_time=$request->exit_time;
            }
            if(!is_null($employeeDuty->enter_time) && !is_null($employeeDuty->exit_time))
            {
                $difference = Carbon::parse($employeeDuty->enter_time)->diff(Carbon::parse($employeeDuty->exit_time))->format('%H:%I:%S');
                $employeeDuty->worked_hour=$difference;
            }
        }
        $employeeDuty->save();
        return back();

        

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
    public function update(EmployeeDutyRequest $request, employeeDuty $employeeDuty)
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
