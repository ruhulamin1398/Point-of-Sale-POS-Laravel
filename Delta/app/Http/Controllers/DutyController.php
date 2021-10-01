<?php

namespace App\Http\Controllers;

use App\Models\designation;
use Carbon\CarbonPeriod;
use App\Models\duty;
use App\Models\dutyStatus;
use App\Models\employee;
use App\Models\setting;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class DutyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->month) {
            $month = Carbon::createFromFormat('Y-m', $request->month);
        } else {
            $month = Carbon::now();
        }

        // return  $month ;


        if (!auth()->user()->hasPermissionTo('Employee Page')) {
            return abort(401);
        }

        $settings = setting::where('table_name', 'duties')->first();
        $settings->setting = json_decode(json_decode($settings->setting, true), true);

        // return $settings;

        $startDate = $month; //returns current day
        $from = $startDate->firstOfMonth()->format('Y-m-d');;
        $to = $startDate->lastOfMonth()->format('Y-m-d');;
        $period = CarbonPeriod::create($from, '1 day', $to);

        $exist = duty::where('day', $to)->first();

        if (is_null($exist)) {

            foreach ($period as $dt) {
                duty::create([
                    'day' => $dt->format("Y-m-d"),
                ]);
            }
        }

        $duties =  duty::whereBetween('day', [$from, $to])->get();

        /// today 

        $today = duty::where('day', Carbon::now()->format("Y-m-d"))->first();

        if (is_null($today)) {

            $from = Carbon::now()->firstOfMonth()->format('Y-m-d');;
            $to = Carbon::now()->lastOfMonth()->format('Y-m-d');;
            $period = CarbonPeriod::create($from, '1 day', $to);

            foreach ($period as $dt) {
                duty::create([
                    'day' => $dt->format("Y-m-d"),
                ]);

                $this->updateEmployeesAttendens($dt,3);
            }

            $today = duty::where('day', Carbon::now()->format("Y-m-d"))->first();
        }





        $roles = Role::all();
        $designations   = designation::all();
        $users   = User::all();
        $employees =  employee::where('id', '!=', 1)->get();
        $dataArray = [
            'settings' => $settings,
            'items' => $duties,
            'users' => $users,
            'designations' => $designations,
            'page_name' => 'Employee',
        ];
        // return $dataArray['items'];
        $statues = dutyStatus::all();


        return view('shop.duty', compact('dataArray', 'designations', 'users', 'employees', 'roles', 'statues', 'today', 'month'));



        // foreach ($period as $dt) {

        //     echo $dt->format("Y-m-d") . "<br>\n";
        // }
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
     * @param  \App\Models\duty  $duty
     * @return \Illuminate\Http\Response
     */
    public function show(duty $duty)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\duty  $duty
     * @return \Illuminate\Http\Response
     */
    public function edit(duty $duty)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\duty  $duty
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, duty $duty)
    {

        // return $request;
        $duty->status_id = $request->status_id;
        $duty->save();


        $date = Carbon::createFromFormat('Y-m-d', $duty->day);
        $this->updateEmployeesAttendens($date,$request->status_id);


        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\duty  $duty
     * @return \Illuminate\Http\Response
     */
    public function destroy(duty $duty)
    {
        //
    }
}
