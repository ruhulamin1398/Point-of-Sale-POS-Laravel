<?php

namespace App\Http\Controllers;

use App\Http\Requests\BrandRequest;
use App\Models\brand;
use App\Models\posSetting;
use App\Models\productAnalysisYearly;
use App\Models\setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        if(! auth()->user()->hasPermissionTo('Brand Page')){
            return abort(401);
        }
            
        $settings = setting::where('table_name', 'brands')->first();
        $settings->setting = json_decode(json_decode($settings->setting, true), true);

        $dataArray = [
            'settings' => $settings,
            'items' => brand::all(),
            'page_name' => 'Brand',
        ];
        return view('product.brand.index', compact('dataArray'));
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
    public function store(BrandRequest $request)

    {

       
        
        $brand = brand::create($request->all());
 
        $this->onlineSync('brand','create',$brand->id);
        return redirect()->back()->withSuccess(['Successfully Created']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(brand $brand)
    {
        
        if(! auth()->user()->hasPermissionTo('Brand View')){
            return abort(401);
        }

          
        $settings = setting::where('table_name', 'products')->first();
        $settings->setting = json_decode(json_decode($settings->setting, true), true);
        $products = $brand->products ; 
        $dataArray = [
            'settings' => $settings,
            'items' => $products,
            'page_name' => 'Product',
        ];

        $roles = Role::all();
        $data=$this->brandAnalysisYearly($products);
        $dataArrayPie = json_decode(json_encode($data['brandAnalysis']), true);

        return view('product.brand.show', compact('brand','dataArray','roles','dataArrayPie'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(brand $brand)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(BrandRequest $request, brand $brand)
    {
        if ($brand->id == 1) {
            return Redirect::back()->withErrors(["This Brand Can't be Edited"]);
        }

       
        $brand->update($request->all());
        $this->onlineSync('brand','update',$brand->id);

        return redirect()->back()->withSuccess(['Successfully Updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(brand $brand)
    {
        

        if ($brand->id == 1) {
            return Redirect::back()->withErrors(["This Brand Can't be Edited"]);
        } 
        
        $brand->delete();
        $this->onlineSync('brand','delete',$brand->id);
        return Redirect::back()->withErrors(["Brand Deleted"]);
    }


    // ***************** brandAnalysisYearly ******************

    public function brandAnalysisYearly($products){
    
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
        $brandAnalysis = [
            "lebels" => $lebels,
            "datasets" => [
                [
                    "label" => "Brand Analysis",
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

        $data = array("brandAnalysis"=>$brandAnalysis );
        return $data;
    
    }
    



}
