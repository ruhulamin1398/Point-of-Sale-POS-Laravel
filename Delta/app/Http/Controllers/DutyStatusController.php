<?php

namespace App\Http\Controllers;

use App\Models\dutyStatus;
use Illuminate\Http\Request;

class DutyStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $componentDetails= [
            'title' => 'Duty statues',
            'editTitle' =>'Edit Duty statues',
        ];

        $routes = [
            'update' => [
                'name' => 'duty_status.update',
                'link' => 'duty_status',
            ],
            'delete' => [
                
                'name' => 'duty_status.destroy',
                'link' => 'duty_status',
            ]

        ];
     
        

        $fieldList=[
         
            'name'=>[
                'create'=>true,
                'read'=>true,
                'update'=>true,
                'delete'=>true,


                'type'=>'normal',
                'name'=>'name',
                'database_name'=>'name',
                
                'title'=> "Name",
    
            ],
            'description'=>[
                'create'=>true,
                'read'=>true,
                'update'=>true,
                'delete'=>true,


               'type'=>'normal',
               'name'=>'description',
               'database_name'=>'description',

               'title'=> "Description",
            ],

        
          
        ];


        $items = dutyStatus::all();
  


        return view('dutystatus.index', compact('items', 'fieldList', 'routes','componentDetails',));

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
     * @param  \App\Models\dutyStatus  $dutyStatus
     * @return \Illuminate\Http\Response
     */
    public function show(dutyStatus $dutyStatus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\dutyStatus  $dutyStatus
     * @return \Illuminate\Http\Response
     */
    public function edit(dutyStatus $dutyStatus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\dutyStatus  $dutyStatus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, dutyStatus $dutyStatus)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\dutyStatus  $dutyStatus
     * @return \Illuminate\Http\Response
     */
    public function destroy(dutyStatus $dutyStatus)
    {
        //
    }
}
