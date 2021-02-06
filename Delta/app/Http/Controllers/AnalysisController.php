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

    public function calculation(Request $request){
        $monthStart = Carbon::now()->format('Y-m-01');
        $monthEnd = Carbon::now()->format('Y-m-31');
        $yearStart = Carbon::now()->format('Y-01-01');
        $yearEnd = Carbon::now()->format('Y-12-31');
        if(! is_null($request->month)){
            $monthStart = $request->month . '-01';
            $monthEnd = $request->month . '-31';
        }
        if(! is_null($request->year)){
            $yearStart = $request->year . '-01-01';
            $yearEnd = $request->year . '-12-31';
            
        }
        $data = $this->calculationAnalysis($monthEnd , $monthStart , $yearEnd ,$yearStart);
        return view('analysis.calculation',compact('data'));
    }



// ***************** Calculation Analysis ******************

public function calculationAnalysis($monthEnd , $monthStart , $yearEnd ,$yearStart){
    $data = array();
    $data['month'] = Carbon::parse($monthStart)->format('F');
    $data['year'] = Carbon::parse($yearStart)->format('Y');
    $calculationDailies = calculationAnalysisDaily::where('date' ,'<=' ,$monthEnd )->where('date' ,'>=' ,$monthStart )->get();
    $calculationMonthlies = calculationAnalysisMonthly::where('month' ,'<=' ,$yearEnd )->where('month' ,'>=' ,$yearStart )->get();
    $calculationYearlies = calculationAnalysisYearly::all();
    $data['dailyProfit'] = $data['dailyExpense'] = $data['dailyPayment'] = $data['dailyBuy'] = $data['dailySell'] = $data['dailySellProfit'] =  $data['dailyDrop'] = $data['dailyTax'] = 0;
    $data['monthlyProfit'] = $data['monthlyExpense'] = $data['monthlyPayment'] = $data['monthlyBuy'] = $data['monthlySell'] = $data['monthlySellProfit'] =  $data['monthlyDrop'] = $data['monthlyTax'] = 0;
    $data['yearlyProfit'] = $data['yearlyExpense'] = $data['yearlyPayment'] = $data['yearlyBuy'] = $data['yearlySell'] = $data['yearlySellProfit'] =  $data['yearlyDrop'] = $data['yearlyTax'] = 0;
    $dailyLabels = $monthlyLabels = $yearlyLabels = array();
    $dailyProfitData = $dailyExpenseData = $dailyPaymentData = $dailyBuyData = $dailySellData = $dailySellProfitData =  $dailyDropData = $dailyTaxData = array();
    $monthlyProfitData = $monthlyExpenseData = $monthlyPaymentData = $monthlyBuyData = $monthlySellData = $monthlySellProfitData =  $monthlyDropData = $monthlyTaxData  = array();
    $yearlyProfitData = $yearlyExpenseData = $yearlyPaymentData = $yearlyBuyData = $yearlySellData = $yearlySellProfitData =  $yearlyDropData = $yearlyTaxData = array();
    
    foreach($calculationDailies as $calculation){
        
        $data['dailyExpense'] += $calculation->expense;
        $data['dailyPayment'] += $calculation->payment;
        $data['dailyBuy'] += $calculation->buy;
        $data['dailySell'] += $calculation->sell;
        $data['dailySellProfit'] += $calculation->sell_profit;
        $data['dailyDrop'] += $calculation->drop_loss;
        $data['dailyTax'] += $calculation->tax;
        $profit = $data['dailySellProfit'] - $data['dailyExpense'] - $data['dailyPayment'] - $data['dailyDrop'] - $data['dailyTax'];
        $data['dailyProfit'] += $profit;
        array_push($dailyLabels, $calculation->date);
        array_push($dailyProfitData, $profit);
        array_push($dailyExpenseData, $calculation->expense);
        array_push($dailyPaymentData, $calculation->payment);
        array_push($dailyBuyData, $calculation->buy);
        array_push($dailySellData, $calculation->sell);
        array_push($dailySellProfitData, $calculation->sell_profit);
        array_push($dailyDropData, $calculation->drop_loss);
        array_push($dailyTaxData, $calculation->tax);
    }

    foreach($calculationMonthlies as $calculation){
        $data['monthlyPayment'] += $calculation->payment;
        $data['monthlyExpense'] += $calculation->expense;
        $data['monthlyBuy'] += $calculation->buy;
        $data['monthlySell'] += $calculation->sell;
        $data['monthlySellProfit'] += $calculation->sell_profit;
        $data['monthlyDrop'] += $calculation->drop_loss;
        $data['monthlyTax'] += $calculation->tax;
        $profit = $data['monthlySellProfit'] - $data['monthlyExpense'] - $data['monthlyPayment'] - $data['monthlyDrop'] - $data['monthlyTax'];
        $data['monthlyProfit'] += $profit;
        $month = Carbon::parse($calculation->month)->format('F');
        array_push($monthlyLabels, $month);
        array_push($monthlyProfitData, $profit);
        array_push($monthlyExpenseData, $calculation->expense);
        array_push($monthlyPaymentData, $calculation->payment);
        array_push($monthlyBuyData, $calculation->buy);
        array_push($monthlySellData, $calculation->sell);
        array_push($monthlySellProfitData, $calculation->sell_profit);
        array_push($monthlyDropData, $calculation->drop_loss);
        array_push($monthlyTaxData, $calculation->tax);
    }
    

    foreach($calculationYearlies as $calculation){
        
        $data['yearlyPayment'] += $calculation->payment;
        $data['yearlyExpense'] += $calculation->expense;
        $data['yearlyBuy'] += $calculation->buy;
        $data['yearlySell'] += $calculation->sell;
        $data['yearlySellProfit'] += $calculation->sell_profit;
        $data['yearlyDrop'] += $calculation->drop_loss;
        $data['yearlyTax'] += $calculation->tax;
        $profit = $data['yearlySellProfit'] - $data['yearlyExpense'] - $data['yearlyPayment'] - $data['yearlyDrop'] - $data['yearlyTax'];
        $data['yearlyProfit'] += $profit;
        array_push($yearlyLabels, $calculation->year);
        array_push($yearlyProfitData, $profit);
        array_push($yearlyExpenseData, $calculation->expense);
        array_push($yearlyPaymentData, $calculation->payment);
        array_push($yearlyBuyData, $calculation->buy);
        array_push($yearlySellData, $calculation->sell);
        array_push($yearlySellProfitData, $calculation->sell_profit);
        array_push($yearlyDropData, $calculation->drop_loss);
        array_push($yearlyTaxData, $calculation->tax);
    }
    
    $data['dailySellGraph'] = json_decode(json_encode(  $this->chartGenerator($dailyLabels ,'Sell', $dailySellData ,'#306754')  ), true);
    $data['dailyExpenseGraph'] = json_decode(json_encode(  $this->chartGenerator($dailyLabels ,'Expense', $dailyExpenseData ,'#FFFF00')  ), true);
    $data['dailyProfitGraph'] = json_decode(json_encode(  $this->chartGenerator($dailyLabels ,'Profit', $dailyProfitData ,'#008000')  ), true);
    $data['dailyPaymentGraph'] = json_decode(json_encode(  $this->chartGenerator($dailyLabels ,'Payment', $dailyPaymentData ,'#0000A0')  ), true);
    $data['dailyBuyGraph'] = json_decode(json_encode(  $this->chartGenerator($dailyLabels ,'Buy', $dailyBuyData ,'#008080')  ), true);
    $data['dailySellProfitGraph'] = json_decode(json_encode(  $this->chartGenerator($dailyLabels ,'Sell Profit', $dailySellProfitData ,'#00FF00')  ), true);
    $data['dailyDropGraph'] = json_decode(json_encode(  $this->chartGenerator($dailyLabels ,'Drop', $dailyDropData ,'#FF0000')  ), true);
    $data['dailyTaxGraph'] = json_decode(json_encode(  $this->chartGenerator($dailyLabels ,'Tax', $dailyTaxData ,'#FFA500')  ), true);
    $data['monthlyProfitGraph'] = json_decode(json_encode(  $this->chartGenerator($monthlyLabels ,'Profit', $monthlyProfitData ,'#008000')  ), true);
    $data['monthlyExpenseGraph'] = json_decode(json_encode(  $this->chartGenerator($monthlyLabels ,'Expense', $monthlyExpenseData ,'#FFFF00')  ), true);
    $data['monthlyPaymentGraph'] = json_decode(json_encode(  $this->chartGenerator($monthlyLabels ,'Payment', $monthlyPaymentData ,'#0000A0')  ), true);
    $data['monthlyBuyGraph'] = json_decode(json_encode(  $this->chartGenerator($monthlyLabels ,'Buy', $monthlyBuyData ,'#008080')  ), true);
    $data['monthlySellGraph'] = json_decode(json_encode(  $this->chartGenerator($monthlyLabels ,'Sell', $monthlySellData ,'#306754')  ), true);
    $data['monthlySellProfitGraph'] = json_decode(json_encode(  $this->chartGenerator($monthlyLabels ,'Sell Profit', $monthlySellProfitData ,'#00FF00')  ), true);
    $data['monthlyDropGraph'] = json_decode(json_encode(  $this->chartGenerator($monthlyLabels ,'Drop', $monthlyDropData ,'#FF0000')  ), true);
    $data['monthlyTaxGraph'] = json_decode(json_encode(  $this->chartGenerator($monthlyLabels ,'Tax', $monthlyTaxData ,'#FFA500')  ), true);
    $data['yearlyProfitGraph'] = json_decode(json_encode(  $this->chartGenerator($yearlyLabels ,'Profit', $yearlyProfitData ,'#008000')  ), true);
    $data['yearlyExpenseGraph'] = json_decode(json_encode(  $this->chartGenerator($yearlyLabels ,'Expense', $yearlyExpenseData ,'#FFFF00')  ), true);
    $data['yearlyPaymentGraph'] = json_decode(json_encode(  $this->chartGenerator($yearlyLabels ,'Payment', $yearlyPaymentData ,'#0000A0')  ), true);
    $data['yearlyBuyGraph'] = json_decode(json_encode(  $this->chartGenerator($yearlyLabels ,'Buy', $yearlyBuyData ,'#008080')  ), true);
    $data['yearlySellGraph'] = json_decode(json_encode(  $this->chartGenerator($yearlyLabels ,'Sell', $yearlySellData ,'#306754')  ), true);
    $data['yearlySellProfitGraph'] = json_decode(json_encode(  $this->chartGenerator($yearlyLabels ,'Sell Profit', $yearlySellProfitData ,'#00FF00')  ), true);
    $data['yearlyDropGraph'] = json_decode(json_encode(  $this->chartGenerator($yearlyLabels ,'Drop', $yearlyDropData ,'#FF0000')  ), true);
    $data['yearlyTaxGraph'] = json_decode(json_encode(  $this->chartGenerator($yearlyLabels ,'Tax', $yearlyTaxData ,'#FFA500')  ), true);

    return $data;

}



public function chartGenerator($lebels ,$lebel, $data,$color){
    
    $productAnalysisSell = [
        "lebels" => $lebels,
        "datasets" => [
            [
                "label" => $lebel,
                "data" => $data,
                "backgroundColor" => $color,
                "borderColor" =>     $color,
                "fill" => false
            ],
        ]
    ];
    return  $productAnalysisSell;
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
