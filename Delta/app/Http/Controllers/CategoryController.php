<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\productType;
use App\Models\setting;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       

$settings = setting::where('table_name','categories')->first();
$settings->setting= json_decode(  json_decode(  $settings->setting,true),true);

        
        $dataArray=[
            'items' => category::all(),
            'product_types'=> productType::all(),
        ];


        return view('product.category.index', compact('dataArray','settings'));
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
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, category $category)
    {
        //
        $category->date_time= $request->date_time;
        $category->name= $request->name;
        $category->description= $request->description;
        $category->created_at= $request->created_at;
        $category->save();
        return $category;
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(category $category)
    {
        $category->delete();
        return back();
    }
}
