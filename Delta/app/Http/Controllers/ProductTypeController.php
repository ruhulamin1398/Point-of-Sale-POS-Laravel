<?php

namespace App\Http\Controllers;

use App\Product_type;
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
        $productTypes= Product_type::all();
        return view('product.type', compact( 'productTypes' ) );

    }
    public function apiIndex()
    {
        $productTypes= Product_type::all();
        return ($productTypes);

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
        $productType= new Product_type;

        $productType-> name = $request->name;
        $productType-> description = $request->description;
        $productType-> sell_type_id = $request->sell_type_id;


        
        $productType->save();
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        Product_type::find($id)->delete();
         return redirect(route('product_type.index'))->with('successMsg','Product Type Successfully Deleted');
  
    }

    public function Product_typeupdate(Request $request){

        $request->validate([
            'name' => 'required:product_types',
        ]);
       

        $productType = Product_type::find($request->id);
        $productType->name= $request->name;
        $productType->description= $request->description;
        $productType->save();
        
        return redirect(route('product_type.index'))->with('successMsg','Product Type Successfully updated');

    }
}
