<?php

namespace App\Http\Controllers;

use App\Models\purchaseAnalysisDaily;
use App\Models\purchaseAnalysisMonthly;
use App\Models\purchaseAnalysisYearly;
use App\Models\setting;
use App\Models\supplier;
use App\Models\supplierDuePay;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SupplierDuePayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        
        $monthStart=Carbon::now()->format('Y-m-01 00:00:00');
        $monthEnd=Carbon::now()->format('Y-m-31 23:59:59');
        if( ! is_null($request->month)){
            $monthStart=Carbon::parse($request->month)->format('Y-m-01 00:00:00');
            $monthEnd=Carbon::parse($request->month)->format('Y-m-31 23:59:59');
        }
       // return compact('monthStart','monthEnd');
        $settings = setting::where('table_name', 'supplier_due_pays')->first();
        $settings->setting = json_decode(json_decode($settings->setting, true), true);
        $dues =  supplierDuePay::where('created_at','>=',$monthStart)->where('created_at','<=',$monthEnd)->get();
        $dataArray = [
            'settings' => $settings,
            'items' =>$dues,
        ];
         return view('due.supplier.index',compact('dataArray'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('due.supplier.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $due = new supplierDuePay;
        $supplier = supplier::find($request->supplier_id);
        if($supplier->due < $request->amount){
            return redirect()->back()->withErrors(['Due is less than Amount']);
        }

        $due->user_id = 1 ; //Auth::user()->id;
        $due->supplier_id = $request->supplier_id;
        $due->amount = $request->amount;
        $due->comment = $request->comment;
        $due->pre_due = $supplier->due;
        $supplier->due = $supplier->due - $request->amount;
        $due->save();
        $supplier->save();



        $this->onlineSync('supplierDuePay','create',$due->id);
        $this->onlineSync('supplier','update',$supplier->id);


        $this->purchaseAnalysis($request->amount);
        return redirect(route('supplier-due-pays.index'))->withSuccess(['Successfully Paid']);
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\supplierDuePay  $supplierDuePay
     * @return \Illuminate\Http\Response
     */
    public function show(supplierDuePay $supplierDuePay)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\supplierDuePay  $supplierDuePay
     * @return \Illuminate\Http\Response
     */
    public function edit(supplierDuePay $supplierDuePay)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\supplierDuePay  $supplierDuePay
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, supplierDuePay $supplierDuePay)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\supplierDuePay  $supplierDuePay
     * @return \Illuminate\Http\Response
     */
    public function destroy(supplierDuePay $supplierDuePay)
    {
        //
    }
    
    public function purchaseAnalysis( $amount){

        $daily_method = $monthly_method = $yearly_method = 'update';


        $month = Carbon::now()->format('Y-m-01');
        $date = Carbon::now()->format('Y-m-d');
        $year = Carbon::now()->format('Y');
        $sellDaily= purchaseAnalysisDaily::where('date',$date)->first();
        $sellMonthly= purchaseAnalysisMonthly::where('month',$month)->first();
        $sellYearly= purchaseAnalysisYearly::where('year',$year)->first();
        if(is_null($sellDaily)){


            $sellDaily= new purchaseAnalysisDaily;
            $sellDaily->date=$date;
            $daily_method = 'create';
        }
        if(is_null($sellMonthly)){
            $sellMonthly= new purchaseAnalysisMonthly;
            $sellMonthly->month=$month;
            $monthly_method = 'create';
        }
        if(is_null($sellYearly)){
            $sellYearly= new purchaseAnalysisYearly;
            $sellYearly->year=$year;
            $yearly_method = 'create';
        }

        $sellDaily->cash_given += $amount;
        $sellMonthly->cash_given += $amount;
        $sellYearly->cash_given += $amount;


        $sellDaily->save();
        $sellMonthly->save();
        $sellYearly->save();


        

        $this->onlineSync('purchaseAnalysisDaily',$daily_method,$sellDaily->id);
        $this->onlineSync('purchaseAnalysisMonthly',$monthly_method,$sellMonthly->id);
        $this->onlineSync('purchaseAnalysisYearly',$yearly_method,$sellYearly->id);
      
    }

}
