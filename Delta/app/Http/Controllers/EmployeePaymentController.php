<?php

namespace App\Http\Controllers;

use App\Models\employee;
use App\Models\employeePayment;
use App\Models\employeePaymentType;
use App\Models\salaryStatus;
use Illuminate\Http\Request;

class EmployeePaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 

        
        $componentDetails= [
            'title' => 'Employee Payments',
            'editTitle' =>'Edit Employee Payments',
        ];

        $routes = [
            'update' => [
                'name' => 'employee_payments.update',
                'link' => 'employee_payments',
            ],
            'delete' => [
                
                'name' => 'employee_payments.destroy',
                'link' => 'employee_payments',
            ]

        ];
     
        

        $fieldList=[
         
            'employee_id'=>[
                'create'=>true,
                'read'=>true,
                'update'=>true,
                'delete'=>true,


               'type'=>'normal',
               'name'=>'employee_id',
               'database_name'=>'employee_id',

               'title'=> "Employee ID",
            ],
            'employee_payment_type_id'=>[
                'create'=>true,
                'read'=>true,
                'update'=>true,
                'delete'=>true,


               'type'=>'normal',
               'name'=>'employee_payment_type_id',
               'database_name'=>'employee_payment_type_id',

               'title'=> "Payment type ID
               ",
            ],
            'amount'=>[
                'create'=>true,
                'read'=>true,
                'update'=>true,
                'delete'=>true,


               'type'=>'normal',
               'name'=>'amount',
               'database_name'=>'amount',

               'title'=> "Amount",
            ],

            'status'=>[
                'create'=>true,
                'read'=>true,
                'update'=>true,
                'delete'=>true,


               'type'=>'normal',
               'name'=>'salary_status_id',
               'database_name'=>'salary_status_id',

               'title'=> "status",
            ],


            
            'date'=>[
                'create'=>true,
                'read'=>true,
                'update'=>true,
                'delete'=>true,


               'type'=>'normal',
               'name'=>'date',
               'database_name'=>'date',

               'title'=> "Date",
            ],
            'Comment'=>[
                'create'=>true,
                'read'=>true,
                'update'=>true,
                'delete'=>true,


               'type'=>'normal',
               'name'=>'Comment',
               'database_name'=>'Comment',

               'title'=> "Comment",
            ],
          
          
          
          
        ];






        $items = employeePayment::all();
        $employees = employee::all();
        $payment_types = employeePaymentType::all();
        $salary_status = salaryStatus::all();

        return view('employees.payment', compact('items', 'fieldList', 'routes','componentDetails','employees','payment_types','salary_status'));
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

        date_default_timezone_set("Asia/Dhaka");
        $timezone =date("Y-m-d");

        $employeePayment = new employeePayment;
        $employeePayment->employee_id = $request->employee_id;
        $employeePayment->employee_payment_type_id = $request->employee_payment_type_id;
        $employeePayment->salary_status_id = $request->salary_status_id;
        $employeePayment->amount = $request->amount;
        $employeePayment->date =$timezone;
        $employeePayment->Comment = $request->Comment;

         $employeePayment->save();
         return back();

         //salary table calculation 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\employeePayment  $employeePayment
     * @return \Illuminate\Http\Response
     */
    public function show(employeePayment $employeePayment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\employeePayment  $employeePayment
     * @return \Illuminate\Http\Response
     */
    public function edit(employeePayment $employeePayment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\employeePayment  $employeePayment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, employeePayment $employeePayment)
    {

        return $request;
        // $employeePayment->employee_id = $request->employee_id;
        // $employeePayment->employee_payment_type_id = $request->employee_payment_type_id;
        // $employeePayment->amount = $request->amount;
        // $employeePayment->date =$timezone;
        // $employeePayment->Comment = $request->Comment;

        //  $employeePayment->save();
        //  return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\employeePayment  $employeePayment
     * @return \Illuminate\Http\Response
     */
    public function destroy(employeePayment $employeePayment)
    {
        //
    }
}
