@extends('includes.app')


@section('content')



<div class="container-fluid  p-0">
    <div class="card mb-4 shadow">

        <div class="card-header py-3 bg-abasas-dark">
            <nav class="navbar navbar-dark ">
                <a class="navbar-brand">{{ __('translate.Analysis') }}</a>
            </nav>
        </div>
        <div class="card-body">
            <div class="row">


                <!-- Growth Card Example -->
                <div class="col-xl-3 col-md-6 mb-4 text-center topCard">
                    <div class="card border-left-primary shadow h-100 py-4">

                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        {{ __('translate.Todays Sell') }}
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $data['sell'] }}</div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>


                <!-- Growth Card Example -->
                <div class="col-xl-3 col-md-6 mb-4 text-center topCard">
                    <div class="card border-left-primary shadow h-100 py-4">

                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        {{ __('translate.Todays Buy') }}
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $data['buy'] }}</div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>


                <!-- Growth Card Example -->
                <div class="col-xl-3 col-md-6 mb-4 text-center topCard">
                    <div class="card border-left-primary shadow h-100 py-4">

                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        {{ __('translate.Todays Sell Profit') }}
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $data['sellProfit'] }}</div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>


                <!-- Growth Card Example -->
                <div class="col-xl-3 col-md-6 mb-4 text-center topCard">
                    <div class="card border-left-primary shadow h-100 py-4">

                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        {{ __('translate.Todays Profit') }}
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $data['profit'] }}</div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>





                <!-- Growth Card Example -->
                <div class="col-xl-3 col-md-6 mb-4 text-center topCard">
                    <div class="card border-left-primary shadow h-100 py-4">

                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        {{ __('translate.Todays Expese') }}
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $data['expense'] }}</div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>


                <!-- Growth Card Example -->
                <div class="col-xl-3 col-md-6 mb-4 text-center topCard">
                    <div class="card border-left-primary shadow h-100 py-4">

                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        {{ __('translate.Todays Payment') }}
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $data['payment'] }}</div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>



                <!-- Growth Card Example -->
                <div class="col-xl-3 col-md-6 mb-4 text-center topCard">
                    <div class="card border-left-primary shadow h-100 py-4">

                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        {{ __('translate.Todays Sell Count') }}
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $data['sellCount'] }}</div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>


                <!-- Growth Card Example -->
                <div class="col-xl-3 col-md-6 mb-4 text-center topCard">
                    <div class="card border-left-primary shadow h-100 py-4">

                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        {{ __('translate.Todays Buy Count') }}
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $data['buyCount'] }}</div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>






            </div>

            <div class="row">
                <div class="col-12 col-md-6">
                    <x-bar-chart :dataArray="$data['sellAnalysisDaily']" id='sellAnalysisDailyBar' />
                </div>
                <div class="col-12 col-md-6">
                    <x-line-chart :dataArray="$data['sellAnalysisDaily']" id='sellAnalysisDailyLine' />

                </div>
                <div class="col-12 col-md-6">
                    <x-bar-chart :dataArray="$data['sellAnalysisMonthly']" id='sellAnalysisMonthlyBar' />

                </div>
                <div class="col-12 col-md-6">
                    <x-line-chart :dataArray="$data['sellAnalysisMonthly']" id='sellAnalysisMonthlyLine' />

                </div>
                <div class="col-12 col-md-6">
                    <x-bar-chart :dataArray="$data['amountAnalysisDaily']" id='amountAnalysisDailyBar' />

                </div>
                <div class="col-12 col-md-6">

                    <x-line-chart :dataArray="$data['amountAnalysisDaily']" id='amountAnalysisDailyLine' />

                </div>
                <div class="col-12 col-md-6">
                    <x-bar-chart :dataArray="$data['amountAnalysisMonthly']" id='amountAnalysisMonthlyBar' />


                </div>
                <div class="col-12 col-md-6">
                    <x-line-chart :dataArray="$data['amountAnalysisMonthly']" id='amountAnalysisMonthlyLine' />

                </div>
            </div>

        </div>

    </div>

</div>




@endsection
