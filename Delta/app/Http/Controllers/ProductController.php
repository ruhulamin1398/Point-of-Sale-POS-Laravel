<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Product_type;
use App\Category;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //   $products = Product::all()->where("category_id",3);
        $products = Product::all();


        $categories = Category::all();
        $productTypes = Product_type::all();

        return view('product.view', compact('categories', 'productTypes', 'products'));
    }

    public function complete()
    {
        $products = Product::all()->where("category_id", 102);



        $categories = Category::all();
        $productTypes = Product_type::all();

        return view('product.complete', compact('categories', 'productTypes', 'products'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $productTypes = Product_type::all();

        return view('product.create', compact('categories', 'productTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $request->validate([
            'name' => 'required:products',
            'category_id' => 'required:products',
            'product_type_id' => 'required:products',
        ]);

        $product = new Product;
        $product->name = $request->name;
        $product->category_id = $request->category_id;
        $product->product_type_id = $request->product_type_id;
        $product->cost = $request->cost;
        $product->price = $request->price;
        $product->low_limit = $request->low_limit;
        //  $product->price_per_unit =  $request->price;

        $product->weight = $request->weight;
        if ($product->product_type_id == 1) {
            $product->price_per_unit =  $request->price /   $request->weight;
        } else {
            $product->price_per_unit =  $request->price;
        }


        $product->save();

        // return $product->id;

        return redirect(route('products.index'))->with('successMsg', 'Product Successfully inserted');
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
    public function apiShow(Request $request)
    {
        $product = Product::find($request->id);
        return $product;
    }

    public function apiProducutCheck(Request $request)
    {


        $product = Product::find($request->id);
        // return $supplier;

        if (is_null($product)) {
            return 0;
        } else
            return 1;
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
    public function update(Request $request, Product $product)
    {
        /////
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::find($id)->delete();
        return redirect(route('products.index'))->with('successMsg', 'Product Successfully Deleted');
    }


    public function Productsupdate(Request $request)
    {


        // $request->validate([
        //     'name' => 'required:products',
        //     'category_id' => 'required:products',
        //     'product_type_id' => 'required:products',
        //     'cost' => 'required:products',
        //     'price' => 'required:products',
        // ]);



        $product =  Product::find($request->id);
        //  return $request;

        $product->name = $request->name;
        $product->category_id = $request->category_id;
        $product->product_type_id = $request->product_type_id;
        $product->price = $request->price;
        $product->low_limit = $request->low_limit;
        $product->cost = $request->cost;

        $product->weight = $request->weight;
        if ($product->product_type_id == 1) {
            $product->price_per_unit =  $request->price /   $request->weight;
        } else {
            $product->price_per_unit =  $request->price;
        }

        $product->save();

        return redirect(route('products.index'))->with('successMsg', 'Product Successfully updated');
    }




    public function productsdrop()
    {

        $products = Product::all();


        $categories = Category::all();
        $productTypes = Product_type::all();

        return view('product.drop', compact('categories', 'productTypes', 'products'));
    }
}
