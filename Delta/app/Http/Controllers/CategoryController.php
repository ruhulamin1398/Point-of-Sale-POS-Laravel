<?php

namespace App\Http\Controllers;

use App\Models\category;
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
        //

        $componentDetails= [
            'title' => 'ক্যাটাগরি লিস্ট',
            'editTitle' =>'ক্যাটাগরি সংশোধন',
        ];

        $routes = [
            'update' => [
                'name' => 'categories.update',
                'link' => 'categories',
            ],
            'delete' => [
                
                'name' => 'categories.destroy',
                'link' => 'categories',
            ]

        ];
     
        

        $fieldList=[
         
            'name'=>[
                'type'=>'normal',
                'name'=>'name',
                'database_name'=> 'name',
    
            ],
            'description'=>[
    
               'type'=>'normal',
               'name'=>'description',
               'database_name'=>'description',
            ],
          
        ];




        $fieldTitleList = [
            '#',
            'নাম',
            'বিবরণ',
            'একশন'
        ];
        $items = category::all();


        return view('index', compact('items', 'fieldList', 'fieldTitleList', 'routes','componentDetails'));
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
        $category->name= $request->name;
        $category->save();
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
