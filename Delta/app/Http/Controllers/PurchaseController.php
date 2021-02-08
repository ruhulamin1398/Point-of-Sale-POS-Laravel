<?php

namespace App\Http\Controllers;

use App\Models\calculationAnalysisDaily;
use App\Models\calculationAnalysisMonthly;
use App\Models\calculationAnalysisYearly;
use App\Models\employeeAnalysisDaily;
use App\Models\employeeAnalysisMonthly;
use App\Models\employeeAnalysisYearly;
use App\Models\paymentSystem;
use App\Models\Product;
use App\Models\productAnalysisDaily;
use App\Models\productAnalysisMonthly;
use App\Models\productAnalysisYearly;
use App\Models\purchase;
use App\Models\purchaseAnalysisDaily;
use App\Models\purchaseAnalysisMonthly;
use App\Models\purchaseAnalysisYearly;
use App\Models\setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        if(! auth()->user()->hasPermissionTo('Purchase Page')){
            return abort(401);
        }  
        $monthStart = Carbon:: now()->format('Y-m-01 00:00:00');
        $monthEnd = Carbon:: now()->format('Y-m-31 23:59:59');
        if(! is_null($request->month)){
            $monthStart = Carbon:: parse($request->month)->format('Y-m-01 00:00:00');
            $monthEnd = Carbon:: parse($request->month)->format('Y-m-31 23:59:59');
        }
        $roles = Role::all();
        $month = Carbon:: parse($monthStart)->format('F, Y');
        $purchases= purchase::where('created_at','>=',$monthStart)->where('created_at','<=',$monthEnd)->get();

        
        $settings = setting::where('table_name', 'purchases')->first();
        $settings->setting = json_decode(json_decode($settings->setting, true), true);


        $dataArray = [
            'settings' => $settings,
            'items' => $purchases,
            'page_name' => 'Purchase',
        ];

        return view('product.purchase.index',compact('dataArray','month','roles'));
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        if(! auth()->user()->hasPermissionTo('Purchase Create Page')){
            return abort(401);
        }  
        
        $roles = Role::all();
        $paymentSystems = paymentSystem::all();
        return view('product.purchase.create',compact('paymentSystems','roles'));
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
     * @param  \App\Models\purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function show(purchase $purchase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function edit(purchase $purchase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, purchase $purchase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function destroy(purchase $purchase)
    {
        //
    }


    
    public function purchaseAnalysis($order){
        $daily_method = $monthly_method = $yearly_method = 'update';
        $month = Carbon::now()->format('Y-m-01');
        $date = Carbon::now()->format('Y-m-d');
        $year = Carbon::now()->format('Y');
        $purchaseDaily= purchaseAnalysisDaily::where('date',$date)->first();
        $purchaseMonthly= purchaseAnalysisMonthly::where('month',$month)->first();
        $purchaseYearly= purchaseAnalysisYearly::where('year',$year)->first();
        if(is_null($purchaseDaily)){
            $purchaseDaily= new purchaseAnalysisDaily;
            $purchaseDaily->date=$date;
            $daily_method = 'create';
        }
        if(is_null($purchaseMonthly)){
            $purchaseMonthly= new purchaseAnalysisMonthly;
            $purchaseMonthly->month=$month;
            $monthly_method = 'create';

        }
        if(is_null($purchaseYearly)){
            $purchaseYearly= new purchaseAnalysisYearly;
            $purchaseYearly->year=$year;
            $yearly_method = 'create';

        }
        $purchaseDaily->count += 1;
        $purchaseDaily->cost += $order->cost;
        $purchaseDaily->cash_given += $order->paid_amount;
        $purchaseDaily->discount += $order->discount;
        $purchaseDaily->amount += $order->total;
        $purchaseDaily->due += $order->total - $order->paid_amount;
        $purchaseMonthly->count += 1;
        $purchaseMonthly->cost += $order->cost;
        $purchaseMonthly->cash_given +=$order->paid_amount;
        $purchaseMonthly->discount += $order->discount;
        $purchaseMonthly->amount += $order->total;
        $purchaseMonthly->due += $order->total - $order->paid_amount;
        $purchaseYearly->count += 1;
        $purchaseYearly->cost += $order->cost;
        $purchaseYearly->cash_given += $order->paid_amount;
        $purchaseYearly->discount += $order->discount;
        $purchaseYearly->amount += $order->total;
        $purchaseYearly->due += $order->total - $order->paid_amount;
        $purchaseDaily->save();
        $purchaseMonthly->save();
        $purchaseYearly->save();


        $this->onlineSync('purchaseAnalysisDaily',$daily_method,$purchaseDaily->id);
        $this->onlineSync('purchaseAnalysisMonthly',$monthly_method,$purchaseMonthly->id);
        $this->onlineSync('purchaseAnalysisYearly',$yearly_method,$purchaseYearly->id);
      



    }
    public function productAnalysis($profit,$id,$quantity){

        $daily_method = $monthly_method = $yearly_method = 'update';


        $month = Carbon::now()->format('Y-m-01');
        $date = Carbon::now()->format('Y-m-d');
        $year = Carbon::now()->format('Y');
        $productDaily= productAnalysisDaily::where('date',$date)->where('product_id',$id )->first();
        $productMonthly= productAnalysisMonthly::where('month',$month)->where('product_id',$id)->first();
        $productYearly= productAnalysisYearly::where('year',$year)->where('product_id',$id)->first();
        if(is_null($productDaily)){
            $productDaily= new productAnalysisDaily;
            $productDaily->date=$date;
            $productDaily->product_id=$id;
            $daily_method = 'create';
        }
        if(is_null($productMonthly)){
            $productMonthly= new productAnalysisMonthly;
            $productMonthly->month=$month;
            $productMonthly->product_id=$id;
            $monthly_method = 'create';

        }
        if(is_null($productYearly)){
            $productYearly= new productAnalysisYearly;
            $productYearly->year=$year;
            $productYearly->product_id=$id;
            $yearly_method = 'create';
        }
        $productDaily->sell += $quantity;
        $productDaily->profit += $profit;
        $productMonthly->sell += $quantity;
        $productMonthly->profit += $profit;
        $productYearly->sell += $quantity;
        $productYearly->profit += $profit;
        $productDaily->save();
        $productMonthly->save();
        $productYearly->save();

        $this->onlineSync('productAnalysisDaily',$daily_method,$productDaily->id);
        $this->onlineSync('productAnalysisMonthly',$monthly_method,$productMonthly->id);
        $this->onlineSync('productAnalysisYearly',$yearly_method,$productYearly->id);
      

    }
    public function calculationAnalysis($profit,$sell,$tax){

        $daily_method = $monthly_method = $yearly_method = 'update';

        $month = Carbon::now()->format('Y-m-01');
        $date = Carbon::now()->format('Y-m-d');
        $year = Carbon::now()->format('Y');
        $calculationAnalysisDaily= calculationAnalysisDaily::where('date',$date)->first();
        $calculationAnalysisMonthly= calculationAnalysisMonthly::where('month',$month)->first();
        $calculationAnalysisYearly= calculationAnalysisYearly::where('year',$year)->first();
        if(is_null($calculationAnalysisDaily)){
            $calculationAnalysisDaily= new calculationAnalysisDaily;
            $calculationAnalysisDaily->date=$date;
            $daily_method = 'create';

        }
        if(is_null($calculationAnalysisMonthly)){
            $calculationAnalysisMonthly= new calculationAnalysisMonthly;
            $calculationAnalysisMonthly->month=$month;
            $monthly_method = 'create';

        }
        if(is_null($calculationAnalysisYearly)){
            $calculationAnalysisYearly= new calculationAnalysisYearly;
            $calculationAnalysisYearly->year=$year;
            $yearly_method = 'create';

        }
        $calculationAnalysisDaily->sell_profit += $profit;
        $calculationAnalysisMonthly->sell_profit += $profit;
        $calculationAnalysisYearly->sell_profit += $profit;
        $calculationAnalysisDaily->sell += $sell;
        $calculationAnalysisMonthly->sell += $sell;
        $calculationAnalysisYearly->sell += $sell;
        $calculationAnalysisDaily->tax += $tax;
        $calculationAnalysisMonthly->tax += $tax;
        $calculationAnalysisYearly->tax += $tax;
        $calculationAnalysisDaily->save();
        $calculationAnalysisMonthly->save();
        $calculationAnalysisYearly->save();



        $this->onlineSync('calculationAnalysisDaily',$daily_method,$calculationAnalysisDaily->id);
        $this->onlineSync('calculationAnalysisMonthly',$monthly_method,$calculationAnalysisMonthly->id);
        $this->onlineSync('calculationAnalysisYearly',$yearly_method,$calculationAnalysisYearly->id);
      


    }
    public function employeeAnalysis($profit){

        $daily_method = $monthly_method = $yearly_method = 'update';

        $month = Carbon::now()->format('Y-m-01');
        $date = Carbon::now()->format('Y-m-d');
        $year = Carbon::now()->format('Y');
        $employeeDaily= employeeAnalysisDaily::where('date',$date)->first();
        $employeeMonthly= employeeAnalysisMonthly::where('month',$month)->first();
        $employeeYearly= employeeAnalysisYearly::where('year',$year)->first();
        if(is_null($employeeDaily)){
            $employeeDaily= new employeeAnalysisDaily;
            $employeeDaily->date=$date;
            $daily_method = 'create';
        }
        if(is_null($employeeMonthly)){
            $employeeMonthly= new employeeAnalysisMonthly;
            $employeeMonthly->month=$month;
            $monthly_method = 'create';

        }
        if(is_null($employeeYearly)){
            $employeeYearly= new employeeAnalysisYearly;
            $employeeYearly->year=$year;
            $yearly_method = 'create';

        }
        $employeeDaily->sell += 1;
        $employeeDaily->profit += $profit;
        $employeeMonthly->sell += 1;
        $employeeMonthly->profit += $profit;
        $employeeYearly->sell += 1;
        $employeeYearly->profit += $profit;
        $employeeDaily->save();
        $employeeMonthly->save();
        $employeeYearly->save();


        $this->onlineSync('employeeAnalysisDaily',$daily_method,$employeeDaily->id);
        $this->onlineSync('employeeAnalysisMonthly',$monthly_method,$employeeMonthly->id);
        $this->onlineSync('employeeAnalysisYearly',$yearly_method,$employeeYearly->id);
      

    }
}
