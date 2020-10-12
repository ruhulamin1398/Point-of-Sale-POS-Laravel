<?php

namespace App\Http\Controllers;

use App\Models\employee;
use App\Models\employeeSalary;
use App\Models\salaryStatus;
use App\Models\setting;
use Illuminate\Http\Request;

class EmployeeSalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    
$settings = setting::where('table_name','employee_salaries')->first();
$settings->setting= json_decode(  json_decode(  $settings->setting,true),true);

        
        $dataArray=[
            'settings'=>$settings,
            'items' => employeeSalary::all(),
            
        ];


        return view('product.category.index', compact('dataArray'));

    
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\employeeSalary  $employeeSalary
     * @return \Illuminate\Http\Response
     */
    public function destroy(employeeSalary $employeeSalary)
    {
        //
    }
}
