<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeePaymentRequest;
use App\Models\calculationAnalysisDaily;
use App\Models\calculationAnalysisMonthly;
use App\Models\calculationAnalysisYearly;
use App\Models\designation;
use App\Models\employee;
use App\Models\employeePayment;
use App\Models\employeePaymentType;
use App\Models\employeeSalary;
use App\Models\salaryStatus;
use App\Models\setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use PhpParser\Node\Stmt\Return_;

class EmployeePaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    { 
        $month = Carbon::now()->format('Y-m-01');
        if(!is_null( $request->month)){
            $month= Carbon:: parse($request->month)->format('Y-m-01');
        }
        $employeePayment= employeePayment:: where('month',$month)->get();
        $employees = employee::all();
        $payment_types = employeePaymentType :: all();
        $salary_status = salaryStatus::all();


        $settings = setting::where('table_name','employee_payments')->first();
        $settings->setting= json_decode(  json_decode(  $settings->setting,true),true);

        
        $dataArray=[
            'settings'=>$settings,
            'items' => $employeePayment,
            'employees'=> $employees,
            'payment_types'=> $payment_types,
            'salary_statuses'=> $salary_status,
            'page_name' => 'Employee Payments',
        ];


        $month= Carbon::parse($month)->format("F, Y");

        return view('employees.payments.index',compact('employees','payment_types','salary_status','dataArray','month'));
        
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
        if($request->amount<0){
            return Redirect::back()->withErrors(["Amount must be greater than 0"]);
        }
       // return $request;
        //payment Table 
        $employeePayment = new employeePayment;
        $employeePayment->employee_id = $request->employee_id;
        $employeePayment->employee_payment_type_id = $request->employee_payment_type_id;
        if(!is_null($request->salary_status_id)){
            $employeePayment->salary_status_id = $request->salary_status_id;
        }
        else{
            $employeePayment->salary_status_id =2;
        }
        $employeePayment->amount = $request->amount;
        $employeePayment->month =$request->month.'-01';
        $employeePayment->Comment = $request->Comment;

       
         // Salary Table

         $salaries = employeeSalary::where('employee_id',$employeePayment->employee_id)->where('month',$employeePayment->month)->first();
         $employee = employee::find($employeePayment->employee_id);
         $employee_salary_method = 'update';
         if(is_null($salaries)){
             $salaries= new employeeSalary;
             $salaries->fixed_salary = $employee->salary;
             $employee_salary_method = 'create';
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

         $this->onlineSync('employeeSalary',$employee_salary_method,$salaries->id);
         $this->onlineSync('employeePayment','create',$employeePayment->id);


        // calculation Analysis start
        $this->calculationAnalysis($request->amount);
        // calculation Analysis end

         return redirect()->back()->withSuccess(['Successfully Created']);

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
        
        if($request->amount<0){
            return Redirect::back()->withErrors(["Amount must be greater than 0"]);
        }
        //return $request;
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

        $this->onlineSync('employeeSalary','update',$salaries->id);
        $this->onlineSync('employeePayment','update',$employeePayment->id);



        // calculation Analysis start
        $this->calculationAnalysis($different);
        // calculation Analysis end
        
        return redirect()->back()->withSuccess(['Successfully Updated']);
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
        
        // calculation Analysis start
        $this->calculationAnalysis(0- $employeePayment->amount);
        // calculation Analysis end          
        
        $salaries->save();
        $employeePayment->delete();

        $this->onlineSync('employeeSalary','update',$salaries->id);
        $this->onlineSync('employeePayment','delete',$employeePayment->id);

        return redirect()->back()->withErrors(['Payment Deleted']);
    }


    public function calculationAnalysis($amount){

        $daily_method_type = $monthly_method_type = $yearly_method_type = 'update';
        // calculation Analysis start
        $month = Carbon::now()->format('Y-m-01') ;
        $date = Carbon::now()->format('Y-m-d');
        $year = Carbon::now()->format('Y');
        $analysysDate= calculationAnalysisDaily::where('date',$date)->first();
        $analysysMonth= calculationAnalysisMonthly::where('month',$month)->first();
        $analysysYear= calculationAnalysisYearly::where('year',$year)->first();
        if(is_null($analysysDate)){
            $analysysDate= new calculationAnalysisDaily;
            $analysysDate->date=$date;
            $daily_method_type = 'create';
        }
        if(is_null($analysysMonth)){
            $analysysMonth= new calculationAnalysisMonthly;
            $analysysMonth->month=$month;
            $monthly_method_type = 'create';
        }
        if(is_null($analysysYear)){
            $analysysYear= new calculationAnalysisYearly;
            $analysysYear->year=$year;
            $yearly_method_type = 'create';
        }
        $analysysDate->payment += $amount;
        $analysysMonth->payment += $amount;
        $analysysYear->payment += $amount;
        $analysysDate->save();
        $analysysMonth->save();
        $analysysYear->save();
        // calculation Analysis end


        
        $this->onlineSync('calculationAnalysisDaily',$daily_method_type,$analysysDate->id);

        $this->onlineSync('calculationAnalysisMonthly',$monthly_method_type,$analysysMonth->id);

        $this->onlineSync('calculationAnalysisYearly',$yearly_method_type,$analysysYear->id);


    }
}
