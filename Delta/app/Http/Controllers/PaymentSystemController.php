<?php

namespace App\Http\Controllers;

use App\Models\paymentSystem;
use Illuminate\Http\Request;

class PaymentSystemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
                
        $componentDetails= [
            'title' => 'Payment System',
            'editTitle' =>'Edit Payment System',
        ];

        $routes = [
            'update' => [
                'name' => 'payment_systems.update',
                'link' => 'payment_systems',
            ],
            'delete' => [
                
                'name' => 'payment_systems.destroy',
                'link' => 'payment_systems',
            ]

        ];
     
        

        $fieldList=[
         
            'payment_system'=>[
                'create'=>true,
                'read'=>true,
                'update'=>false,
                'delete'=>false,


                'type'=>'normal',
                'name'=>'payment_system',
                'database_name'=> 'payment_system',
               'title'=> "payment_system",
    
            ],
            'description'=>[
                'create'=>true,
                'read'=>true,
                'update'=>false,
                'delete'=>false,


               'type'=>'normal',
               'name'=>'description',
               'database_name'=>'description',

               'title'=> "description",
            ],

        ];






        $items = paymentSystem::all();


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
     * @param  \App\Models\paymentSystem  $paymentSystem
     * @return \Illuminate\Http\Response
     */
    public function show(paymentSystem $paymentSystem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\paymentSystem  $paymentSystem
     * @return \Illuminate\Http\Response
     */
    public function edit(paymentSystem $paymentSystem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\paymentSystem  $paymentSystem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, paymentSystem $paymentSystem)
    {
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\paymentSystem  $paymentSystem
     * @return \Illuminate\Http\Response
     */
    public function destroy(paymentSystem $paymentSystem)
    {
        return back();
    }
}
