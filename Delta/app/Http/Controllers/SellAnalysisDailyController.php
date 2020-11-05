<?php

namespace App\Http\Controllers;

use App\Models\sellAnalysisDaily;
use App\Models\sellAnalysisMonthly;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SellAnalysisDailyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    $dailyLabels = array();
    $DailyData= array();
    $monthlyLabels = array();
    $monthlyData= array();
    $monthStart = Carbon:: now()->format('Y-m-01');
    $monthEnd = Carbon:: now()->format('Y-m-31');
    $yearStart = Carbon:: now()->format('Y-01-01');
    $yearEnd = Carbon:: now()->format('Y-12-31');
    $sellDailys = sellAnalysisDaily::where('date','>=',$monthStart)->where('date','<=',$monthEnd)->get();
    $sellmonthlys = sellAnalysisMonthly::where('month','>=',$yearStart)->where('month','<=',$yearEnd)->get();
    foreach($sellDailys as $sellDaily){
        $date = Carbon::parse($sellDaily->date)->format('d M,Y');
        array_push($dailyLabels,$date);
        array_push($DailyData,$sellDaily->count);
    }
    foreach($sellmonthlys as $sellmonthly){
        $month = Carbon::parse($sellmonthly->month)->format('M,Y');
        array_push($monthlyLabels,$month);
        array_push($monthlyData,$sellmonthly->count);
    }
   // array_push($labels,'Jeans');
    $sellAnalysisDaily= [
        'label'=>"Sell Count",
        "lebels" =>$dailyLabels,
        'data' =>$DailyData,

    ];
    $sellAnalysisMonthly= [
        'label'=>"Sell Count",
        "lebels" =>$monthlyLabels,
        'data' =>$monthlyData,

    ];
    $sellAnalysisDaily= json_encode($sellAnalysisDaily);
    $sellAnalysisMonthly= json_encode($sellAnalysisMonthly);
    

        return view('analysis.sell',compact('sellAnalysisDaily','sellAnalysisMonthly'));
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
     * @param  \App\Models\sellAnalysisDaily  $sellAnalysisDaily
     * @return \Illuminate\Http\Response
     */
    public function show(sellAnalysisDaily $sellAnalysisDaily)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\sellAnalysisDaily  $sellAnalysisDaily
     * @return \Illuminate\Http\Response
     */
    public function edit(sellAnalysisDaily $sellAnalysisDaily)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\sellAnalysisDaily  $sellAnalysisDaily
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, sellAnalysisDaily $sellAnalysisDaily)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\sellAnalysisDaily  $sellAnalysisDaily
     * @return \Illuminate\Http\Response
     */
    public function destroy(sellAnalysisDaily $sellAnalysisDaily)
    {
        //
    }
}
