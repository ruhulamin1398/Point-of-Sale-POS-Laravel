<?php

namespace App\Http\Controllers;

use App\Models\employee;
use App\Models\employeeSalary;
use App\Models\salaryStatus;
use App\Models\setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class EmployeeSalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $month = Carbon::now()->format('Y-m-01');
        if(!is_null($request->month)){
            $month = $request->month.'-01';
        }
        $salaries= employeeSalary::where('month',$month)->get();
        $settings = setting::where('table_name', 'employee_salaries')->first();
        $settings->setting = json_decode(json_decode($settings->setting, true), true);


        $dataArray = [
            'settings' => $settings,
            'items' => $salaries,

        ];


        return view('employees.payments.salary', compact('dataArray'));
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
        
        employeeSalary::create($request->all());
        return redirect()->back()->withSuccess(['Successfully Created']);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\employeeSalary  $employeeSalary
     * @return \Illuminate\Http\Response
     */
    public function show(employeeSalary $employeeSalary)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\employeeSalary  $employeeSalary
     * @return \Illuminate\Http\Response
     */
    public function edit(employeeSalary $employeeSalary)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\employeeSalary  $employeeSalary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, employeeSalary $employeeSalary)
    {
        
        $employeeSalary->update($request->all());
        return redirect()->back()->withSuccess(['Successfully Updated']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\employeeSalary  $employeeSalary
     * @return \Illuminate\Http\Response
     */
    public function destroy(employeeSalary $employeeSalary)
    {
        $employeeSalary->delete();
        return Redirect::back()->withErrors(["Item Deleted" ]);


    }
}
