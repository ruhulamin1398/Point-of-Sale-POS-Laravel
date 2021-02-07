<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\brand;
use App\Models\category;
use App\Models\Product;
use App\Models\productAnalysisYearly;
use App\Models\productType;
use App\Models\setting;
use App\Models\stockAlert;
use App\Models\taxType;
use App\Models\unit;
use App\Models\warrenty;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Spatie\Permission\Models\Role;

class ProductController extends Controller
{

   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(! auth()->user()->hasPermissionTo('Product Page')){
            return abort(401);
        }

           
        $settings = setting::where('table_name', 'products')->first();
        $settings->setting = json_decode(json_decode($settings->setting, true), true);
        $products = Product::all() ; 
        $dataArray = [
            'settings' => $settings,
            'items' => $products,
            'page_name' => 'Product',
        ];

        $roles = Role::all();
        return view('product.index',compact('dataArray','roles'));
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
        
        
        if(! auth()->user()->hasPermissionTo('Product Create')){
            return abort(401);
        }
        $settings = setting::where('table_name', 'products_create')->first();
        $settings->setting = (json_decode($settings->setting, true));

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
        return view ('product.create',compact('types','brands','categories','units','warrenties','tax_types','settings'));
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
       $product->stock_controll=$request->stock_controll;

       $product->is_fixed_price = $request->is_fixed_price;
       $product->price_per_unit= $this->calPricePerUnit($request->price,$request->unit_id);
       
       $product->save();
       $stock_alert=new stockAlert;
       $stock_alert->product_id = $product->id;
       $stock_alert->save();

       
        $this->onlineSync('Product','create',$product->id);
        $this->onlineSync('stockAlert','create',$stock_alert->id);
     
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
         
        if(! auth()->user()->hasPermissionTo('Product View')){
            return abort(401);
        }
        
        // $productAnalysis=$this->productAnalysis($product);
        $data=$this->productAnalysisYearly($product);
        $dataArray = json_decode(json_encode($data['productAnalysis']), true);

        
        $productAnalysisSell = json_decode(json_encode($data['productAnalysisSell']), true);
        $productAnalysisPurchase = json_decode(json_encode($data['productAnalysisPurchase']), true);
        $productAnalysisReturn = json_decode(json_encode($data['productAnalysisReturn']), true);
        $productAnalysisDrop = json_decode(json_encode($data['productAnalysisDrop']), true);
        $productAnalysisProfit = json_decode(json_encode($data['productAnalysisProfit']), true);

        return view('product.show',compact('product','dataArray','productAnalysisSell','productAnalysisPurchase','productAnalysisReturn','productAnalysisDrop','productAnalysisProfit'));
    }

    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        
        if(! auth()->user()->hasPermissionTo('Product Edit')){
            return abort(401);
        }
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
       $product->stock_controll=$request->stock_controll; 
       
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
            $product->stockAlert->delete();
            $product->delete();
            
           $this->onlineSync('Product','delete',$product->id);
           $this->onlineSync('stockAlert','delete',$product->stockAlert->id);
            return Redirect::back()->withErrors(["Item Deleted" ]);
        }
        else{
            return Redirect::back()->withErrors(['This Products Stock is not Zero','Please Sell or drop that product to delete this Product']);
        }
       
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

    public function categorized_product()
    {
 
        $settings = setting::where('table_name', 'categorized_products')->first();
        $setting = json_decode($settings->setting, true);
        $categories = category::all();
        $roles = Role::all();
        return view('product.categorized_product',compact('categories','setting','roles'));
        
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


    // public function productAnalysis($product){
    //     $unit = $product->unit->value;
    //     $lebels = array('Purchase','Sell','Return','Drop','Profit');
    //     $data = array();
    //     $purchase = 0;
    //     $Sell = 0;
    //     $Return = 0;
    //     $Drop = 0;
    //     $Profit = 0;
    //     $productYearlies = productAnalysisYearly::where('product_id',$product->id)->get();
    //     foreach ($productYearlies as $productYearly) {
    //         $purchase += $productYearly->purchase;
    //         $Sell += $productYearly->sell;
    //         $Return += $productYearly->return;
    //         $Drop += $productYearly->drop;
    //         $Profit += $productYearly->profit;
    //     }
    //     $data = array($purchase,$Sell,$Return,$Drop,$Profit);
    //     $color = array('#FFFF00','#0000FF','#800000','#FF0000','#008000');
    //     $productAnalysis = [
    //         'id' => 'productAnalysis',
    //         "lebels" => $lebels,
    //         "datasets" => [
    //             [
    //                 "label" => "Product Analysis",
    //                 "data" => $data,
    //                 "backgroundColor" => $color,
    //                 "fill" => false
    //             ],
    //         ]
    //     ];
    //     return $productAnalysis;
    // }



    
// ***************** ProductAnalysisYearly ******************

public function productAnalysisYearly($product){
    $unit = $product->unit->value;
    $lebels = array('Purchase','Sell','Return','Drop','Profit');
    $purchase = 0;
    $Sell = 0;
    $Return = 0;
    $Drop = 0;
    $Profit = 0;

    $year = array();
    $yearlySell = array();
    $yearlyPurchase = array();
    $yearlyReturn = array();
    $yearlyDrop = array();
    $yearlyProfit = array();
    $productYearlies = productAnalysisYearly::where('product_id',$product->id)->get();
    foreach ($productYearlies as $yearly) {
        array_push($year, $yearly->year);
        array_push($yearlySell, $yearly->sell/$unit);
        array_push($yearlyPurchase, $yearly->purchase/$unit);
        array_push($yearlyReturn, $yearly->return/$unit);
        array_push($yearlyDrop, $yearly->drop/$unit);
        array_push($yearlyProfit, $yearly->profit);

        $purchase += $yearly->purchase/$unit;
        $Sell += $yearly->sell/$unit;
        $Return += $yearly->return/$unit;
        $Drop += $yearly->drop/$unit;
        $Profit += $yearly->profit;
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
    $productAnalysisSell = [
        "lebels" => $year,
        "datasets" => [
            [
                "label" => "Sell",
                "data" => $yearlySell,
                "backgroundColor" => "#0000FF",
                "borderColor" =>     "#0000FF",
                "fill" => false
            ],
        ]
    ];

    
    $productAnalysisPurchase = [
        "lebels" => $year,
        "datasets" => [
            [
                "label" => "Purchase",
                "data" => $yearlyPurchase,
                "backgroundColor" => "#FFFF00",
                "borderColor" =>     "#FFFF00",
                "fill" => false
            ],
        ]
    ];

    
    $productAnalysisReturn = [
        "lebels" => $year,
        "datasets" => [
            [
                "label" => "Return",
                "data" => $yearlyReturn,
                "backgroundColor" => "#800000",
                "borderColor" =>     "#800000",
                "fill" => false
            ],
        ]
    ];

    
    $productAnalysisDrop = [
        "lebels" => $year,
        "datasets" => [
            [
                "label" => "Drop",
                "data" => $yearlyDrop,
                "backgroundColor" => "#FF0000",
                "borderColor" =>     "#FF0000",
                "fill" => false
            ],
        ]
    ];

    
    $productAnalysisProfit = [
        "lebels" => $year,
        "datasets" => [
            [
                "label" => "Profit",
                "data" => $yearlyProfit,
                "backgroundColor" => "#008000",
                "borderColor" =>     "#008000",
                "fill" => false
            ],
        ]
    ];
    $data = array("productAnalysisSell"=>$productAnalysisSell, "productAnalysisPurchase"=>$productAnalysisPurchase,"productAnalysisReturn"=>$productAnalysisReturn,  "productAnalysisDrop"=>$productAnalysisDrop, "productAnalysisProfit"=>$productAnalysisProfit,"productAnalysis"=>$productAnalysis );
    return $data;

}











  
}
