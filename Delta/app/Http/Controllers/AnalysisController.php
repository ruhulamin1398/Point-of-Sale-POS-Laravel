<?php

namespace App\Http\Controllers;

use App\Models\sellAnalysisDaily;
use App\Models\sellAnalysisMonthly;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AnalysisController extends Controller
{
    public function index()
    {
        $dates= array();
        $months= array();
        $DailySell= array();
        $monthlySell= array();

        $monthStart = Carbon:: now()->format('Y-m-01');
        $monthEnd = Carbon:: now()->format('Y-m-31');
        $yearStart = Carbon:: now()->format('Y-01-01');
        $yearEnd = Carbon:: now()->format('Y-12-31');

        $sellDailys = sellAnalysisDaily::where('date','>=',$monthStart)->where('date','<=',$monthEnd)->get();
        $sellmonthlys = sellAnalysisMonthly::where('month','>=',$yearStart)->where('month','<=',$yearEnd)->get();

        foreach($sellDailys as $sellDaily){
            $date = Carbon::parse($sellDaily->date)->format('d M,Y');
            array_push($dates,$date);
            array_push($DailySell,$sellDaily->count);
        }
        foreach($sellmonthlys as $sellmonthly){
            $month = Carbon::parse($sellmonthly->month)->format('M,Y');
            array_push($months,$month);
            array_push($monthlySell,$sellmonthly->count);
        }
        

        $sellAnalysisDaily= [
            'id'=>'sellAnalysisDaily',
            'label'=>"Sell Count",
            "lebels" =>$dates,
            'data' =>$DailySell,
            'color'=>'#C70039',
        ];
        $sellAnalysisMonthly= [
            'id'=>'sellAnalysisMonthly',
            'label'=>"Sell Count",
            "lebels" =>$months,
            'data' =>$monthlySell,
            'color'=>'#FF5733',
        ];


        // $dailyGraphData= [
        //     'id'=>'dailyGraphData',
        //     "lebels" =>$dailyLabels,
        //     "datasets"=> [
        //         [
        //             "label" => "Daily Cost",
        //             "data" => $dailyCost,
        //             "backgroundColor" => "#FF0000",
        //             "borderColor" => 	"#FF0000",
        //             "fill" => false
        //         ],[
        //             "label" => "daily Total Amount",
        //             "data" => $dailyAmount,
        //             "backgroundColor" => "#008000",
        //             "borderColor" => 	"#008000",
        //             "fill" => false
        //         ],[
        //             "label" => "Daily Discount",
        //             "data" => $dailyDiscount,
        //             "backgroundColor" => "#0000FF",
        //             "borderColor" => 	"#0000FF",
        //             "fill" => false
        //         ],[
        //             "label" => "Daily Due",
        //             "data" => $dailyDue,
        //             "backgroundColor" => "#008080",
        //             "borderColor" => 	"#008080",
        //             "fill" => false
        //         ],[
        //             "label" => "Daily Cash Recieved",
        //             "data" => $dailyCash,
        //             "backgroundColor" => "#00FFFF",
        //             "borderColor" => 	"#00FFFF",
        //             "fill" => false
        //         ],
        //     ]
        
          
        // ];





        $sellAnalysisDaily= json_decode (json_encode($sellAnalysisDaily) , true);
        $sellAnalysisMonthly= json_decode (json_encode($sellAnalysisMonthly) , true);
        // $sellAnalysisYearly= json_decode (json_encode($sellAnalysisYearly) , true);
        // $dailyGraphData= json_decode (json_encode($dailyGraphData) , true);

        return view('analysis.index',compact('sellAnalysisDaily','sellAnalysisMonthly'));
    }
}
