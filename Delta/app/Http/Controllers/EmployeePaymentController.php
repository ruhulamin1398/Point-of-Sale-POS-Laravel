<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeePaymentRequest;
use App\Models\designation;
use App\Models\employee;
use App\Models\employeePayment;
use App\Models\employeePaymentType;
use App\Models\employeeSalary;
use App\Models\salaryStatus;
use App\Models\setting;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;

class EmployeePaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        $employees = employee::all();
        $payment_types = employeePaymentType :: all();
        $salary_status = salaryStatus::all();


        $settings = setting::where('table_name','employee_payments')->first();
$settings->setting= json_decode(  json_decode(  $settings->setting,true),true);

        
        $dataArray=[
            'settings'=>$settings,
            'items' => employeePayment::all(),
            'employees'=> $employees,
            'payment_types'=> $payment_types,
            'salary_statuses'=> $salary_status,
        ];




        return view('employees.payments.index',compact('employees','payment_types','salary_status','dataArray'));
        
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
    public function store(EmployeePaymentRequest $request)
    {
       // return $request;
        //payment Table 
        $employeePayment = new employeePayment;
        $employeePayment->employee_id = $request->employee_id;
        $employeePayment->employee_payment_type_id = $request->employee_payment_type_id;
        $employeePayment->salary_status_id = $request->salary_status_id;
        $employeePayment->amount = $request->amount;
        $employeePayment->month =$request->month.'-01';
        $employeePayment->Comment = $request->Comment;

       
         // Salary Table

         $salaries = employeeSalary::where('employee_id',$employeePayment->employee_id)->where('month',$employeePayment->month)->first();
         $employee = employee::find($employeePayment->employee_id);

         if(is_null($salaries)){
             $salaries= new employeeSalary;
             $salaries->fixed_salary = $employee->salary;
         }
        $salaries->salary_status_id= $employeePayment->salary_status_id;
         if(  $employeePayment->employee_payment_type_id == 1)
         {
             $salaries->amount_salary += $employeePayment->amount;
         }
         else
         {
            $salaries->amount_other += $employeePayment->amount;
         }

         $salaries->employee_id= $employeePayment->employee_id;
         $salaries->month= $employeePayment->month;



         $salaries->save();
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
        
         // only amount and comment editable
        $salaries = employeeSalary::where('employee_id',$employeePayment->employee_id)->where('month',$employeePayment->month)->first();
        $different =$request->amount-$employeePayment->amount;
        if(  $employeePayment->employee_payment_type_id == 1)
        {
            $salaries->amount_salary += $different;
        }
        else
        {
           $salaries->amount_other += $different;
        }

        $employeePayment->amount = $request->amount;
        $employeePayment->Comment = $request->Comment;
        $employeePayment->changed_amount +=$different;
        // cahnged data json work needed

        $salaries->save();
        $employeePayment->save();
         return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\employeePayment  $employeePayment
     * @return \Illuminate\Http\Response
     */
    public function destroy(employeePayment $employeePayment)
    {
        
         $salaries = employeeSalary::where('employee_id',$employeePayment->employee_id)->where('month',$employeePayment->month)->first();
        if($employeePayment->employee_payment_type_id==1)
        {
            $salaries->amount_salary -= $employeePayment->amount;
            $salaries->salary_status_id=2;
        }
        else
        {
            $salaries->amount_other -= $employeePayment->amount;
        }
                    
        
        $salaries->save();
        $employeePayment->delete();
        return back();
    }
}
