<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\brand;
use App\Models\category;
use App\Models\Product;
use App\Models\productType;
use App\Models\unit;
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

//
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = productType::all();
        $brands= brand::all();
        $categories= category::all();
        $pics = unit::where('product_type_id','1')->get();
        $kg = unit::where('product_type_id','2')->get();
      $units=[
          '',
          $pics,
          $kg,
      ];
     
        return view ('product.create',compact('types','brands','categories','units'));
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {  
 
     //  return $request;
       $product = new product;
       $product->name=$request->name;
       $product->stock_alert=$request->stock_alert;
       $product->category_id=$request->category_id;
       $product->type_id=$request->type_id;
       $product->brand_id=$request->brand_id;
       $product->sell=$request->sell;
       $product->unit_id=$request->unit_id;
       $product->tax=$request->tax;
       $product->price_per_unit= $this->calPricePerUnit($request->sell,$request->unit_id,$request->type_id);
       $product->save();
     
       return back();

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
    public function update(ProductRequest $request, Product $product)
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

        //Api Area start

    public function apiShow(Request $request)
    { 

        $product = Product::find($request->id);
        return $product;
    }

 public function apiProducutCheck(Request $request, category $category,Product $product)
    {  
    
        $product = product::find(2);
        // return $productss;

        $product->category_name();   

        //  return $product;
      

         
       return view('welcome',compact('product'));



    }

      
    public function category_name(Request $request, category $category)
    {


    }


   


    public function getProductById(Request $request){

        $product = Product::where('id',$request->id)->first();
        if (is_null($product)) {
            return 0;
        } else{

            return $product;
        }
    }










  
}
