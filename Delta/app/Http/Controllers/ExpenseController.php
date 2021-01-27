<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExpenseRequest;
use App\Models\employee;
use App\Models\expense;
use App\Models\calculationAnalysisDaily;
use App\Models\calculationAnalysisMonthly;
use App\Models\calculationAnalysisYearly;
use App\Models\expenseMonthly;
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

        $month = Carbon::now()->format('Y-m');
        if (!is_null($request->month)) {
            $month = $request->month;
        }
        $dataArray = [
            'settings' => $settings,
            'items' => expense::where('created_at', '>=', $month . '-01 00:00:00')->where('created_at', '<=', $month . '-31 23:59:59')->get(),
            'employees' => employee::all(),
            'expense_types' => expenseType::all(),
            'page_name' => 'Expense',
        ];
        $month = Carbon::parse($month)->format('F, Y');
        return view('expenses.index', compact('dataArray', 'month'));
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
        if($request->amount<0){
        return Redirect::back()->withErrors(["Amount must be greater than 0"]);
        }
        //  return $request;
      $expense = expense::create($request->all());
        $month = Carbon::now()->format('Y-m-01');
        $expenseMonthly = expenseMonthly::where('month', $month)->where('employee_id', $request->employee_id)->first();
        $expense_monthly_method = 'update';
        if (is_null($expenseMonthly)) {
            $expenseMonthly = new expenseMonthly;
            $expenseMonthly->month = $month;
            $expenseMonthly->employee_id = $request->employee_id;
            $expense_monthly_method = 'create';

        }
        $expenseMonthly->amount += $request->amount;
        $expenseMonthly->save();

        $this->onlineSync('expense','create',$expense->id);
        $this->onlineSync('expenseMonthly',$expense_monthly_method,$expenseMonthly->id);

        //calcualtion analysis start
        $this->calculationAnalysis($request->amount);
        //calcualtion analysis start

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
    public function update(Request $request, expense $expense)
    {
        
        if($request->amount<0){
            return Redirect::back()->withErrors(["Amount must be greater than 0"]);
        }
        $previous = $expense->amount;
        $month = $expense->created_at->format('Y-m-01');
        $expense->update($request->all());
       
        if (!is_null($request->amount)) {
            $expense->changed_amount -= $previous;
            $expense->changed_amount += $request->amount;
            $expenseMonthly = expenseMonthly::where('month', $month)->where('employee_id', $expense->employee_id)->first();
            $expenseMonthly->amount -= $previous;
            $expenseMonthly->amount += $request->amount;
        }
        $expense->save();
        $expenseMonthly->save();


        $this->onlineSync('expense','create',$expense->id);
        $this->onlineSync('expenseMonthly','update',$expenseMonthly->id);

        if (!is_null($request->amount)) {
            //calcualtion analysis start
            $this->calculationAnalysis($request->amount - $previous);
            //calcualtion analysis start
        }
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
        //calcualtion analysis start
        $this->calculationAnalysis(0-$expense->amount);
        //calcualtion analysis start
        $month = $expense->created_at->format('Y-m-01');
        $expenseMonthly = expenseMonthly::where('month', $month)->where('employee_id', $expense->employee_id)->first();
        $expenseMonthly->amount -= $expense->amount;
        $expenseMonthly->save();
        $expense->delete();

        $this->onlineSync('expenseMonthly','update',$expenseMonthly->id);
        $this->onlineSync('expense','delete',$expense->id);
        return Redirect::back()->withErrors(["Expense Deleted"]);
      //  return Redirect::back()->withErrors(["Can't Delete"]);
    }

    public function calculationAnalysis($amount)
    {

        $daily_method_type = $monthly_method_type = $yearly_method_type = 'update';
        // calculation Analysis start
        $month = Carbon::now()->format('Y-m-01');
        $date = Carbon::now()->format('Y-m-d');
        $year = Carbon::now()->format('Y');
        $analysysDate = calculationAnalysisDaily::where('date', $date)->first();
        $analysysMonth = calculationAnalysisMonthly::where('month', $month)->first();
        $analysysYear = calculationAnalysisYearly::where('year', $year)->first();
        if (is_null($analysysDate)) {
            $analysysDate = new calculationAnalysisDaily;
            $analysysDate->date = $date;
            $daily_method_type = 'create';
        }
        if (is_null($analysysMonth)) {
            $analysysMonth = new calculationAnalysisMonthly;
            $analysysMonth->month = $month;
            $monthly_method_type = 'create';
        }
        if (is_null($analysysYear)) {
            $analysysYear = new calculationAnalysisYearly;
            $analysysYear->year = $year;
            $yearly_method_type = 'create';
        }
        $analysysDate->expense += $amount;
        $analysysMonth->expense += $amount;
        $analysysYear->expense += $amount;
        $analysysDate->save();
        $analysysMonth->save();
        $analysysYear->save();


        $this->onlineSync('calculationAnalysisDaily',$daily_method_type,$analysysDate->id);

        $this->onlineSync('calculationAnalysisMonthly',$monthly_method_type,$analysysMonth->id);

        $this->onlineSync('calculationAnalysisYearly',$yearly_method_type,$analysysYear->id);

        // calculation Analysis end

    }
}
