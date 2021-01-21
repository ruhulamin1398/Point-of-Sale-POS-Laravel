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

        $sellAnalysisDaily=$this->sellAnalysisDaily();
        $sellAnalysisMonthly=$this->sellAnalysisMonthly();
        $sellAnalysisYearly=$this->sellAnalysisYearly();
        $amountAnalysisDaily=$this->amountAnalysisDaily();


        $sellAnalysisDaily= json_decode (json_encode($sellAnalysisDaily) , true);
        $sellAnalysisMonthly= json_decode (json_encode($sellAnalysisMonthly) , true);
        $sellAnalysisYearly= json_decode (json_encode($sellAnalysisYearly) , true);
        $amountAnalysisDaily= json_decode (json_encode($amountAnalysisDaily) , true);

        return view('analysis.sell',compact('sellAnalysisDaily','sellAnalysisMonthly','sellAnalysisYearly','amountAnalysisDaily'));
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



// ***************** sellAnalysisDaily ******************
    public function sellAnalysisDaily(){
        
        $sellDates = array();
        $dailySell = array();
        $monthStart = Carbon::now()->format('Y-m-01');
        $monthEnd = Carbon::now()->format('Y-m-31');
        $sellDailys = sellAnalysisDaily::where('date', '>=', $monthStart)->where('date', '<=', $monthEnd)->get();
        foreach ($sellDailys as $sellDaily) {
            $date = Carbon::parse($sellDaily->date)->format('d M,Y');
            array_push($sellDates, $date);
            array_push($dailySell, $sellDaily->count);
        }
        $sellAnalysisDaily = [
            'id' => 'sellAnalysisDaily',
            "lebels" => $sellDates,
            "datasets" => [
                [
                    "label" => "Daily Sell",
                    "data" => $dailySell,
                    "backgroundColor" => "#C70039",
                    "borderColor" =>     "#C70039",
                    "fill" => false
                ],
            ]
        ];
        return $sellAnalysisDaily;

    }

// ***************** sellAnalysisMonthly ******************

    public function sellAnalysisMonthly()
    {
        $sellMonths = array();
        $monthlySell = array();
        $yearStart = Carbon::now()->format('Y-01-01');
        $yearEnd = Carbon::now()->format('Y-12-31');
        $sellMonthlys = sellAnalysisMonthly::where('month', '>=', $yearStart)->where('month', '<=', $yearEnd)->get();
        foreach ($sellMonthlys as $sellMonthly) {
            $month = Carbon::parse($sellMonthly->month)->format('M,Y');
            array_push($sellMonths, $month);
            array_push($monthlySell, $sellMonthly->count);
        }
        $sellAnalysisMonthly = [
            'id' => 'sellAnalysisMonthly',
            "lebels" => $sellMonths,
            "datasets" => [
                [
                    "label" => "Monthly Sell",
                    "data" => $monthlySell,
                    "backgroundColor" => "#C70039",
                    "borderColor" =>     "#C70039",
                    "fill" => false
                ],
            ]
        ];
        return $sellAnalysisMonthly;

    }

    public function sellAnalysisYearly()
    {
        
        $sellYears = array();
        $yearlysells = array();
        $sellYearlys = sellAnalysisYearly::all();
        foreach ($sellYearlys as $sellYearly) {
            array_push($sellYears, $sellYearly->year);
            array_push($yearlysells, $sellYearly->count);
        }
        $sellAnalysisYearly = [
            'id' => 'sellAnalysisYearly',
            "lebels" => $sellYears,
            "datasets" => [
                [
                    "label" => "Yearly Sell",
                    "data" => $yearlysells,
                    "backgroundColor" => "#C70039",
                    "borderColor" =>     "#C70039",
                    "fill" => false
                ],
            ]
        ];
        return $sellAnalysisYearly;

    }

    public function amountAnalysisDaily()
    { 
        
        $sellDates = array();
        $dailyCost = array();
        $dailyAmount = array();
        $dailyDiscount = array();
        $dailyDue = array();
        $dailyCash = array();
        $monthStart = Carbon::now()->format('Y-m-01');
        $monthEnd = Carbon::now()->format('Y-m-31');
        $sellDailys = sellAnalysisDaily::where('date', '>=', $monthStart)->where('date', '<=', $monthEnd)->get();
        foreach ($sellDailys as $sellDaily) {
            $date = Carbon::parse($sellDaily->date)->format('d M,Y');
            array_push($sellDates,$date);
            array_push($dailyCost,$sellDaily->cost);
            array_push($dailyAmount,$sellDaily->amount);
            array_push($dailyDiscount,$sellDaily->discount);
            array_push($dailyDue,$sellDaily->due);
            array_push($dailyCash,$sellDaily->cash_received);
        }
        $amountAnalysisDaily = [
            'id' => 'amountAnalysisDaily',
            "lebels" => $sellDates,
            "datasets" =>  [
                [
                    "label" => "Daily Cost",
                    "data" => $dailyCost,
                    "backgroundColor" => "#FF9EB3",
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
                    "label" => "Daily Cash Received",
                    "data" => $dailyCash,
                    "backgroundColor" => "#00FFFF",
                    "borderColor" => 	"#00FFFF",
                    "fill" => false
                ],
            ]
        ];
        return $amountAnalysisDaily;

    }
}
