<?php

namespace App\Http\Controllers;

use App\Models\image;
use App\Models\posSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Redirect;
use Spatie\Permission\Models\Role;

class PosSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        if(! auth()->user()->hasPermissionTo('Pos Setting Page')){
            return abort(401);
        }

        $roles = Role::all();
        $settings = posSetting::find(1);
        return view('pos-setting.index',compact('settings','roles'));
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
     * @param  \App\Models\posSetting  $posSetting
     * @return \Illuminate\Http\Response
     */
    public function show(posSetting $posSetting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\posSetting  $posSetting
     * @return \Illuminate\Http\Response
     */
    public function edit(posSetting $posSetting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\posSetting  $posSetting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
 
        
        $posSetting =  posSetting::find(1);


        


        $posSetting->shop_name = $request->shop_name;
        $posSetting->shop_moto = $request->shop_moto;
        $posSetting->shop_phone = $request->shop_phone;
        $posSetting->shop_email = $request->shop_email;

 

        $posSetting->language = $request->language;
        $posSetting->customer_due = $request->customer_due;
        $posSetting->supplier_due = $request->supplier_due;
    



        if(!is_null($request->logo)){
             
            $image_path = public_path('image/').$posSetting->logo;
            unlink($image_path);
             $imageDimension = getimagesize($request->logo);
             if($imageDimension[0] <= 1360 && $imageDimension[1] <= 424) {

                $logoFileName = time() . $request->logo->getClientOriginalName();
                request()->logo->move(public_path('image'), $logoFileName);
                $posSetting->logo = 'image/'. $logoFileName;
             }else{
                return Redirect::back()->withErrors(["Image Dimension Must Be lower Then 1360 X 424"]);
             }
           

        }

        $posSetting->save();
        
        App::setLocale($posSetting->language);
        $this->onlineSync('posSetting','update',$posSetting->id);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\posSetting  $posSetting
     * @return \Illuminate\Http\Response
     */
    public function destroy(posSetting $posSetting)
    {
        //
    }
}
