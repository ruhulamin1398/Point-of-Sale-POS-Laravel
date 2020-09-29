<?php

namespace App\Http\Controllers;

use App\Models\customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         
        $componentDetails= [
            'title' => 'customers List',
            'editTitle' =>'Edit customers',
        ];

        $routes = [
            'update' => [
                'name' => 'customers.update',
                'link' => 'customers',
            ],
            'delete' => [
                
                'name' => 'customers.destroy',
                'link' => 'customers',
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
                'database_name'=> 'name',
                
               'title'=> "Name",
    
            ],
            'phone'=>[
                'create'=>true,
                'read'=>true,
                'update'=>true,
                'delete'=>true,


               'type'=>'normal',
               'name'=>'phone',
               'database_name'=>'phone',

               'title'=> "phone",
            ],
            'address'=>[
                'create'=>true,
                'read'=>true,
                'update'=>true,
                'delete'=>true,


               'type'=>'normal',
               'name'=>'address',
               'database_name'=>'address',

               'title'=> "address",
            ],
            'company'=>[
                'create'=>true,
                'read'=>true,
                'update'=>true,
                'delete'=>true,


               'type'=>'normal',
               'name'=>'company',
               'database_name'=>'company',

               'title'=> "company",
            ],
            'due'=>[
                'create'=>true,
                'read'=>true,
                'update'=>false,
                'delete'=>true,


               'type'=>'normal',
               'name'=>'due',
               'database_name'=>'due',

               'title'=> "due",
            ],
          
        ];






        $items = customer::all();


        return view('index', compact('items', 'fieldList', 'routes','componentDetails'));
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
     * @param  \App\Models\customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, customer $customer)
    {
        $customer->name= $request->name;
        $customer->phone= $request->phone;
        $customer->address= $request->address;
        $customer->company= $request->company;
        $customer->save();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(customer $customer)
    {
        $customer->delete();
        return back();
    }
}
