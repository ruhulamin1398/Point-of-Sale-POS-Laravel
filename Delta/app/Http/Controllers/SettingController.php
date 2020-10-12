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
        "title":"Suppliers List",
        "editTitle":"Edit Supplier"
    },
    "routes":{
        "create":{
            "name":"suppliers.create",
            "link":"suppliers"
        },
        "update":{
            "name":"suppliers.update",
            "link":"suppliers"
        },
        "delete":{
            "name":"suppliers.destroy",
            "link":"suppliers"
        }
    },
    "fieldList":[{
        
            "position":11,

            "create":"2",
            "read":"1",
            "update":"1",
            "require":"1",

            "name":"name",
            "input_type" : "text",
            "database_name":"name",  
            "title":"Name"
        },{
            
            "position":111,

            "create":"2",
            "read":"1",
            "update":"1",
            "require":"1",

           "input_type":"text",
           "name":"phone",
           "title":"Phone",


           "database_name":"phone"
        },{
            
            "position":1,

            "create":"1",
            "read":"1",
            "update":"1",
            "require":"0",

           "input_type":"text",
           "name":"address",
           "database_name":"address",
           "title": "Address"
        },{
            
            "position":1,

            "create":"1",
            "read":"1",
            "update":"1",
            "require":"0",

           "input_type":"text",
           "name":"company",
           "database_name":"company",
           "title": "Company"
        },{
            
            "position":12,

            "create":"3",
            "read":"1",
            "update":"3",
            "require":"0",

           "input_type":"number",
           "name":"due",
           "database_name":"due",
           "title": "Due"
        }
    ]
}]' ;

        // $setting =  setting::find(12);
        // $setting->setting = json_encode( $a);
        // $setting->table_name = 'suppliers';
        // $setting->model = 'App\Models\supplier.php';
        // $setting->save();
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
