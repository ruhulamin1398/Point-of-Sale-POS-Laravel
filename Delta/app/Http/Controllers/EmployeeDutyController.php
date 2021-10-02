<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeDutyRequest;
use App\Models\dutyStatus;
use App\Models\employee;
use App\Models\employeeDuty;
use App\Models\employeeDutyMonthly;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Spatie\Permission\Models\Role;

class EmployeeDutyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(! auth()->user()->hasPermissionTo('Duty Weekly Page')){
            return abort(401);
        }
        $roles = Role::all();

        $currentWeekFirstDay = "";
        if (!is_null($request->week)) {
            $currentWeekFirstDay = carbon::parse($request->week)->startOfWeek()->format('Y-m-d');
        } else {
            $currentWeekFirstDay = now()->startOfWeek()->format('Y-m-d H:i');
        }
        // return $currentWeekFirstDay;
        // $currentWeekFirstDay = '2020-10-12';
        // $currentWeekFirstDay= now()->startOfWeek()->format('Y-m-d H:i');
        $weekDaysArray = [];
        $weeklyEmployeesDutyData = [];
        $employees = employee::where('id','!=',1)->get();
        $length = count($employees);
        $firstDay = new Carbon(carbon::parse($currentWeekFirstDay)->format('Y-m-d'));

        $weekDaysArray[0] = carbon::parse($firstDay)->format('Y-m-d');
        for ($i = 1; $i < 7; $i++) {
            $weekDaysArray[$i] =  Carbon::createFromFormat('Y-m-d', $weekDaysArray[0])->addDays($i)->format('Y-m-d');
        }

        foreach ($employees as $employee) {
            $weeklyEmployeesDutyData[$employee->id] = employeeDuty::where('employee_id', $employee->id)
                ->where('date', '<=', $weekDaysArray[6])
                ->where('date', '>=', $weekDaysArray[0])
                ->orderBy('date')
                ->get()
                ->groupBy('date');


            foreach ($weekDaysArray  as $day) {
                if (!isset($weeklyEmployeesDutyData[$employee->id][$day])) {
                    $weeklyEmployeesDutyData[$employee->id][$day] = Collection::make([[
                        'duty_status_id' => "0",
                    ],]);
                } else {
                    $weeklyEmployeesDutyData[$employee->id][$day]->first()->abasas();
                }
            }
            $weeklyEmployeesDutyData[$employee->id] =  $weeklyEmployeesDutyData[$employee->id]->sortKeys();
            // $weeklyEmployeesDutyData[$employee->id] = $weeklyEmployeesDutyData[$employee->id]->toArray();
            // ksort($weeklyEmployeesDutyData[$employee->id]);
        }


        // return $collection;
        // return $weeklyEmployeesDutyData;
        return view('employees.duty.index', compact('employees', 'weeklyEmployeesDutyData', 'weekDaysArray','roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        if(! $request->date){
            $date= now();
        }
        else{

            $date=  Carbon::createFromDate($request->date);
        }
        
        if(! auth()->user()->hasPermissionTo('Duty Create Page')){
            return abort(401);
        }

        $todayEmployeeDuties = employeeDuty::whereDate('date', $date)->get();
        foreach ($todayEmployeeDuties as $duty) {
            if (!is_null($duty->enter_time)) {
                $duty->enter_time =  Carbon::parse($duty->enter_time)->format('h : i A');
            }
            if (!is_null($duty->exit_time)) {
                $duty->exit_time =  Carbon::parse($duty->exit_time)->format('h : i A');
            }
        }
        $roles = Role::all();
        // return $todayEmployeeDuties;
        $employees = employee::where('id','!=',1)->get();
        $dutyStatuses = dutyStatus::all();

        return view('employees.duty.create', compact('employees', 'dutyStatuses', 'todayEmployeeDuties','roles','date'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeDutyRequest $request)
    {
        //monthly duty section start
         $month = Carbon:: parse($request->date)->format('Y-m').'-01' ;
         $employeeId= $request->employee_id;
         $dutyMonthly = employeeDutyMonthly:: where('employee_id',$employeeId)->where('month',$month)->first();
         $duty_monthly_method = 'update';
        if(is_null($dutyMonthly)){
            $dutyMonthly=new employeeDutyMonthly;
            $dutyMonthly->employee_id = $employeeId;
            $dutyMonthly->month = $month;
            $duty_monthly_method = 'create';

        }
        //monthly duty section end


        //employee duty start
        $employee = employee::find($request->employee_id);
        $employeeDuty = employeeDuty::where('employee_id', $request->employee_id)->where('date', $request->date)->first();
        $duty_method = 'update';
        if (is_null($employeeDuty)) {
            $employeeDuty = new employeeDuty;
            $employeeDuty->employee_id = $request->employee_id;
            $employeeDuty->date = $request->date;
            $duty_method = 'create';
        }
        //employee duty end
        
        // monthly duty start
        if($employeeDuty->duty_status_id==1){
            $dutyMonthly->present -=1;
        }
        elseif($employeeDuty->duty_status_id==2){
            $dutyMonthly->absent -=1;

        }
        // monthly duty end

        //employee duty start
        $employeeDuty->duty_status_id = $request->duty_status_id;
        $employeeDuty->fixed_duty_hour = $employee->fixed_duty_hour;
        $employeeDuty->comment = $request->comment;
        if ($employeeDuty->duty_status_id == 1) {
            if (!is_null($request->enter_time)) {
                $employeeDuty->enter_time = $request->enter_time;
            }
            if (!is_null($request->exit_time)) {
                $employeeDuty->exit_time =$request->exit_time;
            }

            $enter=  $employeeDuty->enter_time;
            $exit=  $employeeDuty->exit_time;


            if (!is_null($enter) && !is_null($exit)) {
                $difference = Carbon::parse($enter)->diff(Carbon::parse($exit))->format('%H:%I:%S');
                $employeeDuty->worked_hour = $difference;
            }
        }
         //employee duty end


        // monthly duty start
        if($employeeDuty->duty_status_id==1){
            $dutyMonthly->present +=1;
        }
        elseif($employeeDuty->duty_status_id==2){
            $dutyMonthly->absent +=1;

        }
        // monthly duty end



        $dutyMonthly->save();
        $employeeDuty->save();

 
        $this->onlineSync('employeeDutyMonthly',$duty_monthly_method,$dutyMonthly->id);
        $this->onlineSync('employeeDuty',$duty_method,$employeeDuty->id);

        return Redirect::back()->withSuccess(['Successfully Created']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\employeeDuty  $employeeDuty
     * @return \Illuminate\Http\Response
     */
    public function show(employeeDuty $employeeDuty)
    {
        return $employeeDuty;
        //{employee_duty}  
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\employeeDuty  $employeeDuty
     * @return \Illuminate\Http\Response
     */
    public function edit(employeeDuty $employeeDuty)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\employeeDuty  $employeeDuty
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeeDutyRequest $request, employeeDuty $employeeDuty)
    {
        $employeeDuty->daily_salary_extra = $request->daily_salary_extra;
        
        if($request->duty_status_id !=1 and $request->duty_status_id !=  $employeeDuty->duty_status_id  ){
            $employeeDuty->daily_salary_extra = ($employeeDuty->daily_salary*-1);
        }
        $employeeDuty->duty_status_id = $request->duty_status_id;
        
        $employeeDuty->save();

        return $employeeDuty;
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\employeeDuty  $employeeDuty
     * @return \Illuminate\Http\Response
     */
    public function destroy(employeeDuty $employeeDuty)
    {
        //
    }



    public function dutyMonthly(Request $request)
    {
        
        if(! auth()->user()->hasPermissionTo('Duty Monthly Page')){
            return abort(401);
        }
        $roles = Role::all();
        $month = $request->month;
        if (is_null($request->month)) {
            $month = Carbon::now()->format('Y-m');
        }
        $month = $month . '-01';
         
        $monthlyDuties = employeeDutyMonthly::where('month', $month)->get();

        foreach($monthlyDuties as $duty){
            $duty->month = Carbon:: parse($duty->month)->format('F, Y');
        }

        return view('employees.duty.duty-monthly',compact('monthlyDuties','roles'));


    }


    public function get_weekly_Data()
    {
        // $currentWeekFirstDay= now()->startOfWeek()->format('Y-m-d H:i');
        // return $currentWeekFirstDay;
        $currentWeekFirstDay = '2020-10-13';
        $weekDaysArray = [];
        $weeklyEmployeesDutyData = [];
        $employees = employee::all();
        $length = count($employees);
        $weekDaysArray[0] = carbon::parse($currentWeekFirstDay)->format('Y-m-d');
        for ($i = 1; $i < 7; $i++) {
            $weekDaysArray[$i] =  Carbon::createFromFormat('Y-m-d', $weekDaysArray[0])->addDays($i)->format('Y-m-d');
        }
        for ($i = 0; $i < $length; $i++) {
            $weeklyEmployeesDutyData[$i] = employeeDuty::where('employee_id', $employees[$i]->id)
                ->where('date', '<=', $weekDaysArray[6])
                ->where('date', '>=', $weekDaysArray[0])
                ->orderBy('date')
                ->get();
        }

        return $weeklyEmployeesDutyData[0];
    }
}
