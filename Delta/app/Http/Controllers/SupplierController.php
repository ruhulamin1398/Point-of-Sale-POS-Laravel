<?php

namespace App\Http\Controllers;

use App\Models\supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $componentDetails= [
            'title' => 'suppliers List',
            'editTitle' =>'Edit suppliers',
        ];

        $routes = [
            'update' => [
                'name' => 'suppliers.update',
                'link' => 'suppliers',
            ],
            'delete' => [
                
                'name' => 'suppliers.destroy',
                'link' => 'suppliers',
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






        $items = supplier::all();


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
     * @param  \App\Models\supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(supplier $supplier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, supplier $supplier)
    {
        $supplier->name= $request->name;
        $supplier->phone= $request->phone;
        $supplier->address= $request->address;
        $supplier->company= $request->company;
        $supplier->save();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(supplier $supplier)
    {
        $supplier->delete();
        return back();
    }














    public function supplierCheck(Request $request){
       

        $supplier = supplier::where('phone',$request->phone)->first();
        if (is_null($supplier)) {
            return 0;
        } else
            return $supplier;
        return $supplier;
    }
}
