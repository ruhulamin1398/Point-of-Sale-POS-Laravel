<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\brand;
use App\Models\category;
use App\Models\Product;
use App\Models\productAnalysisYearly;
use App\Models\productType;
use App\Models\setting;
use App\Models\taxType;
use App\Models\unit;
use App\Models\warrenty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class ProductController extends Controller
{

   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products= Product::all();
        return view('product.index',compact('products'));
    }
    
    public function productAll(){
        $p= Product::all();
      
        $products= array();
        foreach($p as $product){
            $products[$product->id]=$product;
        }
        return $products;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $warrenties = warrenty::all();
        $tax_types = taxType::all();
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
     
        return view ('product.create',compact('types','brands','categories','units','warrenties','tax_types'));
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
 
       $product = new product;
       $unit = unit::find($request->unit_id);
       $product->name=$request->name;

       $product->stock_alert=$request->stock_alert * $unit->value;

       $product->category_id=$request->category_id;
       $product->type_id=$request->type_id;
       $product->brand_id=$request->brand_id;
       $product->unit_id=$request->unit_id;
       $product->description=$request->description;
       $product->warrenty_id=$request->warrenty_id;
       $product->tax=$request->tax;
       $product->tax_type_id=$request->tax_type_id;
       $product->warrenty_id=$request->warrenty_id;

       $product->is_fixed_price = $request->is_fixed_price;
       $product->price_per_unit= $this->calPricePerUnit($request->price,$request->unit_id);
       
       $product->save();

       
        $this->onlineSync('product','create',$product->id);
     
       return redirect(route('products.index'))->withSuccess(["Product Created"]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        
        $productAnalysis=$this->productAnalysis($product->id);
        $dataArray = json_decode(json_encode($productAnalysis), true);
        return view('product.show',compact('product','dataArray'));
    }

    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $brands = brand::all();
        $categories = category::all();
        $types = productType::all();
        $warrenties = warrenty::all();
        $tax_types = taxType::all();
        $pics = unit::where('product_type_id','1')->get();
        $kg = unit::where('product_type_id','2')->get();
        $units=[
            '',
            $pics,
            $kg,
        ];
        return view('product.edit',compact('brands','categories','types','warrenties','tax_types','product','units'));
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
       $unit = unit::find($request->unit_id);
        $product->name=$request->name;
       $product->stock_alert=$request->stock_alert * $unit->value;
       $product->category_id=$request->category_id;
       $product->type_id=$request->type_id;
       $product->brand_id=$request->brand_id;
       $product->unit_id=$request->unit_id;
       $product->description=$request->description;
       $product->warrenty_id=$request->warrenty_id;
       $product->tax=$request->tax;
       $product->tax_type_id=$request->tax_type_id;
       $product->warrenty_id=$request->warrenty_id;
       
       $product->is_fixed_price = $request->is_fixed_price;
       $product->price_per_unit= $this->calPricePerUnit($request->price,$request->unit_id);
       $product->save();
     
       $this->onlineSync('Product','update',$product->id);
       return redirect(route('products.index'))->withSuccess(["Product Updated"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {  
        if($product->stock <=0){
            $product->delete();
            
           $this->onlineSync('Product','update',$product->id);
            return Redirect::back()->withErrors(["Item Deleted" ]);
        }
        else{
            return Redirect::back()->withErrors(["This Products Stock is not Zero",'Please Sell or drop that product to delete this Product' ]);
        }
       
    }


    
    public function lowStockProduct()
    {  
      $lowStockProducts =  Product::whereColumn('stock' ,'<' ,'stock_alert')->get();
     
      $settings = setting::where('table_name','stock_alert')->first();
      $settings->setting= json_decode(  json_decode(  $settings->setting,true),true);
      
              
    $dataArray=[
        'settings'=>$settings,
        'items' => $lowStockProducts,
    ];
      return view('product.stock-alert.index',compact('dataArray'));     
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




    public function calPricePerUnit($price,$unit_id){
        $unit = unit::find($unit_id);
        $price_per_unit = $price/$unit->value;
        return $price_per_unit;
    }


    public function productAnalysis($product_id){
        $lebels = array('Purchase','Sell','Return','Drop','Profit');
        $data = array();
        $purchase = 0;
        $Sell = 0;
        $Return = 0;
        $Drop = 0;
        $Profit = 0;
        $productYearlies = productAnalysisYearly::where('product_id',$product_id)->get();
        foreach ($productYearlies as $productYearly) {
            $purchase += $productYearly->purchase;
            $Sell += $productYearly->sell;
            $Return += $productYearly->return;
            $Drop += $productYearly->drop;
            $Profit += $productYearly->profit;
        }
        $data = array($purchase,$Sell,$Return,$Drop,$Profit);
        $color = array('#FFFF00','#0000FF','#800000','#FF0000','#008000');
        $productAnalysis = [
            'id' => 'productAnalysis',
            "lebels" => $lebels,
            "datasets" => [
                [
                    "label" => "Product Analysis",
                    "data" => $data,
                    "backgroundColor" => $color,
                    "fill" => false
                ],
            ]
        ];
        return $productAnalysis;
    }










  
}
