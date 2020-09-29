<?php

namespace App\Http\Controllers;

use App\Models\productSellType;
use Illuminate\Http\Request;

class ProductSellTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $componentDetails= [
            'title' => 'Product Sell Types ',
            'editTitle' =>'Edit Sell Types',
        ];

        $routes = [
            'update' => [
                'name' => 'sell_type.update',
                'link' => 'sell_type',
            ],
            'delete' => [
                
                'name' => 'sell_type.destroy',
                'link' => 'sell_type',
            ]

        ];
     
        

        $fieldList=[
         
            'product_id'=>[
                'create'=>true,
                'read'=>true,
                'update'=>false,
                'delete'=>false,


                'type'=>'normal',
                'name'=>'product_id',
                'database_name'=> 'product_id',
                
               'title'=> "product_id",
    
            ],
            'product_type_id'=>[
                'create'=>true,
                'read'=>true,
                'update'=>false,
                'delete'=>false,


               'type'=>'normal',
               'name'=>'product_type_id',
               'database_name'=>'product_type_id',

               'title'=> "product_type_id",
            ],
            'sell_type'=>[
                'create'=>true,
                'read'=>true,
                'update'=>false,
                'delete'=>false,


               'type'=>'normal',
               'name'=>'sell_type',
               'database_name'=>'sell_type',

               'title'=> "sell_type",
            ],
            'purchased_type'=>[
                'create'=>true,
                'read'=>true,
                'update'=>false,
                'delete'=>false,


               'type'=>'normal',
               'name'=>'purchased_type',
               'database_name'=>'purchased_type',

               'title'=> "purchased_type",
            ],
          
        ];






        $items = productSellType::all();


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
     * @param  \App\Models\productSellType  $productSellType
     * @return \Illuminate\Http\Response
     */
    public function show(productSellType $productSellType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\productSellType  $productSellType
     * @return \Illuminate\Http\Response
     */
    public function edit(productSellType $productSellType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\productSellType  $productSellType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, productSellType $productSellType)
    {

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\productSellType  $productSellType
     * @return \Illuminate\Http\Response
     */
    public function destroy(productSellType $productSellType)
    {
        return back();
    }
}
