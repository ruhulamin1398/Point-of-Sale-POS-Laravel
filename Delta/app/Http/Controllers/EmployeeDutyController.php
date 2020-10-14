<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeDutyRequest;
use App\Models\dutyStatus;
use App\Models\employee;
use App\Models\employeeDuty;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class EmployeeDutyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $currentWeekFirstDay= "";
        if(!is_null($request->week)){
            $currentWeekFirstDay=carbon::parse($request->week)->startOfWeek()->format('Y-m-d');
        }
        else{ 
        $currentWeekFirstDay= now()->startOfWeek()->format('Y-m-d H:i');
        }
        // return $currentWeekFirstDay;
        // $currentWeekFirstDay = '2020-10-12';
        // $currentWeekFirstDay= now()->startOfWeek()->format('Y-m-d H:i');
        $weekDaysArray = [];
        $weeklyEmployeesDutyData = [];
        $employees = employee::all();
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
                if ( ! isset($weeklyEmployeesDutyData[$employee->id][$day])){
                    $weeklyEmployeesDutyData[$employee->id][$day]= Collection::make([[
                        'duty_status_id'=>"0",
                    ],]);
                    
                }
                else{
                    $weeklyEmployeesDutyData[$employee->id][$day]->first()->abasas();
                }
            }
            $weeklyEmployeesDutyData[$employee->id] =  $weeklyEmployeesDutyData[$employee->id]->sortKeys() ;
            // $weeklyEmployeesDutyData[$employee->id] = $weeklyEmployeesDutyData[$employee->id]->toArray();
            // ksort($weeklyEmployeesDutyData[$employee->id]);
        }

     
        // return $collection;
        // return $weeklyEmployeesDutyData;
          return view('employees.duty.index', compact('employees', 'weeklyEmployeesDutyData', 'weekDaysArray'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $todayEmployeeDuties = employeeDuty::whereDate('date', Carbon::today())->get();
        foreach($todayEmployeeDuties as $duty){
            if(!is_null($duty->enter_time))
            {
                $duty->enter_time=  Carbon::parse( $duty->exit_time)->format('h : i A');
            }
            if(!is_null($duty->exit_time))
            {
                $duty->exit_time=  Carbon::parse( $duty->exit_time)->format('h : i A');
            }
        }
// return $todayEmployeeDuties;
        $employees = employee::all();
        $dutyStatuses = dutyStatus::all();

        return view('employees.duty.create', compact('employees', 'dutyStatuses','todayEmployeeDuties'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeDutyRequest $request)
    {



        $employee = employee::find($request->employee_id);
        $employeeDuty = employeeDuty::where('employee_id', $request->employee_id)->where('date', $request->date)->first();
        if (is_null($employeeDuty)) {
            $employeeDuty = new employeeDuty;
            $employeeDuty->employee_id = $request->employee_id;
            $employeeDuty->date = $request->date;
        }
        $employeeDuty->duty_status_id = $request->duty_status_id;
        $employeeDuty->fixed_duty_hour = $employee->fixed_duty_hour;
        $employeeDuty->comment = $request->comment;
        if ($employeeDuty->duty_status_id == 1) {
            if (!is_null($request->enter_time)) {
                $employeeDuty->enter_time = $request->enter_time;
            }
            if (!is_null($request->exit_time)) {
                $employeeDuty->exit_time = $request->exit_time;
            }
            if (!is_null($employeeDuty->enter_time) && !is_null($employeeDuty->exit_time)) {
                $difference = Carbon::parse($employeeDuty->enter_time)->diff(Carbon::parse($employeeDuty->exit_time))->format('%H:%I:%S');
                $employeeDuty->worked_hour = $difference;
            }
        }
        $employeeDuty->save();
        return back();
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
