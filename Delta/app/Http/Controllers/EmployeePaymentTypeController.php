<?php

namespace App\Http\Controllers;

use App\Models\employeePaymentType;
use App\Models\setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class EmployeePaymentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        

        $settings = setting::where('table_name','employee_payment_types')->first();
        $settings->setting= json_decode(  json_decode(  $settings->setting,true),true);
        
                
                $dataArray=[
                    'settings'=>$settings,
                    'items' => employeePaymentType::all(),
                
                ];

                // return $dataArray;
        
        
                return view('employees.payments.payment-type', compact('dataArray'));
        
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

        // employeePaymentType::create($request->all());
        // return redirect()->back()->withSuccess(['Successfully Created']);


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

        
        // $employeePaymentType->update($request->all());
        // return redirect()->back()->withSuccess(['Successfully Updated']);

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


        // $employeePaymentType->delete();
        // return Redirect::back()->withSuccess(["Item Deleted" ]);
    }
}
