<?php

namespace App\Http\Controllers;

use App\Models\expenseType;
use App\Models\setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ExpenseTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $settings = setting::where('table_name', 'expense_type')->first();
        $settings->setting = json_decode(json_decode($settings->setting, true), true);


        $dataArray = [
            'settings' => $settings,
            'items' => expenseType::all(),
        ];

        return view('expenses.expense-type', compact('dataArray'));
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
        expenseType::create($request->all());
        return redirect()->back()->withSuccess(['Successfully Created']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\expenseType  $expenseType
     * @return \Illuminate\Http\Response
     */
    public function show(expenseType $expenseType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\expenseType  $expenseType
     * @return \Illuminate\Http\Response
     */
    public function edit(expenseType $expenseType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\expenseType  $expenseType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, expenseType $expenseType)
    {
        $expenseType->update($request->all());
        return redirect()->back()->withSuccess(['Successfully Updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\expenseType  $expenseType
     * @return \Illuminate\Http\Response
     */
    public function destroy(expenseType $expenseType)
    {
        $counts = $expenseType->expense->count();
        if( $counts != 0 ){
            return Redirect::back()->withErrors(["Can't delete.","This Expense Type has Expenses. To delete it please change Expense type in Expense. " ]);
        }
        else{
            $expenseType->delete();
            return Redirect::back()->withErrors(["Item Deleted" ]);
        }
    }
}
