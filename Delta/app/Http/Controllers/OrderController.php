<?php

namespace App\Http\Controllers;

use App\Models\calculationAnalysisDaily;
use App\Models\calculationAnalysisMonthly;
use App\Models\calculationAnalysisYearly;
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
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('order.index');
    }
  

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
            
        $paymentSystems = paymentSystem::all();
       
        return view('product.order.create',compact('paymentSystems'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $month = Carbon::now()->format('Y-m-01');
        $date = Carbon::now()->format('Y-m-d');
        $year = Carbon::now()->format('Y');
        // return $request;
        // validation later
        $order = new order;
        $order->user_id= 1;   //auth must be added here
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
        // return $order;
        $employee_id =$order->user->employee->id;
        $cost=0;
        $profit=0;
        $tax = 0;
       

        foreach($request->order_details as $product){

            $orderDetail = new orderDetail;
            $orderDetail->order_id = $order->id;
            $orderDetail->product_id = $product['id'];
            $orderDetail->price = $product['price'];
            $orderDetail->quantity = $product['quantity'];
            $orderDetail->discount = $product['discount'];
            // $orderDetail->tax = $product['tax'];
            $orderDetail->cost = $product['cost'];
            $orderDetail->total = $product['total'];
            $orderDetail->profit = $product['profit'];

            $cost += $product['cost'];
            $profit += $product['profit'];
            $tax += $product['tax'];
             $orderDetail->save();


            // product Analysis start
            $productDaily= productAnalysisDaily::where('date',$date)->where('product_id',$orderDetail->product_id )->first();
            $productMonthly= productAnalysisMonthly::where('month',$month)->where('product_id',$orderDetail->product_id)->first();
            $productYearly= productAnalysisYearly::where('year',$year)->where('product_id',$orderDetail->product_id)->first();
            if(is_null($productDaily)){
                $productDaily= new productAnalysisDaily;
                $productDaily->date=$date;
                $productDaily->product_id=$orderDetail->product_id;
            }
            if(is_null($productMonthly)){
                $productMonthly= new productAnalysisMonthly;
                $productMonthly->month=$month;
                $productMonthly->product_id=$orderDetail->product_id;
            }
            if(is_null($productYearly)){
                $productYearly= new productAnalysisYearly;
                $productYearly->year=$year;
                $productYearly->product_id=$orderDetail->product_id;
            }
            $productDaily->sell += 1;
            $productDaily->profit += $orderDetail->profit;
            $productMonthly->sell += 1;
            $productMonthly->profit += $orderDetail->profit;
            $productYearly->sell += 1;
            $productYearly->profit += $orderDetail->profit;
            $productDaily->save();
            $productMonthly->save();
            $productYearly->save();
            // product Analysis end



        }


        // calculation Analysis start
        $calculationAnalysisDaily= calculationAnalysisDaily::where('date',$date)->first();
        $calculationAnalysisMonthly= calculationAnalysisMonthly::where('month',$month)->first();
        $calculationAnalysisYearly= calculationAnalysisYearly::where('year',$year)->first();
        if(is_null($calculationAnalysisDaily)){
            $calculationAnalysisDaily= new calculationAnalysisDaily;
            $calculationAnalysisDaily->date=$date;
        }
        if(is_null($calculationAnalysisMonthly)){
            $calculationAnalysisMonthly= new calculationAnalysisMonthly;
            $calculationAnalysisMonthly->month=$month;
        }
        if(is_null($calculationAnalysisYearly)){
            $calculationAnalysisYearly= new calculationAnalysisYearly;
            $calculationAnalysisYearly->year=$year;
        }
        $calculationAnalysisDaily->sell_profit += $profit;
        $calculationAnalysisMonthly->sell_profit += $profit;
        $calculationAnalysisYearly->sell_profit += $profit;
        $calculationAnalysisDaily->sell += $orderDetail->total;
        $calculationAnalysisMonthly->sell += $orderDetail->total;
        $calculationAnalysisYearly->sell += $orderDetail->total;
        $calculationAnalysisDaily->save();
        $calculationAnalysisMonthly->save();
        $calculationAnalysisYearly->save();
        // calculation Analysis end


        // employee Analysis start
        $employeeDaily= employeeAnalysisDaily::where('date',$date)->first();
        $employeeMonthly= employeeAnalysisMonthly::where('month',$month)->first();
        $employeeYearly= employeeAnalysisYearly::where('year',$year)->first();
        if(is_null($employeeDaily)){
            $employeeDaily= new employeeAnalysisDaily;
            $employeeDaily->date=$date;
        }
        if(is_null($employeeMonthly)){
            $employeeMonthly= new employeeAnalysisMonthly;
            $employeeMonthly->month=$month;
        }
        if(is_null($employeeYearly)){
            $employeeYearly= new employeeAnalysisYearly;
            $employeeYearly->year=$year;
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
        // employee Analysis end

        // sell Analysis start
        $sellDaily= sellAnalysisDaily::where('date',$date)->first();
        $sellMonthly= sellAnalysisMonthly::where('month',$month)->first();
        $sellYearly= sellAnalysisYearly::where('year',$year)->first();
        if(is_null($sellDaily)){
            $sellDaily= new sellAnalysisDaily;
            $sellDaily->date=$date;
        }
        if(is_null($sellMonthly)){
            $sellMonthly= new sellAnalysisMonthly;
            $sellMonthly->month=$month;
        }
        if(is_null($sellYearly)){
            $sellYearly= new sellAnalysisYearly;
            $sellYearly->year=$year;
        }
        $sellDaily->count += 1;
        $sellDaily->cost += $orderDetail->cost;
        $sellDaily->cash_recieved += $order->paid_amount;
        $sellDaily->discount += $orderDetail->discount;
        $sellDaily->amount += $orderDetail->total;
        $sellDaily->due += $orderDetail->total - $order->paid_amount;
        $sellMonthly->count += 1;
        $sellMonthly->cost += $orderDetail->cost;
        $sellMonthly->cash_recieved +=$order->paid_amount;
        $sellMonthly->discount += $orderDetail->discount;
        $sellMonthly->amount += $orderDetail->total;
        $sellMonthly->due += $orderDetail->total - $order->paid_amount;
        $sellYearly->count += 1;
        $sellYearly->cost += $orderDetail->cost;
        $sellYearly->cash_recieved += $order->paid_amount;
        $sellYearly->discount += $orderDetail->discount;
        $sellYearly->amount += $orderDetail->total;
        $sellYearly->due += $orderDetail->total - $order->paid_amount;
        $sellDaily->save();
        $sellMonthly->save();
        $sellYearly->save();
        // sell Analysis end



        $order->cost =$cost;
        $order->profit =$profit;
        $order->save();
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
}
