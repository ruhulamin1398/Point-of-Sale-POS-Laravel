<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\setting;
use App\Models\stockAlert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Spatie\Permission\Models\Role;

class StockAlertController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {



        if (!auth()->user()->hasPermissionTo('Stock Alert Page')) {
            return abort(401);
        }

        $roles = Role::all();
        $settings = setting::where('table_name', 'stock_alert')->first();
        $settings->setting = json_decode(json_decode($settings->setting, true), true);
        

        $stockAlerts = stockAlert::where('status','!=','hidden')->orderBy('status','desc')->get();
        
        $dataArray = [
            'settings' => $settings,
            'items' => $stockAlerts,
            'page_name' => 'Stock Alert',
        ];
        return view('product.stock-alert.index', compact('dataArray','roles'));
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
     * @param  \App\Models\stockAlert  $stockAlert
     * @return \Illuminate\Http\Response
     */
    public function show(stockAlert $stockAlert)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\stockAlert  $stockAlert
     * @return \Illuminate\Http\Response
     */
    public function edit(stockAlert $stockAlert)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\stockAlert  $stockAlert
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, stockAlert $stockAlert)
    {
        $stockAlert->product_count = $request->product_count;
        if($request->status == 'on'){
            $stockAlert->status = 'scheduled';
        }
        else{
            $stockAlert->status = 'none';
        }
        $stockAlert->save();
        
        $this->onlineSync('stockAlert','update',$stockAlert->id);
        
        return Redirect::back()->withSuccess(["Product Updated"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\stockAlert  $stockAlert
     * @return \Illuminate\Http\Response
     */
    public function destroy(stockAlert $stockAlert)
    {
        $stockAlert->product_count = 0;
        $stockAlert->status = 'hidden';
        $stockAlert->save();

        
        $this->onlineSync('stockAlert','update',$stockAlert->id);
        
        return Redirect::back()->withErrors(["Product Hidden"]);
    }
}
