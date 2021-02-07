<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Models\employee;
use App\Models\User;
use App\Models\designation;
use App\Models\employeeAnalysisYearly;
use App\Models\employeeDutyMonthly;
use App\Models\employeeSalary;
use App\Models\order;
use App\Models\setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Spatie\Permission\Models\Role;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(! auth()->user()->hasPermissionTo('Employee Page')){
            return abort(401);
        }
    
        $settings = setting::where('table_name','employees')->first();
        $settings->setting= json_decode(  json_decode(  $settings->setting,true),true);
        
        $roles = Role::all();
        $designations   =designation::all();     
        $users   = User::all();     
        $employees =  employee::all();
                $dataArray=[
                    'settings'=>$settings,
                    'items' =>$employees,
                    'users'=> $users,
                    'designations'=> $designations,
                    'page_name' => 'Employee',
                ];
        
        
                return view('employees.index', compact('dataArray','designations','users','employees','roles'));
        

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
        $employee= new employee;
        $employee->designation_id= $request->designation_id; 
        $employee->name= $request->name; 
        $employee->phone= $request->phone; 
        $employee->address= $request->address; 
        $employee->joining_date= $request->joining_date; 
        $employee->reference= $request->reference; 
        $employee->term_of_contract= $request->term_of_contract; 
        $employee->fixed_duty_hour= $request->fixed_duty_hour; 
        $employee->salary= $request->salary; 
        if(!is_null($request->userName)){  
            $user= new User;
            $user->name= $request->userName;
            $user->email = $request->email;
            $user->password= Hash::make($request->password);
            $user->save();
            $role = Role::find($request->role_id);
            $user->assignRole($role);
            $employee->user_id=$user->id;
         $this->onlineSync('userTable','create',$user->id);
        $this->onlinePermissionSync('UserRole','assign',$user->id,$role->id);

        }
       
        $employee->save();
        $this->onlineSync('employee','create',$employee->id);


        return redirect::back()->withSuccess(['Successfully Created']);



 

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(employee $employee , Request $request)
    {
        
        if(! auth()->user()->hasPermissionTo('Employee View')){
            return abort(401);
        }
        $monthStart= Carbon::now()->format('Y-m-01 00:00:00');
        $monthEnd= Carbon:: now()->format('Y-m-31 23:59:59');
        if(!is_null($request->month)){
            $monthStart= Carbon:: parse($request->month)->format('Y-m-01 00:00:00');
            $monthEnd= Carbon:: parse($request->month)->format('Y-m-31 23:59:59');
        }
       $month = Carbon:: parse($monthStart)->format('F');
        $orders= order::where('user_id', $employee->user_id )->where('created_at','<=',$monthEnd)->where('created_at','>=',$monthStart)->get(); 
        $employeeGraph = $this->employeeAnalysisYearly($employee);
        return view('employees.show',compact('employee','orders','month','employeeGraph'));
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
        $number=$request->phone;
        $id =$employee->id;
        if(!is_null($number)){
            $length=strlen($number);
            if($length!=11){
                return Redirect::back()->withErrors(["Enter a Valid Phone"]);
            }
            else{
                $employees= employee::where('phone',$number)->first();
                if(!is_null( $employees)){
                    if($id != $employees->id){
                        return Redirect::back()->withErrors(["This Phone is Already taken"]);
                    }
                }
            }
        }    
        
        $employee->update($request->all());
        return Redirect::back()->withSuccess(['Successfully Updated']);

 
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
        
        $dusties = employeeDutyMonthly::where('employee_id',$employee->id)->get();
        $salaries = employeeSalary::where('employee_id',$employee->id)->get()->groupBy('month');
        $month= 0;
        foreach($dusties as $duty){
            $month = $duty->month;
            if(isset($salaries[$month])){
                if($salaries[$month][0]->salary_status_id == 2)
                return Redirect::back()->withErrors(["Can't Delete.","Employee has unpaid Sallary"]);
            }
            else{
                return Redirect::back()->withErrors(["Can't Delete.","Employee has unpaid Sallary"]);
            }
        }
        $employee->delete();
        $employee->user->delete();
        
        $this->onlineSync('employee','delete',$employee->id);
        $this->onlineSync('userTable','delete',$employee->user->id);

        return Redirect::back()->withErrors(["Employee Deleted"]);
    }




    
    // ***************** employeeAnalysisYearly ******************

    public function employeeAnalysisYearly($employee){
    
        $lebels = array('Sell','Profit');
        $Sell = 0;
        $Profit = 0;
    
        $employeeYearlies = employeeAnalysisYearly::where('employee_id',$employee->id)->get();

        foreach ($employeeYearlies as $yearly) {
            $Sell += $yearly->sell;
            $Profit += $yearly->profit;
        }
        $data = array($Sell,$Profit);
        $color = array('#FFFF00','#0000FF');
        $employeeAnalysis = [
            "lebels" => $lebels,
            "datasets" => [
                [
                    "label" => "Employee Analysis",
                    "data" => $data,
                    "backgroundColor" => $color,
                    "fill" => false
                ],
            ]
        ];
        return json_decode(json_encode($employeeAnalysis), true);
    
    }
    
}
