<?php

namespace App\Http\Controllers;

use App\Models\calculationAnalysisDaily;
use App\Models\calculationAnalysisMonthly;
use App\Models\calculationAnalysisYearly;
use App\Models\purchaseAnalysisDaily;
use App\Models\purchaseAnalysisMonthly;
use App\Models\purchaseAnalysisYearly;
use App\Models\sellAnalysisDaily;
use App\Models\sellAnalysisMonthly;
use App\Models\sellAnalysisYearly;
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

    public function calculationAnalysis(Request $request){
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
        $data = $this->calculationAnalysisResults($monthEnd , $monthStart , $yearEnd ,$yearStart);
        return view('analysis.calculation',compact('data'));
    }

    
    public function buyAnalysis(Request $request){
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
        $data = $this->buyAnalysisResults($monthEnd , $monthStart , $yearEnd ,$yearStart);
        return view('analysis.buy',compact('data'));
    }

    
    public function sellAnalysis(Request $request){
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
        $data = $this->sellAnalysisResults($monthEnd , $monthStart , $yearEnd ,$yearStart);
        return view('analysis.sell',compact('data'));
    }



// ***************** Sell Analysis ******************

public function sellAnalysisResults($monthEnd , $monthStart , $yearEnd ,$yearStart){
    $data = array();
    $data['month'] = Carbon::parse($monthStart)->format('F');
    $data['year'] = Carbon::parse($yearStart)->format('Y');
    $dailies = sellAnalysisDaily::where('date' ,'<=' ,$monthEnd )->where('date' ,'>=' ,$monthStart )->get();
    $monthlies = sellAnalysisMonthly::where('month' ,'<=' ,$yearEnd )->where('month' ,'>=' ,$yearStart )->get();
    $yarlies = sellAnalysisYearly::all();
    $data['dailyCount'] = $data['dailyProductCount'] = $data['dailyCost'] = $data['dailyAmount'] = $data['dailyDiscount'] = $data['dailyReturn'] =  $data['dailyDue'] = $data['dailyCashReceived'] = 0;
    $data['monthlyCount'] = $data['monthlyProductCount'] = $data['monthlyCost'] = $data['monthlyAmount'] = $data['monthlyDiscount'] = $data['monthlyReturn'] =  $data['monthlyDue'] = $data['monthlyCashReceived'] = 0;
    $data['yearlyCount'] = $data['yearlyProductCount'] = $data['yearlyCost'] = $data['yearlyAmount'] = $data['yearlyDiscount'] = $data['yearlyReturn'] =  $data['yearlyDue'] = $data['yearlyCashReceived'] = 0;
    $dailyLabels = $monthlyLabels = $yearlyLabels = array();
    $dailyCountData = $dailyProductCountData = $dailyCostData = $dailyAmountData = $dailyDiscountData = $dailyReturnData =  $dailyDueData = $dailyCashReceivedData = array();
    $monthlyCountData = $monthlyProductCountData = $monthlyCostData = $monthlyAmountData = $monthlyDiscountData = $monthlyReturnData =  $monthlyDueData = $monthlyCashReceivedData = array();
    $yearlyCountData = $yearlyProductCountData = $yearlyCostData = $yearlyAmountData = $yearlyDiscountData = $yearlyReturnData =  $yearlyDueData = $yearlyCashReceivedData = array();
    
    foreach($dailies as $daily){
        
        $data['dailyCount'] += $daily->count;
        $data['dailyProductCount'] += $daily->product_count;
        $data['dailyCost'] += $daily->cost;
        $data['dailyAmount'] += $daily->amount;
        $data['dailyDiscount'] += $daily->discount;
        $data['dailyReturn'] += $daily->return;
        $data['dailyDue'] += $daily->due;
        $data['dailyCashReceived'] += $daily->cash_received;

        array_push($dailyLabels, $daily->date);

        array_push($dailyCountData, $daily->count);
        array_push($dailyProductCountData, $daily->product_count);
        array_push($dailyCostData, $daily->cost);
        array_push($dailyAmountData, $daily->amount);
        array_push($dailyDiscountData, $daily->discount);
        array_push($dailyReturnData, $daily->return);
        array_push($dailyDueData, $daily->due);
        array_push($dailyCashReceivedData, $daily->cash_received);
    }

    foreach($monthlies as $monthly){
        $data['monthlyCount'] += $monthly->count;
        $data['monthlyProductCount'] += $monthly->product_count;
        $data['monthlyCost'] += $monthly->cost;
        $data['monthlyAmount'] += $monthly->amount;
        $data['monthlyDiscount'] += $monthly->discount;
        $data['monthlyReturn'] += $monthly->return;
        $data['monthlyDue'] += $monthly->due;
        $data['monthlyCashReceived'] += $monthly->cash_received;

        $month = Carbon::parse($monthly->month)->format('F');
        array_push($monthlyLabels, $month);

        array_push($monthlyCountData, $monthly->count);
        array_push($monthlyProductCountData, $monthly->product_count);
        array_push($monthlyCostData, $monthly->cost);
        array_push($monthlyAmountData, $monthly->amount);
        array_push($monthlyDiscountData, $monthly->discount);
        array_push($monthlyReturnData, $monthly->return);
        array_push($monthlyDueData, $monthly->due);
        array_push($monthlyCashReceivedData, $monthly->cash_received);
    }
    

    foreach($yarlies as $yearly){
        $data['yearlyCount'] += $yearly->count;
        $data['yearlyProductCount'] += $yearly->product_count;
        $data['yearlyCost'] += $yearly->cost;
        $data['yearlyAmount'] += $yearly->amount;
        $data['yearlyDiscount'] += $yearly->discount;
        $data['yearlyReturn'] += $yearly->return;
        $data['yearlyDue'] += $yearly->due;
        $data['yearlyCashReceived'] += $yearly->cash_received;

        array_push($yearlyLabels, $yearly->year);

        array_push($yearlyCountData, $yearly->count);
        array_push($yearlyProductCountData, $yearly->product_count);
        array_push($yearlyCostData, $yearly->cost);
        array_push($yearlyAmountData, $yearly->amount);
        array_push($yearlyDiscountData, $yearly->discount);
        array_push($yearlyReturnData, $yearly->return);
        array_push($yearlyDueData, $yearly->due);
        array_push($yearlyCashReceivedData, $yearly->cash_received);
    }
    
    $data['dailyCountGraph'] = json_decode(json_encode(  $this->chartGenerator($dailyLabels ,'Sell Count', $dailyCountData ,'#306754')  ), true);
    $data['dailyProductCountGraph'] = json_decode(json_encode(  $this->chartGenerator($dailyLabels ,'Product Count', $dailyProductCountData ,'#FFFF00')  ), true);
    $data['dailyCostGraph'] = json_decode(json_encode(  $this->chartGenerator($dailyLabels ,'Cost', $dailyCostData ,'#008000')  ), true);
    $data['dailyAmountGraph'] = json_decode(json_encode(  $this->chartGenerator($dailyLabels ,'Amount', $dailyAmountData ,'#0000A0')  ), true);
    $data['dailyDiscountGraph'] = json_decode(json_encode(  $this->chartGenerator($dailyLabels ,'Discount', $dailyDiscountData ,'#008080')  ), true);
    $data['dailyReturnGraph'] = json_decode(json_encode(  $this->chartGenerator($dailyLabels ,'Return', $dailyReturnData ,'#00FF00')  ), true);
    $data['dailyDueGraph'] = json_decode(json_encode(  $this->chartGenerator($dailyLabels ,'Due', $dailyDueData ,'#FF0000')  ), true);
    $data['dailyCashReceivedGraph'] = json_decode(json_encode(  $this->chartGenerator($dailyLabels ,'Cash Received', $dailyCashReceivedData ,'#FFA500')  ), true);
    
    $data['monthlyCountGraph'] = json_decode(json_encode(  $this->chartGenerator($monthlyLabels ,'Sell Count', $monthlyCountData ,'#306754')  ), true);
    $data['monthlyProductCountGraph'] = json_decode(json_encode(  $this->chartGenerator($monthlyLabels ,'Product Count', $monthlyProductCountData ,'#FFFF00')  ), true);
    $data['monthlyCostGraph'] = json_decode(json_encode(  $this->chartGenerator($monthlyLabels ,'Cost', $monthlyCostData ,'#008000')  ), true);
    $data['monthlyAmountGraph'] = json_decode(json_encode(  $this->chartGenerator($monthlyLabels ,'Amount', $monthlyAmountData ,'#0000A0')  ), true);
    $data['monthlyDiscountGraph'] = json_decode(json_encode(  $this->chartGenerator($monthlyLabels ,'Discount', $monthlyDiscountData ,'#008080')  ), true);
    $data['monthlyReturnGraph'] = json_decode(json_encode(  $this->chartGenerator($monthlyLabels ,'Return', $monthlyReturnData ,'#00FF00')  ), true);
    $data['monthlyDueGraph'] = json_decode(json_encode(  $this->chartGenerator($monthlyLabels ,'Due', $monthlyDueData ,'#FF0000')  ), true);
    $data['monthlyCashReceivedGraph'] = json_decode(json_encode(  $this->chartGenerator($monthlyLabels ,'Cash Received', $monthlyCashReceivedData ,'#FFA500')  ), true);
    
    $data['yearlyCountGraph'] = json_decode(json_encode(  $this->chartGenerator($yearlyLabels ,'Sell Count', $yearlyCountData ,'#306754')  ), true);
    $data['yearlyProductCountGraph'] = json_decode(json_encode(  $this->chartGenerator($yearlyLabels ,'Product Count', $yearlyProductCountData ,'#FFFF00')  ), true);
    $data['yearlyCostGraph'] = json_decode(json_encode(  $this->chartGenerator($yearlyLabels ,'Cost', $yearlyCostData ,'#008000')  ), true);
    $data['yearlyAmountGraph'] = json_decode(json_encode(  $this->chartGenerator($yearlyLabels ,'Amount', $yearlyAmountData ,'#0000A0')  ), true);
    $data['yearlyDiscountGraph'] = json_decode(json_encode(  $this->chartGenerator($yearlyLabels ,'Discount', $yearlyDiscountData ,'#008080')  ), true);
    $data['yearlyReturnGraph'] = json_decode(json_encode(  $this->chartGenerator($yearlyLabels ,'Return', $yearlyReturnData ,'#00FF00')  ), true);
    $data['yearlyDueGraph'] = json_decode(json_encode(  $this->chartGenerator($yearlyLabels ,'Due', $yearlyDueData ,'#FF0000')  ), true);
    $data['yearlyCashReceivedGraph'] = json_decode(json_encode(  $this->chartGenerator($yearlyLabels ,'Cash Received', $yearlyCashReceivedData ,'#FFA500') ) ,true ); 

    return $data;

}

// ***************** Buy Analysis ******************

public function buyAnalysisResults($monthEnd , $monthStart , $yearEnd ,$yearStart){
    $data = array();
    $data['month'] = Carbon::parse($monthStart)->format('F');
    $data['year'] = Carbon::parse($yearStart)->format('Y');
    $dailies = purchaseAnalysisDaily::where('date' ,'<=' ,$monthEnd )->where('date' ,'>=' ,$monthStart )->get();
    $monthlies = purchaseAnalysisMonthly::where('month' ,'<=' ,$yearEnd )->where('month' ,'>=' ,$yearStart )->get();
    $yarlies = purchaseAnalysisYearly::all();
    $data['dailyCount'] = $data['dailyProductCount'] = $data['dailyCost'] = $data['dailyAmount'] = $data['dailyDiscount'] = $data['dailyReturn'] =  $data['dailyDue'] = $data['dailyCashGiven'] = 0;
    $data['monthlyCount'] = $data['monthlyProductCount'] = $data['monthlyCost'] = $data['monthlyAmount'] = $data['monthlyDiscount'] = $data['monthlyReturn'] =  $data['monthlyDue'] = $data['monthlyCashGiven'] = 0;
    $data['yearlyCount'] = $data['yearlyProductCount'] = $data['yearlyCost'] = $data['yearlyAmount'] = $data['yearlyDiscount'] = $data['yearlyReturn'] =  $data['yearlyDue'] = $data['yearlyCashGiven'] = 0;
    $dailyLabels = $monthlyLabels = $yearlyLabels = array();
    $dailyCountData = $dailyProductCountData = $dailyCostData = $dailyAmountData = $dailyDiscountData = $dailyReturnData =  $dailyDueData = $dailyCashGivenData = array();
    $monthlyCountData = $monthlyProductCountData = $monthlyCostData = $monthlyAmountData = $monthlyDiscountData = $monthlyReturnData =  $monthlyDueData = $monthlyCashGivenData = array();
    $yearlyCountData = $yearlyProductCountData = $yearlyCostData = $yearlyAmountData = $yearlyDiscountData = $yearlyReturnData =  $yearlyDueData = $yearlyCashGivenData = array();
    
    foreach($dailies as $daily){
        
        $data['dailyCount'] += $daily->count;
        $data['dailyProductCount'] += $daily->product_count;
        $data['dailyCost'] += $daily->cost;
        $data['dailyAmount'] += $daily->amount;
        $data['dailyDiscount'] += $daily->discount;
        $data['dailyReturn'] += $daily->return;
        $data['dailyDue'] += $daily->due;
        $data['dailyCashGiven'] += $daily->cash_given;

        array_push($dailyLabels, $daily->date);

        array_push($dailyCountData, $daily->count);
        array_push($dailyProductCountData, $daily->product_count);
        array_push($dailyCostData, $daily->cost);
        array_push($dailyAmountData, $daily->amount);
        array_push($dailyDiscountData, $daily->discount);
        array_push($dailyReturnData, $daily->return);
        array_push($dailyDueData, $daily->due);
        array_push($dailyCashGivenData, $daily->cash_given);
    }

    foreach($monthlies as $monthly){
        $data['monthlyCount'] += $monthly->count;
        $data['monthlyProductCount'] += $monthly->product_count;
        $data['monthlyCost'] += $monthly->cost;
        $data['monthlyAmount'] += $monthly->amount;
        $data['monthlyDiscount'] += $monthly->discount;
        $data['monthlyReturn'] += $monthly->return;
        $data['monthlyDue'] += $monthly->due;
        $data['monthlyCashGiven'] += $monthly->cash_given;

        $month = Carbon::parse($monthly->month)->format('F');
        array_push($monthlyLabels, $month);

        array_push($monthlyCountData, $monthly->count);
        array_push($monthlyProductCountData, $monthly->product_count);
        array_push($monthlyCostData, $monthly->cost);
        array_push($monthlyAmountData, $monthly->amount);
        array_push($monthlyDiscountData, $monthly->discount);
        array_push($monthlyReturnData, $monthly->return);
        array_push($monthlyDueData, $monthly->due);
        array_push($monthlyCashGivenData, $monthly->cash_given);
    }
    

    foreach($yarlies as $yearly){
        $data['yearlyCount'] += $yearly->count;
        $data['yearlyProductCount'] += $yearly->product_count;
        $data['yearlyCost'] += $yearly->cost;
        $data['yearlyAmount'] += $yearly->amount;
        $data['yearlyDiscount'] += $yearly->discount;
        $data['yearlyReturn'] += $yearly->return;
        $data['yearlyDue'] += $yearly->due;
        $data['yearlyCashGiven'] += $yearly->cash_given;

        array_push($yearlyLabels, $yearly->year);

        array_push($yearlyCountData, $yearly->count);
        array_push($yearlyProductCountData, $yearly->product_count);
        array_push($yearlyCostData, $yearly->cost);
        array_push($yearlyAmountData, $yearly->amount);
        array_push($yearlyDiscountData, $yearly->discount);
        array_push($yearlyReturnData, $yearly->return);
        array_push($yearlyDueData, $yearly->due);
        array_push($yearlyCashGivenData, $yearly->cash_given);
    }
    
    $data['dailyCountGraph'] = json_decode(json_encode(  $this->chartGenerator($dailyLabels ,'Buy Count', $dailyCountData ,'#306754')  ), true);
    $data['dailyProductCountGraph'] = json_decode(json_encode(  $this->chartGenerator($dailyLabels ,'Product Count', $dailyProductCountData ,'#FFFF00')  ), true);
    $data['dailyCostGraph'] = json_decode(json_encode(  $this->chartGenerator($dailyLabels ,'Cost', $dailyCostData ,'#008000')  ), true);
    $data['dailyAmountGraph'] = json_decode(json_encode(  $this->chartGenerator($dailyLabels ,'Amount', $dailyAmountData ,'#0000A0')  ), true);
    $data['dailyDiscountGraph'] = json_decode(json_encode(  $this->chartGenerator($dailyLabels ,'Discount', $dailyDiscountData ,'#008080')  ), true);
    $data['dailyReturnGraph'] = json_decode(json_encode(  $this->chartGenerator($dailyLabels ,'Return', $dailyReturnData ,'#00FF00')  ), true);
    $data['dailyDueGraph'] = json_decode(json_encode(  $this->chartGenerator($dailyLabels ,'Due', $dailyDueData ,'#FF0000')  ), true);
    $data['dailyCashGivenGraph'] = json_decode(json_encode(  $this->chartGenerator($dailyLabels ,'Cash Given', $dailyCashGivenData ,'#FFA500')  ), true);
    
    $data['monthlyCountGraph'] = json_decode(json_encode(  $this->chartGenerator($monthlyLabels ,'Buy Count', $monthlyCountData ,'#306754')  ), true);
    $data['monthlyProductCountGraph'] = json_decode(json_encode(  $this->chartGenerator($monthlyLabels ,'Product Count', $monthlyProductCountData ,'#FFFF00')  ), true);
    $data['monthlyCostGraph'] = json_decode(json_encode(  $this->chartGenerator($monthlyLabels ,'Cost', $monthlyCostData ,'#008000')  ), true);
    $data['monthlyAmountGraph'] = json_decode(json_encode(  $this->chartGenerator($monthlyLabels ,'Amount', $monthlyAmountData ,'#0000A0')  ), true);
    $data['monthlyDiscountGraph'] = json_decode(json_encode(  $this->chartGenerator($monthlyLabels ,'Discount', $monthlyDiscountData ,'#008080')  ), true);
    $data['monthlyReturnGraph'] = json_decode(json_encode(  $this->chartGenerator($monthlyLabels ,'Return', $monthlyReturnData ,'#00FF00')  ), true);
    $data['monthlyDueGraph'] = json_decode(json_encode(  $this->chartGenerator($monthlyLabels ,'Due', $monthlyDueData ,'#FF0000')  ), true);
    $data['monthlyCashGivenGraph'] = json_decode(json_encode(  $this->chartGenerator($monthlyLabels ,'Cash Given', $monthlyCashGivenData ,'#FFA500')  ), true);
    
    $data['yearlyCountGraph'] = json_decode(json_encode(  $this->chartGenerator($yearlyLabels ,'Buy Count', $yearlyCountData ,'#306754')  ), true);
    $data['yearlyProductCountGraph'] = json_decode(json_encode(  $this->chartGenerator($yearlyLabels ,'Product Count', $yearlyProductCountData ,'#FFFF00')  ), true);
    $data['yearlyCostGraph'] = json_decode(json_encode(  $this->chartGenerator($yearlyLabels ,'Cost', $yearlyCostData ,'#008000')  ), true);
    $data['yearlyAmountGraph'] = json_decode(json_encode(  $this->chartGenerator($yearlyLabels ,'Amount', $yearlyAmountData ,'#0000A0')  ), true);
    $data['yearlyDiscountGraph'] = json_decode(json_encode(  $this->chartGenerator($yearlyLabels ,'Discount', $yearlyDiscountData ,'#008080')  ), true);
    $data['yearlyReturnGraph'] = json_decode(json_encode(  $this->chartGenerator($yearlyLabels ,'Return', $yearlyReturnData ,'#00FF00')  ), true);
    $data['yearlyDueGraph'] = json_decode(json_encode(  $this->chartGenerator($yearlyLabels ,'Due', $yearlyDueData ,'#FF0000')  ), true);
    $data['yearlyCashGivenGraph'] = json_decode(json_encode(  $this->chartGenerator($yearlyLabels ,'Cash Given', $yearlyCashGivenData ,'#FFA500') ) ,true ); 

    return $data;

}

// ***************** Calculation Analysis ******************

public function calculationAnalysisResults($monthEnd , $monthStart , $yearEnd ,$yearStart){
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
