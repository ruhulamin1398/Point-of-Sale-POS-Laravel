<?php

namespace App\Http\Controllers;

use App\Models\dutyStatus;
use App\Models\setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use function Symfony\Component\String\b;

class DutyStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $settings = setting::where('table_name','duty_statuses')->first();
        $settings->setting= json_decode(  json_decode(  $settings->setting,true),true);
        
                
                $dataArray=[
                    'settings'=>$settings,
                    'items' => dutyStatus::all()
                    
                ];
              
        
                return view('employees.duty.dutyStatus', compact('dataArray'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         // this section is fixed
        return back();

        // dutyStatus::create($request->all());
        // return redirect()->back()->withSuccess(['Successfully Created']);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\dutyStatus  $dutyStatus
     * @return \Illuminate\Http\Response
     */
    public function show(dutyStatus $dutyStatus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\dutyStatus  $dutyStatus
     * @return \Illuminate\Http\Response
     */
    public function edit(dutyStatus $dutyStatus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\dutyStatus  $dutyStatus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, dutyStatus $dutyStatus)
    {
        // this section is fixed
        // return back();
        
        $dutyStatus->update($request->all());
        $this->onlineSync('dutyStatus','update',$dutyStatus->id);      
        return redirect()->back()->withSuccess(['Successfully Updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\dutyStatus  $dutyStatus
     * @return \Illuminate\Http\Response
     */
    public function destroy(dutyStatus $dutyStatus)
    {
       // this section is fixed
       // return back();


        // $dutyStatus->delete();
         return Redirect::back()->withErrors(["Can't Delete" ]);
    }
}
