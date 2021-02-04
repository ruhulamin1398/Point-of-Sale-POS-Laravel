<?php

namespace App\Http\Controllers;

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
                "title":"Product List",
                "editTitle":"Edit Product"
            },
            "routes":{
                "create":{
                    "name":"products.store",
                    "link":"products"
                },
                "update":{
                    "name":"products.update",
                    "link":"products"
                },
                "delete":{
                    "name":"products.destroy",
                    "link":"products"
                }
            },
            "fieldList":[{
                    
                "position":111,
    
                "create":"0",
                "read":"1",
                "update":"0",
                "require":"0",
    
               "input_type":"text",
               "name":"id",
               "title":"Id",
    
    
               "database_name":"id"
            },{
                    
                "position":111,
    
                "create":"3",
                "read":"1",
                "update":"3",
                "require":"1",
    
               "input_type":"text",
               "name":"name",
               "title":"Name",
               "database_name":"name"
            },{
                    
                "position":111,
    
                "create":"3",
                "read":"1",
                "update":"3",
                "require":"0",
    
               "input_type":"text",
               "name":"category",
               "title":"Category",
               "database_name":"category_id"
            },{
                    
                "position":111,
    
                "create":"3",
                "read":"1",
                "update":"3",
                "require":"0",
    
               "input_type":"text",
               "name":"brand",
               "title":"Brand",
               "database_name":"brand_id"
            },{
                    
                "position":111,
    
                "create":"3",
                "read":"1",
                "update":"3",
                "require":"0",
    
               "input_type":"text",
               "name":"cost",
               "title":"Cost",
               "database_name":"cost"
            },{
                    
                "position":111,
    
                "create":"3",
                "read":"1",
                "update":"3",
                "require":"0",
    
               "input_type":"text",
               "name":"price",
               "title":"Price",
               "database_name":"price"
            },{
                    
                "position":111,
    
                "create":"3",
                "read":"1",
                "update":"3",
                "require":"0",
    
               "input_type":"text",
               "name":"real_stock",
               "title":"Stock",
               "database_name":"stock"
            },{
                    
                "position":111,
    
                "create":"3",
                "read":"1",
                "update":"3",
                "require":"0",
    
               "input_type":"text",
               "name":"tax_with_type",
               "title":"Tax",
               "database_name":"tax"
            },{
                    
                "position":111,
    
                "create":"3",
                "read":"1",
                "update":"3",
                "require":"0",
    
               "input_type":"text",
               "name":"warrenty",
               "title":"Warrenty",
               "database_name":"warrenty_id"
            }
            ]
        }]' ;

        // $a= [
        //     "1" =>[
        //          "Super Admin"=> 1, 
        //          "Admin"=> 1, 
        //          "Manager"=> 1, 
        //          "Cashier"=> 1, 
        //          "Staff"=> 1, 
        //      ],
        //      "2" =>[
        //           "Super Admin"=> 1, 
        //           "Admin"=> 1, 
        //           "Manager"=> 1, 
        //           "Cashier"=> 1, 
        //           "Staff"=> 1, 
        //       ],
        // ];
        
        
        // $setting = new setting;
        // $setting->setting = json_encode( $a);
        // $setting->table_name = 'products';
        // $setting->model = 'App\Models\Product';
        // $setting->save();
        // return  "Success";
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
