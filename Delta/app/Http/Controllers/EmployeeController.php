<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Models\employee;
use App\Models\User;
use App\Models\designation;
use App\Models\order;
use App\Models\setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
        
        $designations   =designation::all();     
        $users   = User::all();     
        $employees =  employee::all();
                $dataArray=[
                    'settings'=>$settings,
                    'items' =>$employees,
                    'users'=> $users,
                    'designations'=> $designations,
                ];
        
        
                return view('employees.index', compact('dataArray','designations','users','employees'));
        

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
            $employee->user_id=$user->id;
      $this->onlineSync('userTable','create',$user->id);

        }
       
        $employee->save();
        $this->onlineSync('employee','create',$employee->id);


        return redirect()->back()->withSuccess(['Successfully Created']);



 

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(employee $employee , Request $request)
    {
        $monthStart= Carbon::now()->format('Y-m-01 00:00:00');
        $monthEnd= Carbon:: now()->format('Y-m-31 23:59:59');
        if(!is_null($request->month)){
            $monthStart= Carbon:: parse($request->month)->format('Y-m-01 00:00:00');
            $monthEnd= Carbon:: parse($request->month)->format('Y-m-31 23:59:59');
        }
       $month = Carbon:: parse($monthStart)->format('F');
        $orders= order::where('user_id', $employee->user_id )->where('created_at','<=',$monthEnd)->where('created_at','>=',$monthStart)->get(); 
        return view('employees.show',compact('employee','orders','month'));
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
        // need deep thinking 
        //$employee->delete();
        return Redirect::back()->withErrors(["Can't Delete" ]);
    }
}
