<?php

namespace App\Http\Controllers;

use App\Models\sellAnalysisDaily;
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
    $labels = array();
    $data= array();
    $monthStart = Carbon:: now()->format('Y-m-01');
    $monthEnd = Carbon:: now()->format('Y-m-31');
    $sellDailys = sellAnalysisDaily::where('date','>=',$monthStart)->where('date','<=',$monthEnd)->get();
    foreach($sellDailys as $sellDaily){
        $date = Carbon::parse($sellDaily->date)->format('d M,Y');
        array_push($labels,$date);
        array_push($data,$sellDaily->count);
    }
   // array_push($labels,'Jeans');
    $dataArray= [
        'label'=>"Sell Count",
        "lebels" =>$labels,
        'data' =>$data,

    ];
    $dataArray= json_encode($dataArray);
    

        return view('analysis.sell',compact('dataArray'));
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
