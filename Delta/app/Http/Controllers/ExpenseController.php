<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExpenseRequest;
use App\Models\employee;
use App\Models\expense;
use App\Models\expenseType;
use App\Models\setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use function GuzzleHttp\json_decode;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // return $request;
        

        $settings = setting::where('table_name', 'expenses')->first();
        $settings->setting = json_decode(json_decode($settings->setting, true), true);

        $month= Carbon::now()->format('Y-m');
        if(!is_null($request->month)){
            $month=$request->month;
        }
        $dataArray = [
            'settings' => $settings,
            'items' => expense::where('created_at','>=',$month.'-01 00:00:00')->where('created_at','<=',$month.'-31 23:59:59')->get(),
            'employees' => employee::all(),
            'expense_types' => expenseType::all(),
        ];
        $month= Carbon::parse($month)->format('F, Y');
        return view('expenses.index', compact('dataArray','month'));
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
    public function store(ExpenseRequest $request)
    {
        expense::create($request->all());
        return redirect()->back()->withSuccess(['Successfully Created']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function show(expense $expense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function edit(expense $expense)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function update(ExpenseRequest $request, expense $expense)
    {
        $expense->update($request->all());
        return redirect()->back()->withSuccess(['Successfully Updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function destroy(expense $expense)
    {
        return Redirect::back()->withErrors(["Can't Delete" ]);
    }
}
