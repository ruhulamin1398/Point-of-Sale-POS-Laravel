<?php

namespace App\Http\Controllers;

use App\Models\sellAnalysisDaily;
use App\Models\sellAnalysisMonthly;
use App\Models\sellAnalysisYearly;
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
        $yearlyLabels = array();
        $yearlyData= array();
        $dailyCost= array();
        $dailyAmount= array();
        $dailyDiscount= array();
        $dailyDue= array();
        $dailyCash= array();

        $monthStart = Carbon:: now()->format('Y-m-01');
        $monthEnd = Carbon:: now()->format('Y-m-31');
        $yearStart = Carbon:: now()->format('Y-01-01');
        $yearEnd = Carbon:: now()->format('Y-12-31');

        $sellDailys = sellAnalysisDaily::where('date','>=',$monthStart)->where('date','<=',$monthEnd)->get();
        $sellmonthlys = sellAnalysisMonthly::where('month','>=',$yearStart)->where('month','<=',$yearEnd)->get();
        $sellYearlys = sellAnalysisYearly::all();

        foreach($sellDailys as $sellDaily){
            $date = Carbon::parse($sellDaily->date)->format('d M,Y');
            array_push($dailyLabels,$date);
            array_push($DailyData,$sellDaily->count);
            array_push($dailyCost,$sellDaily->cost);
            array_push($dailyAmount,$sellDaily->amount);
            array_push($dailyDiscount,$sellDaily->discount);
            array_push($dailyDue,$sellDaily->due);
            array_push($dailyCash,$sellDaily->cash_recieved);
        }
        foreach($sellmonthlys as $sellmonthly){
            $month = Carbon::parse($sellmonthly->month)->format('M,Y');
            array_push($monthlyLabels,$month);
            array_push($monthlyData,$sellmonthly->count);
        }
        foreach($sellYearlys as $sellYearly){
            array_push($yearlyLabels,$sellYearly->year);
            array_push($yearlyData,$sellYearly->count);
        }
        

        $sellAnalysisDaily= [
            'id'=>'sellAnalysisDaily',
            'label'=>"Sell Count",
            "lebels" =>$dailyLabels,
            'data' =>$DailyData,
        ];
        $sellAnalysisMonthly= [
            'id'=>'sellAnalysisMonthly',
            'label'=>"Sell Count",
            "lebels" =>$monthlyLabels,
            'data' =>$monthlyData,
        ];
        $sellAnalysisYearly= [
            'id'=>'sellAnalysisYearly',
            'label'=>"Sell Count",
            "lebels" =>$yearlyLabels,
            'data' =>$yearlyData,
        ];


        $dailyGraphData= [
            'id'=>'dailyGraphData',
            "lebels" =>$dailyLabels,
            "datasets"=> [
                [
                    "label" => "Daily Cost",
                    "data" => $dailyCost,
                    "backgroundColor" => "#FF0000",
                    "borderColor" => 	"#FF0000",
                    "fill" => false
                ],[
                    "label" => "daily Total Amount",
                    "data" => $dailyAmount,
                    "backgroundColor" => "#008000",
                    "borderColor" => 	"#008000",
                    "fill" => false
                ],[
                    "label" => "Daily Discount",
                    "data" => $dailyDiscount,
                    "backgroundColor" => "#0000FF",
                    "borderColor" => 	"#0000FF",
                    "fill" => false
                ],[
                    "label" => "Daily Due",
                    "data" => $dailyDue,
                    "backgroundColor" => "#008080",
                    "borderColor" => 	"#008080",
                    "fill" => false
                ],[
                    "label" => "Daily Cash Recieved",
                    "data" => $dailyCash,
                    "backgroundColor" => "#00FFFF",
                    "borderColor" => 	"#00FFFF",
                    "fill" => false
                ],
            ]
        
          
        ];





        $sellAnalysisDaily= json_decode (json_encode($sellAnalysisDaily) , true);
        $sellAnalysisMonthly= json_decode (json_encode($sellAnalysisMonthly) , true);
        $sellAnalysisYearly= json_decode (json_encode($sellAnalysisYearly) , true);
        $dailyGraphData= json_decode (json_encode($dailyGraphData) , true);

        return view('analysis.sell',compact('sellAnalysisDaily','sellAnalysisMonthly','sellAnalysisYearly','dailyGraphData'));
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
