<?php

namespace App\Http\Controllers;

use App\Models\calculationAnalysisDaily;
use App\Models\calculationAnalysisMonthly;
use App\Models\calculationAnalysisYearly;
use App\Models\sellAnalysisDaily;
use App\Models\sellAnalysisMonthly;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AnalysisController extends Controller
{
    public function index()
    {
        $today = Carbon::now()->format('Y-m-d');
        $calculation = calculationAnalysisDaily::where('date',$today)->first();
        $sell = $purchase = $expense = $profit =0;
        if(!is_null($calculation)){
            $expense += $calculation->expense;
            $expense += $calculation->payment;
            $expense += $calculation->drop_loss;
            $expense += $calculation->tax;
            $sell += $calculation->sell;
            $purchase += $calculation->buy;
            $profit += $calculation->sell_profit;
        }
        $profit -= $expense;

        $sellAnalysisDaily=$this->sellAnalysisDaily();
        $sellAnalysisMonthly=$this->sellAnalysisMonthly();
        $amountAnalysisDaily= $this->amountAnalysisDaily();
        $amountAnalysisMonthly= $this->amountAnalysisMonthly();

        $sellAnalysisDaily = json_decode(json_encode($sellAnalysisDaily), true);
        $sellAnalysisMonthly = json_decode(json_encode($sellAnalysisMonthly), true);
        $amountAnalysisDaily = json_decode(json_encode($amountAnalysisDaily), true);
        $amountAnalysisMonthly = json_decode(json_encode($amountAnalysisMonthly), true);

        return view('analysis.index', compact('sellAnalysisDaily', 'sellAnalysisMonthly','amountAnalysisDaily','amountAnalysisMonthly','sell','purchase','expense','profit'));
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

    public function sellAnalysisMonthly(){
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

// ***************** amountAnalysisDaily ******************

    public function amountAnalysisDaily(){

        $amountDates = array();
        $dailySellAmount = array();
        $dailyBuyAmount = array();
        $dailyProfitAmount = array();
        $monthStart = Carbon::now()->format('Y-m-01');
        $monthEnd = Carbon::now()->format('Y-m-31');
        $amountDailys = calculationAnalysisDaily::where('date', '>=', $monthStart)->where('date', '<=', $monthEnd)->get();

        foreach ($amountDailys as $amountDaily) {
            $date = Carbon::parse($amountDaily->date)->format('d M,Y');
            array_push($amountDates, $date);
            array_push($dailySellAmount, $amountDaily->sell);
            array_push($dailyBuyAmount, $amountDaily->buy);
            array_push($dailyProfitAmount, $amountDaily->sell_profit);
        }
        $amountAnalysisDaily = [
            'id' => 'amountAnalysisDaily',
            "lebels" => $amountDates,
            "datasets" => [
                [
                    "label" => "Daily Buy",
                    "data" => $dailyBuyAmount,
                    "backgroundColor" => "#FF0000",
                    "borderColor" =>     "#FF0000",
                    "fill" => false
                    
                ],
                [
                    "label" => "Daily Sell",
                    "data" => $dailySellAmount,
                    "backgroundColor" => "#008000",
                    "borderColor" =>     "#008000",
                    "fill" => false
                ],
                [
                    "label" => "Daily Sell Profit",
                    "data" => $dailyProfitAmount,
                    "backgroundColor" => "#0000FF",
                    "borderColor" =>     "#0000FF",
                    "fill" => false
                ],
            ]
        ];
        return $amountAnalysisDaily;

    }

// ***************** amountAnalysisMonthly ******************

    public function amountAnalysisMonthly(){

        $amountMonths = array();
        $monthlySellAmount = array();
        $monthlyBuyAmount = array();
        $monthlyProfitAmount = array();

        $yearStart = Carbon::now()->format('Y-01-01');
        $yearEnd = Carbon::now()->format('Y-12-31');

        $amountMonthlys = calculationAnalysisMonthly::where('month', '>=', $yearStart)->where('month', '<=', $yearEnd)->get();

        
        foreach ($amountMonthlys as $amountMonthly) {
            $month = Carbon::parse($amountMonthly->month)->format('M,Y');
            array_push($amountMonths, $month);
            array_push($monthlySellAmount, $amountMonthly->sell);
            array_push($monthlyBuyAmount, $amountMonthly->buy);
            array_push($monthlyProfitAmount, $amountMonthly->sell_profit);
        }


        $amountAnalysisMonthly = [
            'id' => 'amountAnalysisMonthly',
            "lebels" => $amountMonths,
            "datasets" => [
                [
                    "label" => "Monthly Buy",
                    "data" => $monthlyBuyAmount,
                    "backgroundColor" => "#FF0000",
                    "borderColor" =>     "#FF0000",
                    "fill" => false
                ],
                [
                    "label" => "Monthly Sell",
                    "data" => $monthlySellAmount,
                    "backgroundColor" => "#008000",
                    "borderColor" =>     "#008000",
                    "fill" => false
                ],
                [
                    "label" => "Monthly Sell Profit",
                    "data" => $monthlyProfitAmount,
                    "backgroundColor" => "#0000FF",
                    "borderColor" =>     "#0000FF",
                    "fill" => false
                ],
            ]
        ];
        return $amountAnalysisMonthly;
    }




}
