<?php

namespace App\Http\Controllers;

use App\Models\setting;
use App\Models\warrenty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class WarrentyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {     

        $settings = setting::where('table_name','warrenties')->first();
        $settings->setting= json_decode(  json_decode(  $settings->setting,true),true);
        
                
                $dataArray=[
                    'settings'=>$settings,
                    'items' => warrenty::all(),
                ];
        
        
                return view('product.warrenty.index', compact('dataArray'));
        
        
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
        $warrenty = new warrenty;
        $warrenty->name = $request->name;
        $warrenty->total_days = $request->total_days;
        $warrenty->save();
        
        $this->onlineSync('warrenty','create',$warrenty->id);
        return redirect()->back()->withSuccess(['Successfully Created']);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\warrenty  $warrenty
     * @return \Illuminate\Http\Response
     */
    public function show(warrenty $warrenty)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\warrenty  $warrenty
     * @return \Illuminate\Http\Response
     */
    public function edit(warrenty $warrenty)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\warrenty  $warrenty
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, warrenty $warrenty)
    {
        if($warrenty->id==1){
            return Redirect::back()->withErrors(["This Warrenty Can't be Edited" ]);
        }
        $warrenty->name = $request->name;
        $warrenty->total_days = $request->total_days;
        $warrenty->save();
        $this->onlineSync('warrenty','update',$warrenty->id);
        return redirect()->back()->withSuccess(['Successfully Updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\warrenty  $warrenty
     * @return \Illuminate\Http\Response
     */
    public function destroy(warrenty $warrenty)
    {
        if($warrenty->id==1){
            return Redirect::back()->withErrors(["This Warrenty Can't be Deleted" ]);
        }
        
        $warrenty->delete();
        $this->onlineSync('warrenty','delete',$warrenty->id);
        return Redirect::back()->withErrors(["Warrenty Deleted" ]);
    }
}
