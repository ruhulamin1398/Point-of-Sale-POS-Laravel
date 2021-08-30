<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\category;
use App\Models\onlineSync;
use App\Models\productAnalysisYearly;
use App\Models\productType;
use App\Models\setting;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        if(! auth()->user()->hasPermissionTo('Category Page')){
            return abort(401);
        }

        $settings = setting::where('table_name','categories')->first();
        $settings->setting= json_decode(  json_decode(  $settings->setting,true),true);

        $dataArray=[  
            'settings'=>$settings,
            'items' => category::all(),
            'product_types'=> productType::all(),
            'page_name' => 'Category',
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
        
        if(! auth()->user()->hasPermissionTo('Category View')){
            return abort(401);
        }
        

        
        $settings = setting::where('table_name', 'products')->first();
        $settings->setting = json_decode(json_decode($settings->setting, true), true);
        $products = $category->products ; 
        $dataArray = [
            'settings' => $settings,
            'items' => $products,
            'page_name' => 'Product',
        ];

        $roles = Role::all();

        $data=$this->categoryAnalysisYearly($products);
        $dataArrayPie = json_decode(json_encode($data['categoryAnalysis']), true);

        // $categoryAnalysisSell = json_decode(json_encode($data['categoryAnalysisSell']), true);
        // $categoryAnalysisPurchase = json_decode(json_encode($data['categoryAnalysisPurchase']), true);
        // $categoryAnalysisReturn = json_decode(json_encode($data['categoryAnalysisReturn']), true);
        // $categoryAnalysisDrop = json_decode(json_encode($data['categoryAnalysisDrop']), true);
        // $categoryAnalysisProfit = json_decode(json_encode($data['categoryAnalysisProfit']), true);

        return view('product.category.show',compact('category','dataArray','roles','dataArrayPie'));
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


    // ***************** categoryAnalysisYearly ******************

public function categoryAnalysisYearly($products){
    
    $lebels = array('Purchase','Sell','Return','Drop','Profit');
    $purchase = 0;
    $Sell = 0;
    $Return = 0;
    $Drop = 0;
    $Profit = 0;

    // $year = array();
    // $yearlySell = array();
    // $yearlyPurchase = array();
    // $yearlyReturn = array();
    // $yearlyDrop = array();
    // $yearlyProfit = array();
    foreach($products as $product){
        $unit = $product->unit->value;
        $productYearlies = productAnalysisYearly::where('product_id',$product->id)->get();

        foreach ($productYearlies as $yearly) {
            // array_push($year, $yearly->year);
            // array_push($yearlySell, $yearly->sell/$unit);
            // array_push($yearlyPurchase, $yearly->purchase/$unit);
            // array_push($yearlyReturn, $yearly->return/$unit);
            // array_push($yearlyDrop, $yearly->drop/$unit);
            // array_push($yearlyProfit, $yearly->profit);
    
            $purchase += $yearly->purchase/$unit;
            $Sell += $yearly->sell/$unit;
            $Return += $yearly->return/$unit;
            $Drop += $yearly->drop/$unit;
            $Profit += $yearly->profit;
        }
    }
    


    $data = array($purchase,$Sell,$Return,$Drop,$Profit);
    $color = array('#FFFF00','#0000FF','#800000','#FF0000','#008000');
    $categoryAnalysis = [
        "lebels" => $lebels,
        "datasets" => [
            [
                "label" => "Category Analysis",
                "data" => $data,
                "backgroundColor" => $color,
                "fill" => false
            ],
        ]
    ];
    // $categoryAnalysisSell = [
    //     "lebels" => $year,
    //     "datasets" => [
    //         [
    //             "label" => "Sell",
    //             "data" => $yearlySell,
    //             "backgroundColor" => "#0000FF",
    //             "borderColor" =>     "#0000FF",
    //             "fill" => false
    //         ],
    //     ]
    // ];

    
    // $categoryAnalysisPurchase = [
    //     "lebels" => $year,
    //     "datasets" => [
    //         [
    //             "label" => "Purchase",
    //             "data" => $yearlyPurchase,
    //             "backgroundColor" => "#FFFF00",
    //             "borderColor" =>     "#FFFF00",
    //             "fill" => false
    //         ],
    //     ]
    // ];

    
    // $categoryAnalysisReturn = [
    //     "lebels" => $year,
    //     "datasets" => [
    //         [
    //             "label" => "Return",
    //             "data" => $yearlyReturn,
    //             "backgroundColor" => "#800000",
    //             "borderColor" =>     "#800000",
    //             "fill" => false
    //         ],
    //     ]
    // ];

    
    // $categoryAnalysisDrop = [
    //     "lebels" => $year,
    //     "datasets" => [
    //         [
    //             "label" => "Drop",
    //             "data" => $yearlyDrop,
    //             "backgroundColor" => "#FF0000",
    //             "borderColor" =>     "#FF0000",
    //             "fill" => false
    //         ],
    //     ]
    // ];

    
    // $categoryAnalysisProfit = [
    //     "lebels" => $year,
    //     "datasets" => [
    //         [
    //             "label" => "Profit",
    //             "data" => $yearlyProfit,
    //             "backgroundColor" => "#008000",
    //             "borderColor" =>     "#008000",
    //             "fill" => false
    //         ],
    //     ]
    // ];
    $data = array("categoryAnalysis"=>$categoryAnalysis );
    return $data;

}

}
