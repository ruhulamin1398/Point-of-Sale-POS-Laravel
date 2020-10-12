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
                "title":"Designation List",
                "editTitle":"Edit Designation"
            },
            "routes":{
                "create":{
                    "name":"drop_products.create",
                    "link":"drop_products"
                },
                "update":{
                    "name":"drop_products.update",
                    "link":"drop_products"
                },
                "delete":{
                    "name":"drop_products.destroy",
                    "link":"drop_products"
                }
            },
            "fieldList":[{
                
                "position":11,
    
                "create":"3",
                "read":"1",
                "update":"3",
                "require":"0",
    
                "name":"user",
                "input_type" : "text",
                "database_name":"user_id",  
                "title":"Employee Name"
             },{
                
                "position":11,
    
                "create":"2",
                "read":"1",
                "update":"2",
                "require":"1",
    
                "name":"products",
                "input_type" : "dropDown",
                "database_name":"product_id",  
                "title":"Product",
                "data" : "products"
            },{
                
                "position":11,
    
                "create":"2",
                "read":"1",
                "update":"2",
                "require":"1",
    
                "name":"quantity",
                "input_type" : "text",
                "database_name":"quantity",  
                "title":"Quantity"
            },{
                
                "position":11,
    
                "create":"1",
                "read":"1",
                "update":"1",
                "require":"0",
    
                "name":"comment",
                "input_type" : "text",
                "database_name":"comment",  
                "title":"Comment"
            }
            ]
        }]' ;

           

        //  $setting = new setting; 
        $setting->setting = json_encode( $a);
        $setting->table_name = 'drop_products';
        $setting->model = 'App\Models\dropProduct.php';
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
         
    
       $data=  json_decode( json_decode($setting->setting,true),true);
       $fieldList = $data[0]['fieldList'];
 
       for($i=0 ; $i<count($fieldList) ; $i++){
           $fieldName= $fieldList[$i]['name'];
           
         $fieldList[$i]['create'] = $request[$fieldName]['create']; 
         $fieldList[$i]['read'] = $request[$fieldName]['read']; 
         $fieldList[$i]['update'] = $request[$fieldName]['update']; 
         $fieldList[$i]['position'] = $request[$fieldName]['position']; 
           
         
       }
       
   usort($fieldList, function($a, $b)
   {
       if ($a['position'] == $b['position']) {
           return 0;
       }
       return ($a['position'] < $b['position']) ? -1 : 1;
   });

       $data[0]['fieldList'] = $fieldList;
       $setting->setting = json_encode(json_encode($data));
       $setting->save();
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
