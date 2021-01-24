<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\category;
use App\Models\onlineSync;
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
            'settings'=>$settings,
            'items' => category::all(),
            'product_types'=> productType::all(),
        ];


        return view('product.category.index', compact('dataArray'));
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
    public function store(CategoryRequest $request)
    { 
        $category = category::create($request->all());
        $this->onlineSync('category','create',$category->id);
        return redirect()->back()->withSuccess(['Successfully Created']);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(category $category)
    {
        return view('product.category.show',compact('category'));
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
    public function update(CategoryRequest $request, category $category)
    {
        if($category->id==1){
            return redirect()->back()->withErrors(["Can't Edit This Category"]);
        }

        $category->update($request->all());
        $this->onlineSync('category','update',$category->id);
        return redirect()->back()->withSuccess(['Successfully Updated']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(category $category)
    {
        if($category->id==1){
            return redirect()->back()->withErrors(["Can't Delete This Category"]);
        }
        $category->delete();
        $this->onlineSync('category','delete',$category->id);
        return redirect()->back()->withErrors(['Item Deleted']);
    }
}
