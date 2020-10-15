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
                "title":"Employee Payment List",
                "editTitle":"Edit Employee Payment"
            },
            "routes":{
                "create":{
                    "name":"expense_monthly.create",
                    "link":"expense_monthly"
                },
                "update":{
                    "name":"expense_monthly.update",
                    "link":"expense_monthly"
                },
                "delete":{
                    "name":"expense_monthly.destroy",
                    "link":"expense_monthly"
                }
            },
            "fieldList":[{
                    
                "position":3,
    
                "create":"3",
                "read":"1",
                "update":"3",
                "require":"0",
    
               "input_type":"dropDown",
               "name":"employee",
               "database_name":"employee_id",
               "title": "Employee",
               "data" : "employees"
            },{
                    
                "position":111,
    
                "create":"3",
                "read":"1",
                "update":"3",
                "require":"0",
    
               "input_type":"month",
               "name":"month",
               "title":"Month",
    
    
               "database_name":"month"
            },{
                    
                "position":111,
    
                "create":"3",
                "read":"1",
                "update":"3",
                "require":"0",
    
               "input_type":"number",
               "name":"amount",
               "title":"Amount",
    
    
               "database_name":"amount"
            }
            ]
        }]' ;


        
        // $setting = new setting::find(14);
        // $setting->setting = json_encode( $a);
        // $setting->table_name = 'expense_monthlies';
        // $setting->model = 'App\Models\ExpenseMonthlyController.php';
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
