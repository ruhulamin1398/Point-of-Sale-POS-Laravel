<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReturnProductRequest;
use App\Models\calculationAnalysisDaily;
use App\Models\calculationAnalysisMonthly;
use App\Models\calculationAnalysisYearly;
use App\Models\customer;
use App\Models\Product;
use App\Models\productAnalysisDaily;
use App\Models\productAnalysisMonthly;
use App\Models\productAnalysisYearly;
use App\Models\returnProduct;
use App\Models\sellAnalysisDaily;
use App\Models\sellAnalysisMonthly;
use App\Models\sellAnalysisYearly;
use App\Models\setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ReturnProductController extends Controller
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
        $settings = setting::where('table_name', 'return_products')->first();
        $settings->setting = json_decode(json_decode($settings->setting, true), true);
        $returnProducts =  returnProduct::where('created_at','>=',$monthStart)->where('created_at','<=',$monthEnd)->get();
        $products = Product::all();
        $dataArray = [
            'settings' => $settings,
            'items' =>$returnProducts,
            'products' =>$products,
            'customers' => customer::all(),
        ];


        return view('product.return-product.index', compact('dataArray'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.return-product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReturnProductRequest $request)
    {
        $product = Product::find($request->product_id);
        $returnProduct = new returnProduct;
        $returnProduct->user_id = 1; //auth must be added
        $returnProduct->product_id = $request->product_id;
        $returnProduct->customer_id = $request->customer_id;
        $returnProduct->quantity = $request->quantity;
        $returnProduct->price = $request->price;
        $returnProduct->profit = $product->cost_per_unit* $request->quantity - $request->price;
        $product->stock += $request->quantity;
        $returnProduct->save();
        $product->save();


 
        $this->onlineSync('returnProduct','create',$returnProduct->id);
        $this->onlineSync('Product','update',$product->id);
      
    

        // calculation analysis start
        $this->calculationAnalysis($returnProduct->profit);
        // calculation analysis end
        // product analysis start
        $this->productAnalysis($returnProduct->profit,$returnProduct->product_id,$returnProduct->quantity);
        // product analysis end
        // sell analysis start
        $this->sellAnalysis($returnProduct->quantity , $product->cost_per_unit* $request->quantity , $returnProduct->price);
        // sell analysis end
        return redirect()->back()->withSuccess(['Successfully Created']);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\returnProduct  $returnProduct
     * @return \Illuminate\Http\Response
     */
    public function show(returnProduct $returnProduct)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\returnProduct  $returnProduct
     * @return \Illuminate\Http\Response
     */
    public function edit(returnProduct $returnProduct)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\returnProduct  $returnProduct
     * @return \Illuminate\Http\Response
     */
    public function update(ReturnProductRequest $request, returnProduct $returnProduct)
    {
        
        $returnProduct->update($request->all());
        
         $this->onlineSync('returnProduct','update',$returnProduct->id);
        return redirect()->back()->withSuccess(['Successfully Updated']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\returnProduct  $returnProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy(returnProduct $returnProduct)
    {
       
        $returnProduct->delete();
        $this->onlineSync('returnProduct','delete',$returnProduct->id);
        return Redirect::back()->withErrors(["Item Deleted" ]);


    }

    public function calculationAnalysis($amount)
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
        $analysysDate->sell_profit += $amount;
        $analysysMonth->sell_profit += $amount;
        $analysysYear->sell_profit += $amount;
        $analysysDate->save();
        $analysysMonth->save();
        $analysysYear->save();
        // calculation Analysis end



        $this->onlineSync('calculationAnalysisDaily',$daily_method,$analysysDate->id);
        $this->onlineSync('employeeAnalysisMonthly',$monthly_method,$analysysMonth->id);
        $this->onlineSync('employeeAnalysisYearly',$yearly_method,$analysysYear->id);
      


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

        $sellMonthly->cost -= $cost;
        $sellMonthly->amount -= $amount;
        $sellMonthly->cash_received -= $amount;
        $sellMonthly->return += $count ;

        $sellYearly->cost -= $cost;
        $sellYearly->amount -= $amount;
        $sellYearly->cash_received -= $amount;
        $sellYearly->return +=  $count;

        $sellDaily->save();
        $sellMonthly->save();
        $sellYearly->save();



        $this->onlineSync('sellAnalysisDaily',$daily_method,$sellDaily->id);
        $this->onlineSync('sellAnalysisMonthly',$monthly_method,$sellMonthly->id);
        $this->onlineSync('sellAnalysisYearly',$yearly_method,$sellYearly->id);
      



    }
}
