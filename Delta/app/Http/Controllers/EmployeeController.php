<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Models\employee;
use App\Models\User;
use App\Models\designation;
use App\Models\setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    
        $settings = setting::where('table_name','employees')->first();
        $settings->setting= json_decode(  json_decode(  $settings->setting,true),true);
        
                
                $dataArray=[
                    'settings'=>$settings,
                    'items' => employee::all(),
                    'users'=> User::all(),
                    'designations'=> designation::all(),
                ];
        
        
                return view('employees.index', compact('dataArray'));
        

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
    public function store(EmployeeRequest $request)
    {
         
        employee::create($request->all());
        return redirect()->back()->withSuccess(['Successfully Created']);



    //    $employee = new employee;
    //    $employee->name = $request->name;
    //    $employee->phone = $request->phone;
    //    $employee->address = $request->address;
    //    $employee->joining_date = $request->joining_date;
    //    $employee->reference = $request->reference;
    //    $employee->term_of_contract = $request->term_of_contract;
    //    $employee->fixed_duty_hour = $request->fixed_duty_hour;
    //    $employee->salary = $request->salary;
    //    $employee->designation_id = $request->designation_id;

       


    //    $employee->save();
    //    return back();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeeRequest $request, employee $employee)
    {    
        
        $employee->update($request->all());
        return redirect()->back()->withSuccess(['Successfully Updated']);

 
        // $employee->name = $request->name;
        // $employee->phone = $request->phone;
        // $employee->address = $request->address;
        // $employee->joining_date = $request->joining_date;
        // $employee->reference = $request->reference;
        // $employee->term_of_contract = $request->term_of_contract;
        // $employee->fixed_duty_hour = $request->fixed_duty_hour;
        // $employee->salary = $request->salary;
        // $employee->designation_id = $request->designation_id;
        // $employee->save();
        // return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(employee $employee)
    {
        $employee->delete();
        return Redirect::back()->withErrors(["Item Deleted" ]);
    }
}
