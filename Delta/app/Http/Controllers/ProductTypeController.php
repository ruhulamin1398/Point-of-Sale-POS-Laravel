<?php

namespace App\Http\Controllers;

use App\Models\productType;
use Illuminate\Http\Request;

class ProductTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $componentDetails= [
            'title' => 'Product Type',
            'editTitle' =>'Edit Product Type',
        ];

        $routes = [
            'update' => [
                'name' => 'product_types.update',
                'link' => 'product_types',
            ],
            'delete' => [
                
                'name' => 'product_types.destroy',
                'link' => 'product_types',
            ]

        ];
     
        

        $fieldList=[
         
            'name'=>[
                'create'=>true,
                'read'=>true,
                'update'=>false,
                'delete'=>false,


                'type'=>'normal',
                'name'=>'name',
                'database_name'=> 'name',
                
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






        $items = productType::all();


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
     * @param  \App\Models\productType  $productType
     * @return \Illuminate\Http\Response
     */
    public function show(productType $productType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\productType  $productType
     * @return \Illuminate\Http\Response
     */
    public function edit(productType $productType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\productType  $productType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, productType $productType)
    {
        $productType->name= $request->name;
        $productType->description= $request->description;
        $productType->save();
        return back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\productType  $productType
     * @return \Illuminate\Http\Response
     */
    public function destroy(productType $productType)
    {
        $productType->delete();
        return back();
    }
}
