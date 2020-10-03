<?php

namespace App\Http\Controllers;

use App\Models\employee;
use App\Models\designation;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    
        $componentDetails= [
            'title' => 'Employees List',
            'editTitle' =>'Edit Employees',
        ];

        $routes = [
            'update' => [
                'name' => 'employees.update',
                'link' => 'employees',
            ],
            'delete' => [
                
                'name' => 'employees.destroy',
                'link' => 'employees',
            ]

        ];
     
        

        $fieldList=[
         
            'name'=>[
                'create'=>true,
                'read'=>true,
                'update'=>true,
                'delete'=>true,


                'type'=>'normal',
                'name'=>'name',
                'database_name'=>'name',
                
                'title'=> "Name",
    
            ],
            'phone'=>[
                'create'=>true,
                'read'=>true,
                'update'=>true,
                'delete'=>true,


               'type'=>'normal',
               'name'=>'phone',
               'database_name'=>'phone',

               'title'=> "phone",
            ],

            'address'=>[
                'create'=>true,
                'read'=>true,
                'update'=>true,
                'delete'=>true,


               'type'=>'normal',
               'name'=>'address',
               'database_name'=>'address',

               'title'=> "address",
            ],
            'joining_date'=>
            [
                'create'=>true,
                'read'=>true,
                'update'=>true,
                'delete'=>true,


               'type'=>'normal',
               'name'=>'joining_date',
               'database_name'=>'joining_date',

               'title'=> "Joining",
            ],

            'reference'=>
            [
                'create'=>true,
                'read'=>true,
                'update'=>true,
                'delete'=>true,


               'type'=>'normal',
               'name'=>'joining_date',
               'database_name'=>'joining_date',

               'title'=> "Reference",
            ],

            'term_of_contract'=>
            [
                'create'=>true,
                'read'=>true,
                'update'=>true,
                'delete'=>true,


               'type'=>'normal',
               'name'=>'term_of_contract',
               'database_name'=>'term_of_contract',

               'title'=> "Contract",
            ],

            'salary'=>
            [
                'create'=>true,
                'read'=>true,
                'update'=>true,
                'delete'=>true,


               'type'=>'normal',
               'name'=>'salary',
               'database_name'=>'salary',

               'title'=> "Salary",
            ],
            'designation'=>
            [
                'create'=>true,
                'read'=>true,
                'update'=>true,
                'delete'=>true,


               'type'=>'normal',
               'name'=>'designation',
               'database_name'=>'designation',

               'title'=> "designation",
            ],
          
          
        ];


        $items = employee::all();
        $designation = designation::all();


        return view('employees.index', compact('items', 'fieldList', 'routes','componentDetails','designation'));

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
         
       $employee = new employee;
       $employee->name = $request->name;
       $employee->phone = $request->phone;
       $employee->address = $request->address;
       $employee->joining_date = $request->joining_date;
       $employee->reference = $request->reference;
       $employee->term_of_contract = $request->term_of_contract;
       $employee->salary = $request->salary;
       $employee->designation_id = $request->designation_id;
       $employee->save();
       return back();
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
    public function update(Request $request, employee $employee)
    {
        //
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
            return back();
    }
}
