<?php

namespace App\Http\Controllers;

use App\Models\customer;
use App\Models\goal;
use App\Models\order;
use App\Models\Product;
use App\Models\sellAnalysisDaily;
use App\Models\sellAnalysisMonthly;
use App\Models\sellAnalysisYearly;
use App\Models\supplier;
use Carbon\Carbon;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $customers = customer::count();
        $suppliers = supplier::count();
        $orders = order::count();
        $products = Product::where('stock','>',0)->count();


        $today = now()->format('Y-m-d');
        $week_last = Carbon::now()->addDays(7)->format('Y-m-d');
        $month = now()->format('Y-m-1');
        $Year = now()->format('Y');
        $daily = 0;
        $weekly = 0;
        $monthly = 0;
        $yearly = 0;

        $dailysell = sellAnalysisDaily::where('date',$today)->first();
        $weeklysells = sellAnalysisDaily::where('date','>=',$today)->where('date','<=',$week_last)->get();
        $monthlysell = sellAnalysisMonthly::where('month',$month)->first();
        $yearlysell = sellAnalysisYearly::where('Year',$Year)->first();


        
        if(!is_null($dailysell)){
            $daily = $dailysell->count;
        }
        if(!is_null($monthlysell)){
            $monthly = $monthlysell->count;
        }
        if(!is_null($yearlysell)){
            $yearly = $yearlysell->count;
        }
        foreach($weeklysells as $weeklysell){
            $weekly+= $weeklysell->count;
        }



        $goal = goal::find(1);
        $goal->daily = $daily  / $goal->daily   *100;
        $goal->weekly = $weekly / $goal->weekly   *100;
        $goal->monthly = $monthly  /  $goal->monthly  *100;
        $goal->yearly =  $yearly / $goal->yearly   *100;
       

        return view('index',compact('customers','suppliers','orders','products','goal'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
