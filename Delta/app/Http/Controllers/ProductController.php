<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $componentDetails= [
            'title' =>'পণ্যের লিস্ট',
            'editTitle' =>'পণ্য সংশোধন',
        ];
        $routes = [
            'create' => [
                'name' => 'products.store',
                'link' => 'products',
            ],
            'update' => [
                'name' => 'products.update',
                'link' => 'products',
            ],
            'delete' => [
                'name' => 'products.destroy',
                'link' => 'products',
            ]

        ];




     $fieldList=[
         
        'name'=>[
            'type'=>'normal',
            'name'=>'name',
            'database_name'=> 'name',

        ],
        'category'=>[

           'type'=>'dropDown',
           'name'=>'category',
           'database_name'=>'category_id',
           
           'field'=>'name',
           'data'=>category::all(),
        ],
      
    ];


     $fieldTitleList=[
         '#',
         'নাম',
         'ক্যাটাগরি',
         'একশন'
     ]; 

     $items= Product::all();

    
     return view('product.index',compact('items','fieldList','fieldTitleList','routes','componentDetails'));
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
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $product->category_id= $request->category_id;
        $product->save();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
       $product->delete();
       return back();
    }
}
