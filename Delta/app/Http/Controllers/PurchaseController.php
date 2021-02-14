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
use App\Models\purchaseDetail;
use App\Models\setting;
use App\Models\supplier;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        
        $purchase = new purchase;
        $purchase->user_id= Auth::user()->id;  
        $purchase->supplier_id=$request->purchase['supplier_id'];
        $purchase->payment_system_id= $request->purchase['payment_system_id'];
        $purchase->paid_amount= $request->purchase['paid_amount'];
        $purchase->pre_due=$request->purchase['pre_due'];
        $purchase->discount=$request->purchase['discount'];
        $purchase->total=$request->purchase['total'];
        
        $purchase->save();

        $this->onlineSync('purchase','create',$purchase->id);

        if( auth()->user()->hasPermissionTo('Allow Supplier Due')){
            
            $purchase->due=$request->purchase['due'];
            $supplier = $purchase->supplier;
            $supplier->due = $purchase->due;
            $supplier->save();
            
            $this->onlineSync('supplier','update',$supplier->id);
        }
        else{
            $purchase->discount += $request->purchase['due'];
            $purchase->due=0;
        }

        $productCount = 0;
       

        foreach($request->purchase_details as $product){

            $purchaseDetail = new purchaseDetail;
            $databaseProduct = Product::find($product['id']);
            $purchaseDetail->purchase_id = $purchase->id;
            $purchaseDetail->product_id = $product['id'];
            $purchaseDetail->price = $product['price']  / $databaseProduct->unit->value ;
            $purchaseDetail->quantity = $product['quantity'] * $databaseProduct->unit->value  ;
            $purchaseDetail->discount = $product['discount'];
            $purchaseDetail->total = $product['total'];
            $productCount += $purchaseDetail->quantity;
            $purchaseDetail->save();


            $totalCost = $databaseProduct->cost_per_unit * $databaseProduct->stock + $purchaseDetail->price * $purchaseDetail->quantity ;
            $databaseProduct->stock += $purchaseDetail->quantity;
            $databaseProduct->cost_per_unit = $totalCost / $databaseProduct->stock;
            $databaseProduct->save();

             $this->onlineSync('purchaseDetail','create',$purchaseDetail->id);
             $this->onlineSync('Product','update',$databaseProduct->id);

            // product Analysis start
            $this->productAnalysis($purchaseDetail);
            // product Analysis end

        }

        $purchase->save();


        


        // calculation Analysis start
        $this->calculationAnalysis($purchase);
        // calculation Analysis end


        // purchase Analysis start
        $this->purchaseAnalysis($purchase,$productCount);
        // purchase Analysis end

        return $purchase;




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


    
    public function purchaseAnalysis($purchase,$productCount){
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

        
        $total = $purchase->total + $purchase->due;
        $received_amount = $purchase->cash_received;
        $received_amount = $total >= $received_amount ? $received_amount : $total;



        $purchaseDaily->count += 1;
        $purchaseDaily->product_count += $productCount;
        $purchaseDaily->cost += $purchase->total;
        $purchaseDaily->amount += $purchase->total;
        $purchaseDaily->cash_given += $received_amount ;
        $purchaseDaily->discount += $purchase->discount;
        $purchaseDaily->due += $purchase->due - $purchase->pre_due;

        $purchaseMonthly->count += 1;
        $purchaseMonthly->product_count += $productCount;
        $purchaseMonthly->cost += $purchase->total;
        $purchaseMonthly->cash_given += $received_amount;
        $purchaseMonthly->discount += $purchase->discount;
        $purchaseMonthly->due += $purchase->due - $purchase->pre_due;

        $purchaseYearly->count += 1;
        $purchaseYearly->product_count += $productCount;
        $purchaseYearly->cost += $purchase->total;
        $purchaseYearly->cash_given += $received_amount;
        $purchaseYearly->discount += $purchase->discount;
        $purchaseYearly->due += $purchase->due - $purchase->pre_due;

        $purchaseDaily->save();
        $purchaseMonthly->save();
        $purchaseYearly->save();


        $this->onlineSync('purchaseAnalysisDaily',$daily_method,$purchaseDaily->id);
        $this->onlineSync('purchaseAnalysisMonthly',$monthly_method,$purchaseMonthly->id);
        $this->onlineSync('purchaseAnalysisYearly',$yearly_method,$purchaseYearly->id);
      



    }
    public function productAnalysis($purchaseDetail){

        $daily_method = $monthly_method = $yearly_method = 'update';


        $month = Carbon::now()->format('Y-m-01');
        $date = Carbon::now()->format('Y-m-d');
        $year = Carbon::now()->format('Y');
        $productDaily= productAnalysisDaily::where('date',$date)->where('product_id',$purchaseDetail-> product_id)->first();
        $productMonthly= productAnalysisMonthly::where('month',$month)->where('product_id',$purchaseDetail->product_id)->first();
        $productYearly= productAnalysisYearly::where('year',$year)->where('product_id',$purchaseDetail->product_id)->first();
        if(is_null($productDaily)){
            $productDaily= new productAnalysisDaily;
            $productDaily->date=$date;
            $productDaily->product_id=$purchaseDetail->product_id;
            $daily_method = 'create';
        }
        if(is_null($productMonthly)){
            $productMonthly= new productAnalysisMonthly;
            $productMonthly->month=$month;
            $productMonthly->product_id=$purchaseDetail->product_id;
            $monthly_method = 'create';

        }
        if(is_null($productYearly)){
            $productYearly= new productAnalysisYearly;
            $productYearly->year=$year;
            $productYearly->product_id=$purchaseDetail->product_id;
            $yearly_method = 'create';
        }
        $productDaily->sell += $purchaseDetail->quantity;
        $productMonthly->sell += $purchaseDetail->quantity;
        $productYearly->sell += $purchaseDetail->quantity;
        $productDaily->save();
        $productMonthly->save();
        $productYearly->save();

        $this->onlineSync('productAnalysisDaily',$daily_method,$productDaily->id);
        $this->onlineSync('productAnalysisMonthly',$monthly_method,$productMonthly->id);
        $this->onlineSync('productAnalysisYearly',$yearly_method,$productYearly->id);
      

    }
    public function calculationAnalysis($purchase){

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
        
        $calculationAnalysisDaily->buy += $purchase->total;
        $calculationAnalysisMonthly->buy += $purchase->total;
        $calculationAnalysisYearly->buy += $purchase->total;
        $calculationAnalysisDaily->save();
        $calculationAnalysisMonthly->save();
        $calculationAnalysisYearly->save();



        $this->onlineSync('calculationAnalysisDaily',$daily_method,$calculationAnalysisDaily->id);
        $this->onlineSync('calculationAnalysisMonthly',$monthly_method,$calculationAnalysisMonthly->id);
        $this->onlineSync('calculationAnalysisYearly',$yearly_method,$calculationAnalysisYearly->id);
      


    }
}
