<?php

namespace App\Http\Controllers;

use App\Models\employeePaymentType;
use Illuminate\Http\Request;

class EmployeePaymentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $componentDetails= [
            'title' => 'Employee Payment Types',
            'editTitle' =>'Edit Employee Payment Types',
        ];

        $routes = [
            'update' => [
                'name' => 'employee_payment_types.update',
                'link' => 'employee_payment_types',
            ],
            'delete' => [
                
                'name' => 'employee_payment_types.destroy',
                'link' => 'employee_payment_types',
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
            'description'=>[
                'create'=>true,
                'read'=>true,
                'update'=>true,
                'delete'=>true,


               'type'=>'normal',
               'name'=>'description',
               'database_name'=>'description',

               'title'=> "Description",
            ],

        
          
        ];


        $items = employeePaymentType::all();
        
  


        return view('employees.payment-type', compact('items', 'fieldList', 'routes','componentDetails',));
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
          
        // this database is fiexed
        return back();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\employeePaymentType  $employeePaymentType
     * @return \Illuminate\Http\Response
     */
    public function show(employeePaymentType $employeePaymentType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\employeePaymentType  $employeePaymentType
     * @return \Illuminate\Http\Response
     */
    public function edit(employeePaymentType $employeePaymentType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\employeePaymentType  $employeePaymentType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, employeePaymentType $employeePaymentType)
    {
 // this database is fiexed
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\employeePaymentType  $employeePaymentType
     * @return \Illuminate\Http\Response
     */
    public function destroy(employeePaymentType $employeePaymentType)
    {
         // this database is fiexed
        return back();
    }
}
