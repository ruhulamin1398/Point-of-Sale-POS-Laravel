<?php

namespace App\Http\Controllers;

use App\Models\employee;
use App\Models\employeeSalary;
use App\Models\salaryStatus;
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
        
        $componentDetails= [
            'title' => 'Employee Salary',
            'editTitle' =>'Edit Employee Salary',
        ];

        $routes = [
            'update' => [
                'name' => 'employee_salaries.update',
                'link' => 'employee_salaries',
            ],
            'delete' => [
                
                'name' => 'employee_salaries.destroy',
                'link' => 'employee_salaries',
            ]

        ];
     
        

        $fieldList=[
         
            'employee_id'=>[
                'create'=>true,
                'read'=>true,
                'update'=>true,
                'delete'=>false,


               'type'=>'normal',
               'name'=>'employee_id',
               'database_name'=>'employee_id',

               'title'=> "Employee ID",
            ],
            'salary_status_id'=>[
                'create'=>true,
                'read'=>true,
                'update'=>true,
                'delete'=>true,


               'type'=>'normal',
               'name'=>'salary_status_id',
               'database_name'=>'salary_status_id',

               'title'=> "Salary Status ID",
            ],
            'fixed_salary'=>[
                'create'=>true,
                'read'=>true,
                'update'=>true,
                'delete'=>true,


               'type'=>'normal',
               'name'=>'fixed_salary',
               'database_name'=>'fixed_salary',

               'title'=> "Fixed Salary",
            ],

            'amount_salary'=>[
                'create'=>true,
                'read'=>true,
                'update'=>true,
                'delete'=>true,


               'type'=>'normal',
               'name'=>'amount_salary',
               'database_name'=>'amount_salary',

               'title'=> "Amount (salary)",
            ],


            
            'amount_other'=>[
                'create'=>true,
                'read'=>true,
                'update'=>true,
                'delete'=>true,


               'type'=>'normal',
               'name'=>'amount_other',
               'database_name'=>'amount_other',

               'title'=> "Amount (Other)",
            ],
            'month'=>[
                'create'=>true,
                'read'=>true,
                'update'=>true,
                'delete'=>true,


               'type'=>'normal',
               'name'=>'month',
               'database_name'=>'month',

               'title'=> "Month",
            ],
          
          
          
          
        ];






        $items = employeeSalary::all();

         // view system must be changed
        return view('employees.salary', compact('items', 'fieldList', 'routes','componentDetails'));
    
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
