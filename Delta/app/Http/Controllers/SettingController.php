<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $a = '[{
            "componentDetails":{
                "title":"Monthly",
                "editTitle":"change status "
            },
            "routes":{
                "create":{
                    "name":"duties.store",
                    "link":"duties"
                },
                "update":{
                    "name":"duties.update",
                    "link":"duties"
                },
                "delete":{
                    "name":"duties.destroy",
                    "link":"duties"
                }
            },
            "fieldList":[{
                    
                "position":111,
    
                "create":"0",
                "read":"1",
                "update":"0",
                "require":"0",
    
               "input_type":"date",
               "name":"day",
               "title":"day",
               "database_name":"day"
            },{
                    
                "position":111,
    
                "create":"0",
                "read":"1",
                "update":"0",
                "require":"0",
    
               "input_type":"select",
               "name":"status",
               "title":"Status",
               "database_name":"status_id"
            },{
                    
                "position":111,
    
                "create":"0",
                "read":"1",
                "update":"0",
                "require":"0",
    
               "input_type":"text",
               "name":"comment",
               "title":"comment",
               "database_name":"comment"
            }
            ]
        }]' ;

        // $a= [
        //     "1" =>[ 
        //          "Admin"=> 1, 
        //          "Manager"=> 1, 
        //          "Analyser"=> 1, 
        //          "Staff"=> 1, 
        //      ],
        // ];
         
            // $a = [
            //     "brand_id" => 1,
            //     "category_id" => 1,
            //     "type_id" => 1,
            //     "unit_id" => 2,
            //     "is_fixed_price" => 1,
            //     "stock_alert" => 1 ,
            //     "warrenty_id" => 1,
            //     "tax_type_id" => 1,
            //     "tax" => 0,
            //     "stock_controll" =>"yes"
            // ];
        $setting = new setting;
        $setting->setting = json_encode( $a);
        $setting->table_name = 'duties';
        $setting->model = 'App\Models\duty';
        $setting->save();
        return  "Success";
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show(setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, setting $setting)
    {
       
        // echo "--------------";
       if($setting['table_name'] == 'products_create'){
        $data = [
            "brand_id" => $request->brand_id,
            "category_id" => $request->category_id,
            "type_id" => $request->type_id,
            "unit_id" => $request->unit_id,
            "is_fixed_price" => $request->is_fixed_price,
            "stock_alert" => $request->stock_alert,
            "warrenty_id" => $request->warrenty_id,
            "tax_type_id" => $request->tax_type_id,
            "tax" => $request->tax,
            "stock_controll" => $request->stock_controll,
        ];

        $setting->setting = (json_encode($data));
        $setting->save();
        $this->onlineSync('setting','update',$setting->id);
        return redirect()->back()->withSuccess('Succesfully Updated');

       }
       elseif($setting['table_name'] == 'categorized_products'){
           $categories = category::all();
           $data = array();
            foreach($categories as $category ){
                $data[$category->id] = $request[$category->id];
            }
            $setting->setting = (json_encode($data));
            $setting->save();
            $this->onlineSync('setting','update',$setting->id);
            return ;
       }
       else{

      
        $data =  json_decode(json_decode($setting->setting, true), true);
        $fieldList = $data[0]['fieldList'];

        for ($i = 0; $i < count($fieldList); $i++) {
            $fieldName = $fieldList[$i]['name'];

            $fieldList[$i]['create'] = $request[$fieldName]['create'];
            $fieldList[$i]['read'] = $request[$fieldName]['read'];
            $fieldList[$i]['update'] = $request[$fieldName]['update'];
            $fieldList[$i]['position'] = $request[$fieldName]['position'];
        }

        usort($fieldList, function ($a, $b) {
            if ($a['position'] == $b['position']) {
                return 0;
            }
            return ($a['position'] < $b['position']) ? -1 : 1;
        });

        $data[0]['fieldList'] = $fieldList;
        $setting->setting = json_encode(json_encode($data));
        $setting->save();

        $this->onlineSync('setting','update',$setting->id);

        return;
        return $setting->setting;
    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(setting $setting)
    {
        //
    }
}
