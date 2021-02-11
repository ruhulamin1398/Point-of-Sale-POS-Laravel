<?php

namespace App\Http\Controllers;

use App\Models\calculationAnalysisDaily;
use App\Models\calculationAnalysisMonthly;
use App\Models\calculationAnalysisYearly;
use App\Models\customer;
use App\Models\employeeAnalysisDaily;
use App\Models\employeeAnalysisMonthly;
use App\Models\employeeAnalysisYearly;
use App\Models\order;
use App\Models\orderDetail;
use App\Models\paymentSystem;
use App\Models\Product;
use App\Models\productAnalysisDaily;
use App\Models\productAnalysisMonthly;
use App\Models\productAnalysisYearly;
use App\Models\sellAnalysisDaily;
use App\Models\sellAnalysisMonthly;
use App\Models\sellAnalysisYearly;
use App\Models\setting;
use App\Models\unit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        if(! auth()->user()->hasPermissionTo('Order Page')){
            return abort(401);
        }
        $monthStart = Carbon:: now()->format('Y-m-01 00:00:00');
        $monthEnd = Carbon:: now()->format('Y-m-31 23:59:59');
        if(! is_null($request->month)){
            $monthStart = Carbon:: parse($request->month)->format('Y-m-01 00:00:00');
            $monthEnd = Carbon:: parse($request->month)->format('Y-m-31 23:59:59');
        }
        $month = Carbon:: parse($monthStart)->format('F, Y');
        $roles = Role::all();
        $orders= order::where('created_at','>=',$monthStart)->where('created_at','<=',$monthEnd)->get();
        
        
        $settings = setting::where('table_name', 'orders')->first();
        $settings->setting = json_decode(json_decode($settings->setting, true), true);


        $dataArray = [
            'settings' => $settings,
            'items' => $orders,
            'page_name' => 'Order',
        ];

        return view('product.order.index',compact('dataArray','month','roles'));
    }
  

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         
        if(! auth()->user()->hasPermissionTo('Order Create Page')){
            return abort(401);
        }   
        $roles = Role::all();
        $paymentSystems = paymentSystem::all(); 
        
     
        return view('product.order.create',compact('paymentSystems','roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;
        // validation later
        $order = new order;
        $order->user_id= Auth::user()->id;   //auth must be added here
        $order->customer_id=$request->order['customer_id'];
        $order->payment_system_id= $request->order['payment_system_id'];
        $order->paid_amount= $request->order['paid_amount'];
        $order->tax= $request->order['tax'];
        $order->cost =0;
        $order->pre_due=$request->order['pre_due'];
        $order->due=$request->order['due'];
        $order->discount=$request->order['discount'];
        $order->profit =0;
        $order->total=$request->order['total'];
        
        $order->save();
        $customer = customer::find($order->customer_id);
        $customer->due = $order->due;
        $customer->save();
        
        $cost=0;
        $profit=0;
        $productCount = 0;
       

        foreach($request->order_details as $product){

            $orderDetail = new orderDetail;
            $databaseProduct = Product::find($product['id']);
            $orderDetail->order_id = $order->id;
            $orderDetail->product_id = $product['id'];
            $orderDetail->price = $product['price'];
            $orderDetail->quantity = $product['quantity'] * $databaseProduct->unit->value  ;
            $orderDetail->discount = $product['discount'];
            $orderDetail->tax = $product['tax'];
            $orderDetail->cost = $product['cost'];
            $orderDetail->total = $product['total'];
            $orderDetail->profit = $product['profit'];
            $cost += $product['cost'];
            $profit += $product['profit'];
            $productCount += $orderDetail->quantity;
             $orderDetail->save();
            $databaseProduct->stock -= $orderDetail->quantity;
            if( $databaseProduct->stock <0){
                $databaseProduct->stock =0;
            }
            $databaseProduct->save();

             $this->onlineSync('orderDetail','create',$orderDetail->id);
             $this->onlineSync('Product','update',$databaseProduct->id);

            // product Analysis start
            $this->productAnalysis($orderDetail);
            // product Analysis end

        }

        $order->cost =$cost;
        $order->profit =$profit;
        $order->save();


        $this->onlineSync('order','create',$order->id);
        $this->onlineSync('customer','update',$customer->id);

        


        // calculation Analysis start
        $this->calculationAnalysis($order);
        // calculation Analysis end


        // employee Analysis start
        $this->employeeAnalysis($profit);
        // employee Analysis end

        // sell Analysis start
        $this->sellAnalysis($order,$productCount); //product Count is missing
        // sell Analysis end

        return $order;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(order $order)
    {
        //
    }

    public function sellAnalysis($order,$productCount){

        $daily_method_type = $monthly_method_type = $yearly_method_type = 'update';
      
        $month = Carbon::now()->format('Y-m-01');
        $date = Carbon::now()->format('Y-m-d');
        $year = Carbon::now()->format('Y');
        $sellDaily= sellAnalysisDaily::where('date',$date)->first();
        $sellMonthly= sellAnalysisMonthly::where('month',$month)->first();
        $sellYearly= sellAnalysisYearly::where('year',$year)->first();
        if(is_null($sellDaily)){
            $sellDaily= new sellAnalysisDaily;
            $sellDaily->date=$date;
            $daily_method_type = 'create';
        }
        if(is_null($sellMonthly)){
            $sellMonthly= new sellAnalysisMonthly;
            $sellMonthly->month=$month;
            $monthly_method_type = 'create';
        }
        if(is_null($sellYearly)){
            $sellYearly= new sellAnalysisYearly;
            $sellYearly->year=$year;
            $yearly_method_type = 'create';
        }
        $sellDaily->count += 1;
        $sellDaily->cost += $order->cost;
        $sellDaily->cash_received += $order->paid_amount;
        $sellDaily->discount += $order->discount;
        $sellDaily->amount += $order->total;
        $sellDaily->due += $order->total - $order->paid_amount;
        $sellDaily->product_count += $productCount;

        $sellMonthly->count += 1;
        $sellMonthly->cost += $order->cost;
        $sellMonthly->cash_received +=$order->paid_amount;
        $sellMonthly->discount += $order->discount;
        $sellMonthly->amount += $order->total;
        $sellMonthly->due += $order->total - $order->paid_amount;
        $sellMonthly->product_count += $productCount;

        $sellYearly->count += 1;
        $sellYearly->cost += $order->cost;
        $sellYearly->cash_received += $order->paid_amount;
        $sellYearly->discount += $order->discount;
        $sellYearly->amount += $order->total;
        $sellYearly->due += $order->total - $order->paid_amount;
        $sellYearly->product_count += $productCount;

        $sellDaily->save();
        $sellMonthly->save();
        $sellYearly->save();

        $this->onlineSync('sellAnalysisDaily',$daily_method_type,$sellDaily->id);

        $this->onlineSync('sellAnalysisMonthly',$monthly_method_type,$sellMonthly->id);

        $this->onlineSync('sellAnalysisYearly',$yearly_method_type,$sellYearly->id);

    }
    public function productAnalysis($orderDetail){
        $daily_method_type = $monthly_method_type = $yearly_method_type = 'update';

        $month = Carbon::now()->format('Y-m-01');
        $date = Carbon::now()->format('Y-m-d');
        $year = Carbon::now()->format('Y');
        $productDaily= productAnalysisDaily::where('date',$date)->where('product_id',$orderDetail->product_id )->first();
        $productMonthly= productAnalysisMonthly::where('month',$month)->where('product_id',$orderDetail->product_id)->first();
        $productYearly= productAnalysisYearly::where('year',$year)->where('product_id',$orderDetail->product_id)->first();
        if(is_null($productDaily)){
            $productDaily= new productAnalysisDaily;
            $productDaily->date=$date;
            $productDaily->product_id=$orderDetail->product_id; 
            $daily_method_type = 'create';
        }
        if(is_null($productMonthly)){
            $productMonthly= new productAnalysisMonthly;
            $productMonthly->month=$month;
            $productMonthly->product_id=$orderDetail->product_id;          
            $monthly_method_type = 'create';
        }
        if(is_null($productYearly)){
            $productYearly= new productAnalysisYearly;
            $productYearly->year=$year;
            $productYearly->product_id=$orderDetail->product_id;
            $yearly_method_type = 'create';
        }
        $productDaily->sell += $orderDetail->quantity;
        $productDaily->profit += $orderDetail->profit;
        $productMonthly->sell += $orderDetail->quantity;
        $productMonthly->profit += $orderDetail->profit;
        $productYearly->sell += $orderDetail->quantity;
        $productYearly->profit += $orderDetail->profit;
        $productDaily->save();
        $productMonthly->save();
        $productYearly->save();


        $this->onlineSync('productAnalysisDaily',$daily_method_type,$productDaily->id);

        $this->onlineSync('productAnalysisMonthly',$monthly_method_type,$productMonthly->id);

        $this->onlineSync('productAnalysisYearly',$yearly_method_type,$productYearly->id);



    }
    public function calculationAnalysis($order){

        $daily_method_type = $monthly_method_type = $yearly_method_type = 'update';
        $month = Carbon::now()->format('Y-m-01');
        $date = Carbon::now()->format('Y-m-d');
        $year = Carbon::now()->format('Y');
        $calculationAnalysisDaily= calculationAnalysisDaily::where('date',$date)->first();
        $calculationAnalysisMonthly= calculationAnalysisMonthly::where('month',$month)->first();
        $calculationAnalysisYearly= calculationAnalysisYearly::where('year',$year)->first();
        if(is_null($calculationAnalysisDaily)){
            $calculationAnalysisDaily= new calculationAnalysisDaily;
            $calculationAnalysisDaily->date=$date;
            $daily_method_type = 'create';
        }
        if(is_null($calculationAnalysisMonthly)){
            $calculationAnalysisMonthly= new calculationAnalysisMonthly;
            $calculationAnalysisMonthly->month=$month;
            $monthly_method_type = 'create';
        }
        if(is_null($calculationAnalysisYearly)){
            $calculationAnalysisYearly= new calculationAnalysisYearly;
            $calculationAnalysisYearly->year=$year;
            $yearly_method_type = 'create';
        }
        $calculationAnalysisDaily->sell_profit += $order->profit;
        $calculationAnalysisMonthly->sell_profit += $order->profit;
        $calculationAnalysisYearly->sell_profit += $order->profit;
        $calculationAnalysisDaily->sell += $order->total;
        $calculationAnalysisMonthly->sell += $order->total;
        $calculationAnalysisYearly->sell += $order->total;
        $calculationAnalysisDaily->tax += $order->tax;
        $calculationAnalysisMonthly->tax += $order->tax;
        $calculationAnalysisYearly->tax += $order->tax;
        $calculationAnalysisDaily->save();
        $calculationAnalysisMonthly->save();
        $calculationAnalysisYearly->save();


        $this->onlineSync('calculationAnalysisDaily',$daily_method_type,$calculationAnalysisDaily->id);

        $this->onlineSync('calculationAnalysisMonthly',$monthly_method_type,$calculationAnalysisMonthly->id);

        $this->onlineSync('calculationAnalysisYearly',$yearly_method_type,$calculationAnalysisYearly->id);



    }
    public function employeeAnalysis($profit){

        $daily_method_type = $monthly_method_type = $yearly_method_type = 'update';
        $month = Carbon::now()->format('Y-m-01');
        $date = Carbon::now()->format('Y-m-d');
        $year = Carbon::now()->format('Y');
        $employeeDaily= employeeAnalysisDaily::where('date',$date)->first();
        $employeeMonthly= employeeAnalysisMonthly::where('month',$month)->first();
        $employeeYearly= employeeAnalysisYearly::where('year',$year)->first();
        if(is_null($employeeDaily)){
            $employeeDaily= new employeeAnalysisDaily;
            $employeeDaily->date=$date;
            $daily_method_type = 'create';
        }
        if(is_null($employeeMonthly)){
            $employeeMonthly= new employeeAnalysisMonthly;
            $employeeMonthly->month=$month;
            $monthly_method_type = 'create';
        }
        if(is_null($employeeYearly)){
            $employeeYearly= new employeeAnalysisYearly;
            $employeeYearly->year=$year;
            $yearly_method_type = 'create';
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

        $this->onlineSync('employeeAnalysisDaily',$daily_method_type,$employeeDaily->id);

        $this->onlineSync('employeeAnalysisMonthly',$monthly_method_type,$employeeMonthly->id);

        $this->onlineSync('employeeAnalysisYearly',$yearly_method_type,$employeeYearly->id);

    }
}
