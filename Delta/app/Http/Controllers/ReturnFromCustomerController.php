<?php

namespace App\Http\Controllers;

use App\Models\calculationAnalysisDaily;
use App\Models\calculationAnalysisMonthly;
use App\Models\calculationAnalysisYearly;
use App\Models\Product;
use App\Models\productAnalysisDaily;
use App\Models\productAnalysisMonthly;
use App\Models\productAnalysisYearly;
use App\Models\returnFromCustomer;
use App\Models\sellAnalysisDaily;
use App\Models\sellAnalysisMonthly;
use App\Models\sellAnalysisYearly;
use App\Models\setting;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReturnFromCustomerController extends Controller
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
        $settings = setting::where('table_name', 'return_from_customers')->first();
        $settings->setting = json_decode(json_decode($settings->setting, true), true);
        $returnProducts =  returnFromCustomer::where('created_at','>=',$monthStart)->where('created_at','<=',$monthEnd)->get();
        foreach($returnProducts as $returnProduct){
            $returnProduct->quantity = $returnProduct->quantity / $returnProduct->products->unit->value;
        }
        $dataArray = [
            'settings' => $settings,
            'items' =>$returnProducts,
        ];


        return view('product.return-product.customer.index', compact('dataArray'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $startTime = Carbon::now()->format('Y-m-d 00:00:00');
        $endTime = Carbon::now()->format('Y-m-d 23:59:59') ;
        $returnProducsts = returnFromCustomer::where('created_at','>=',$startTime  )->where('created_at','<=',$endTime  )->orderBy('id','desc')->get();
        $products = Product::all();
        return view('product.return-product.customer.create',compact('products','returnProducsts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = Product::find($request->product_id);

        $returnProduct = new returnFromCustomer;
        $returnProduct->user_id =1; //Auth::user()->id;
        $returnProduct->product_id =$request->product_id ;
        $returnProduct->customer_id =$request->return_product_customer_id ;
        $returnProduct->quantity =$request->quantity * $product->unit->value;
        $returnProduct->price =$request->price ;
        $returnProduct->comment =$request->comment ;
        $returnProduct->save();
        $cost = $product->cost_per_unit *  $returnProduct->quantity;
        $price_with_tax = $returnProduct->price ;
        $price = ($price_with_tax * 100) / (100 + $product->tax);

        $tax = $price_with_tax - $price ;

        $returnProduct->profit =     $cost - $price ;

        $product->stock += $returnProduct->quantity;
        $returnProduct->save();
        $product->save();

        
         $this->onlineSync('returnFromCustomer','create',$returnProduct->id);
         $this->onlineSync('Product','update',$product->id);

        //tax calculation

        
        //analysis
        $this->calculationAnalysis($returnProduct->profit,$tax,$price_with_tax);
        $this->productAnalysis($returnProduct->profit,$returnProduct->product_id,$returnProduct->quantity);
        $this->sellAnalysis($returnProduct->quantity , $cost , $price_with_tax);




         return redirect()->back()->withSuccess(["Product Returned"]);
        //add analysis

        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\returnFromCustomer  $returnFromCustomer
     * @return \Illuminate\Http\Response
     */
    public function show(returnFromCustomer $returnFromCustomer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\returnFromCustomer  $returnFromCustomer
     * @return \Illuminate\Http\Response
     */
    public function edit(returnFromCustomer $returnFromCustomer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\returnFromCustomer  $returnFromCustomer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, returnFromCustomer $returnFromCustomer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\returnFromCustomer  $returnFromCustomer
     * @return \Illuminate\Http\Response
     */
    public function destroy(returnFromCustomer $returnFromCustomer)
    {
        //
    }
    
    public function calculationAnalysis($profit,$tax,$price)
    {
        $daily_method = $monthly_method = $yearly_method = 'update';

        // calculation Analysis start
        $month = Carbon::now()->format('Y-m-01');
        $date = Carbon::now()->format('Y-m-d');
        $year = Carbon::now()->format('Y');
        $analysysDate = calculationAnalysisDaily::where('date', $date)->first();
        $analysysMonth = calculationAnalysisMonthly::where('month', $month)->first();
        $analysysYear = calculationAnalysisYearly::where('year', $year)->first();
        if (is_null($analysysDate)) {
            $analysysDate = new calculationAnalysisDaily;
            $analysysDate->date = $date;
            $daily_method = 'create';

        }
        if (is_null($analysysMonth)) {
            $analysysMonth = new calculationAnalysisMonthly;
            $analysysMonth->month = $month;
            $monthly_method = 'create';

        }
        if (is_null($analysysYear)) {
            $analysysYear = new calculationAnalysisYearly;
            $analysysYear->year = $year;
            $yearly_method = 'create';

        }
        $analysysDate->sell -= $price;
        $analysysMonth->sell -= $price;
        $analysysYear->sell -= $price;
        $analysysDate->sell_profit += $profit;
        $analysysMonth->sell_profit += $profit;
        $analysysYear->sell_profit += $profit;
        $analysysDate->tax -= $tax;
        $analysysMonth->tax -= $tax;
        $analysysYear->tax -= $tax;
        $analysysDate->save();
        $analysysMonth->save();
        $analysysYear->save();
        // calculation Analysis end


        
        $this->onlineSync('calculationAnalysisDaily',$daily_method,$analysysDate->id);
        $this->onlineSync('calculationAnalysisMonthly',$monthly_method,$analysysMonth->id);
        $this->onlineSync('calculationAnalysisYearly',$yearly_method,$analysysYear->id);
      

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
        $productDaily->sell -= $quantity;
        $productDaily->return += $quantity;
        $productDaily->profit += $profit;
        $productMonthly->sell -= $quantity;
        $productMonthly->return += $quantity;
        $productMonthly->profit += $profit;
        $productYearly->sell -= $quantity;
        $productYearly->return += $quantity;
        $productYearly->profit += $profit;
        $productDaily->save();
        $productMonthly->save();
        $productYearly->save();


        
        $this->onlineSync('productAnalysisDaily',$daily_method,$productDaily->id);
        $this->onlineSync('productAnalysisMonthly',$monthly_method,$productMonthly->id);
        $this->onlineSync('productAnalysisYearly',$yearly_method,$productYearly->id);
      

    }
    
    public function sellAnalysis($count , $cost , $amount){

        $daily_method = $monthly_method = $yearly_method = 'update';

        $month = Carbon::now()->format('Y-m-01');
        $date = Carbon::now()->format('Y-m-d');
        $year = Carbon::now()->format('Y');
        $sellDaily= sellAnalysisDaily::where('date',$date)->first();
        $sellMonthly= sellAnalysisMonthly::where('month',$month)->first();
        $sellYearly= sellAnalysisYearly::where('year',$year)->first();
        if(is_null($sellDaily)){
            $sellDaily= new sellAnalysisDaily;
            $sellDaily->date=$date;
            $daily_method = 'create';

        }
        if(is_null($sellMonthly)){
            $sellMonthly= new sellAnalysisMonthly;
            $sellMonthly->month=$month;
            $monthly_method = 'create';

        }
        if(is_null($sellYearly)){
            $sellYearly= new sellAnalysisYearly;
            $sellYearly->year=$year;
            $yearly_method = 'create';

        }
        $sellDaily->cost -= $cost;
        $sellDaily->amount -= $amount;
        $sellDaily->cash_received -= $amount;
        $sellDaily->return += $count;
        $sellDaily->product_count -= $count;	

        $sellMonthly->cost -= $cost;
        $sellMonthly->amount -= $amount;
        $sellMonthly->cash_received -= $amount;
        $sellMonthly->return += $count ;
        $sellMonthly->product_count -= $count;

        $sellYearly->cost -= $cost;
        $sellYearly->amount -= $amount;
        $sellYearly->cash_received -= $amount;
        $sellYearly->return +=  $count;
        $sellYearly->product_count -= $count;

        $sellDaily->save();
        $sellMonthly->save();
        $sellYearly->save();
        
        $this->onlineSync('sellAnalysisDaily',$daily_method,$sellDaily->id);
        $this->onlineSync('sellAnalysisMonthly',$monthly_method,$sellMonthly->id);
        $this->onlineSync('sellAnalysisYearly',$yearly_method,$sellYearly->id);
      
    }

}
