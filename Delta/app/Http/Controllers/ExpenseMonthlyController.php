<?php

namespace App\Http\Controllers;

use App\Models\expenseMonthly;
use App\Models\setting;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ExpenseMonthlyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        if(! auth()->user()->hasPermissionTo('Expense Monthly Page')){
            return abort(401);
        }
        $month = Carbon::now()->format('Y-m-01');
        if(!is_null($request->month)){
            $month= $request->month.'-01';
        }
        $expenseMonthly= expenseMonthly::where('month',$month)->get();
        $settings = setting::where('table_name','expense_monthlies')->first();
        $settings->setting= json_decode(  json_decode(  $settings->setting,true),true);

        
        $dataArray=[
            'settings'=>$settings,
            'items' => $expenseMonthly,
            'page_name' => 'Expense Monthly',
        ];



        return view('expenses.expense-monthly',compact('dataArray'));
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
     * @param  \App\Models\expenseMonthly  $expenseMonthly
     * @return \Illuminate\Http\Response
     */
    public function show(expenseMonthly $expenseMonthly)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\expenseMonthly  $expenseMonthly
     * @return \Illuminate\Http\Response
     */
    public function edit(expenseMonthly $expenseMonthly)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\expenseMonthly  $expenseMonthly
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, expenseMonthly $expenseMonthly)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\expenseMonthly  $expenseMonthly
     * @return \Illuminate\Http\Response
     */
    public function destroy(expenseMonthly $expenseMonthly)
    {
        //
    }
}
