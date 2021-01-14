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
                "title":"Unit List",
                "editTitle":"Edit Unit"
            },
            "routes":{
                "create":{
                    "name":"units.store",
                    "link":"units"
                },
                "update":{
                    "name":"units.update",
                    "link":"units"
                },
                "delete":{
                    "name":"units.destroy",
                    "link":"units"
                }
            },
            "fieldList":[{
                    
                "position":111,
    
                "create":"2",
                "read":"1",
                "update":"2",
                "require":"1",
    
               "input_type":"text",
               "name":"name",
               "title":"Name",
    
    
               "database_name":"name"
            },{
            
                "position":3,
    
                "create":"2",
                "read":"1",
                "update":"2",
                "require":"1",
    
               "input_type":"dropDown",
               "name":"product_type",
               "database_name":"product_type_id",
               "title": "Type",
               "data" : "product_types"
            },{
                    
                "position":111,
    
                "create":"2",
                "read":"1",
                "update":"2",
                "require":"1",
    
               "input_type":"number",
               "name":"value",
               "title":"Value (in Kg / Piece)",
               "database_name":"value"
            },{
                    
                "position":111,
    
                "create":"1",
                "read":"1",
                "update":"1",
                "require":"0",
    
               "input_type":"text",
               "name":"description",
               "title":"Description",
               "database_name":"description"
            }
            ]
        }]' ;

        // $setting = new setting;
        // $setting->setting = json_encode( $a);
        // $setting->table_name = 'units';
        // $setting->model = 'App\Models\unit';
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
