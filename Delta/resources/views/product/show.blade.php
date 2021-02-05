@extends('includes.app')

@section('content')



@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{  __('translate.'.$error) }}</li>
        @endforeach
    </ul>
</div>
@endif

@if (session()->has('success'))
<div class="alert alert-success">
    @if(is_array(session('success')))
    <ul>
        @foreach (session('success') as $message)
        <li>{{  __('translate.'.$message) }}</li>
        @endforeach
    </ul>
    @else
    {{ session('success') }}
    @endif
</div>
@endif

<!-- Begin Page Content -->
<div class="container-fluid p-0">




    <!-- DataTales Example -->
    <div class="card shadow m-0 p-0">
        <div class="card-header py-3 bg-abasas-dark">
            <nav class="navbar navbar-dark ">
                <a class="navbar-brand">{{ __("translate.Product Details") }}</a>

            </nav>
        </div>
        <div class="card-body ">
            <div class="row">
                <div class="col-12 col-md-6">


                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="SingleProductTable" width="100%"
                            cellspacing="0">
                            <tbody>
                                <tr class="data-row">
                                    <th>{{ __("translate.Name") }}</th>
                                    <td> {{ $product->name }}</td>
                                </tr>
                                <tr class="data-row">
                                    <th>{{ __("translate.Category") }} </th>
                                    <td>{{ $product->category->name }}</td>
                                </tr>
                                <tr class="data-row">
                                    <th>{{ __("translate.Brand") }} </th>
                                    <td>{{ $product->brand->name }}</td>
                                </tr>
                                <tr class="data-row">
                                    <th>{{ __("translate.Type") }} </th>
                                    <td>{{ $product->type->name }}</td>
                                </tr>
                                <tr class="data-row">
                                    <th>{{ __("translate.Unit") }} </th>
                                    <td>{{ $product->unit->name }} </td>
                                </tr>
                                @can('Product Cost')
                                <tr class="data-row">
                                    <th>{{ __("translate.Cost") }} </th>
                                    <td>{{ $product->cost_per_unit * $product->unit->value }} </td>
                                </tr>
                                @endcan
                                @can('Product Price')
                                <tr class="data-row">
                                    <th>{{ __("translate.Price") }} </th>
                                    <td>  {{ $product->price_per_unit * $product->unit->value }} @if ($product->is_fixed_price == 1)
                                        (Fixed)
                                    @else 
                                     (Not Fixed)
                                    @endif  </td>
                                </tr>
                                @endcan
                                <tr class="data-row">
                                    <th>{{ __("translate.Warrenty") }} </th>
                                    <td>{{ $product->warrenty->name }} </td>
                                </tr>
                                <tr class="data-row">
                                    <th>{{ __("translate.Tax") }} (%) </th>
                                    <td>{{ $product->tax }} </td>
                                </tr>
                                <tr class="data-row">
                                    <th>{{ __("translate.Tax Type") }} </th>
                                    <td>{{ $product->taxType->name }}</td>
                                </tr>
                                <tr class="data-row">
                                    <th>{{ __("translate.Stock") }} </th>
                                    <td>{{$product->stock / $product->unit->value}}</td>
                                </tr>
                                <tr class="data-row">
                                    <th>{{ __("translate.Stock Alert") }} </th>
                                    <td> {{ $product->stock_alert / $product->unit->value }} </td>
                                </tr>
                                <tr class="data-row">
                                    <th>{{ __("translate.Stock Controll") }} </th>
                                    <td> {{ $product->stock_controll }} </td>
                                </tr>
                            </tbody>
                        </table>

                        <p class="pt-4"><b> {{ __("translate.Product Description") }} </b>: {{ $product->description }}
                        </p>
                    </div>


                </div>
                <div class="col-12 col-md-6">
                    @can('Product Graph')

                    <div class="p-0 p-md-4">
                        <h3 class="text-center"> {{ __('translate.Analysis Results') }}</h3>
                        <table class="table table-striped table-bordered" id="SingleProductChartTable" width="100%"
                            cellspacing="0">
                            <tbody>
                                <tr class="data-row">
                                    <th>{{ __('translate.Purchase') }}</th>
                                    <td> {{ $dataArray['datasets'][0]['data'][0] }} </td>
                                </tr>
                                <tr class="data-row">
                                    <th>{{ __('translate.Sell') }}</th>
                                    <td> {{ $dataArray['datasets'][0]['data'][1] }} </td>
                                </tr>
                                <tr class="data-row">
                                    <th>{{ __('translate.Profit') }}</th>
                                    <td>{{ $dataArray['datasets'][0]['data'][4] }} </td>
                                </tr>
    
                                <tr class="data-row">
                                    <th> {{ __('translate.Return') }}</th>
                                    <td>{{ $dataArray['datasets'][0]['data'][2] }} </td>
                                </tr>
                                <tr class="data-row">
                                    <th> {{ __('translate.Drop') }}</th>
                                    <td> {{ $dataArray['datasets'][0]['data'][3] }} </td>
                                </tr>
                            </tbody>
                        </table>
                    <x-pie-chart :dataArray="$dataArray" id="productAnalysispie" />
                    </div>
                   
                
                    @endcan

                </div>
            </div>

        </div>

        {{-- Graph Details Section --}}
        @can('Product Graph')
        <div class="row p-2">

            <div class="col-12 col-md-4 p-0 p-md-4">

                <x-line-chart :dataArray="$productAnalysisSell" id="productAnalysisSell" />
                
            </div>
            <div class="col-12 col-md-4 p-0 p-md-4">


                <x-line-chart :dataArray="$productAnalysisDrop" id="productAnalysisDrop" />
           

            </div>
            <div class="col-12 col-md-4 p-0 p-md-4">


                <x-line-chart :dataArray="$productAnalysisProfit" id="productAnalysisProfit" />
          

            </div>
            <div class="col-12 col-md-4 p-0 p-md-4">
                    <x-line-chart :dataArray="$productAnalysisPurchase" id="productAnalysisPurchase" />
             


            </div>
            <div class="col-12 col-md-4 p-0 p-md-4">

                <x-line-chart :dataArray="$productAnalysisReturn" id="productAnalysisReturn" />
              


            </div>

        </div>
        @endcan



    </div>

</div>




@endsection
