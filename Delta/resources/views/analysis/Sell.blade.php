@extends('includes.app')


@section('content')



<div class="container-fluid  p-0">
    <div class="card mb-4 shadow">

        <div class="card-header py-3 bg-abasas-dark">
            <nav class="navbar  ">

                <div class="navbar-brand">
                    {{ __('translate.Sell Analysis') }} <span id="monthOrYear"> ({{ $data['month'] }})</span>
                </div>
                <div id="searchByMonth">

                    <div>
                        <form method="get">
                            <div class="form-row align-items-center">
                                <div class="col-auto">{{ __("translate.Select A Month") }} </div>
                                <div class="col-auto"> <input type="month" name="month" class="form-control mb-2"
                                        id="inlineFormInput" required>
                                </div>
                                <div class="col-auto"> <button type="submit"
                                        class="btn btn-primary mt-3">{{ __("translate.Submit") }}</button> </div>
                            </div>
                        </form>
                    </div>

                </div>


            </nav>
        </div>
        
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="daily-tab" data-toggle="tab" href="#daily" role="tab" aria-controls="daily" aria-selected="true">{{ __('translate.Monthly') }}</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="monthly-tab" data-toggle="tab" href="#monthly" role="tab" aria-controls="monthly" aria-selected="false">{{ __('translate.Yearly') }}</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="yearly-tab" data-toggle="tab" href="#yearly" role="tab" aria-controls="yearly" aria-selected="false">{{ __('translate.Total') }}</a>
            </li>
          </ul>
          <div class="tab-content" id="myTabContent">

            {{-- Daily --}}
            <div class="tab-pane fade show active pt-4 p-2" id="daily" role="tabpanel" aria-labelledby="daily-tab">

                <div class="row">

                    <!-- Growth Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4 text-center topCard">
                        <div class="card border-left-info shadow h-100 py-4">
            
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"> {{ __('translate.Monthly Sell Count') }}</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800" id="dailySellCard">{{ $data['dailyCount'] }}</div>
                                    </div>
            
                                </div>
                            </div>
                        </div>
                    </div>
            
                    <!--Today order  Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4 text-center vtopCard">
                        <div class="card border-left-info shadow h-100 py-4">
            
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"> {{ __('translate.Monthly Product Count') }}
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800" id="dailyPurchaseCard">{{ $data['dailyProductCount'] }}</div>
                                    </div>
            
                                </div>
                            </div>
                        </div>
                    </div>
            
                    <!-- Today item selll Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4 text-center topCard">
                        <div class="card border-left-info shadow h-100 py-4">
            
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"> {{ __('translate.Monthly Cost') }}
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800" id="dailyExpenseCard"> {{ $data['dailyCost'] }} </div>
                                    </div>
            
                                </div>
                            </div>
                        </div>
                    </div>
            
                    <!-- Today sell Amount Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4 text-center topCard">
                        <div class="card border-left-info shadow h-100 py-4">
            
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"> {{ __('translate.Monthly Amount') }}</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800" id="dailyProfitCard"> {{ $data['dailyAmount'] }}</div>
                                    </div>
            
                                </div>
                            </div>
                        </div>
                    </div>
            
                    <!-- Today sell Amount Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4 text-center topCard">
                        <div class="card border-left-info shadow h-100 py-4">
            
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"> {{ __('translate.Monthly Discount') }}</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800" id="dailyProfitCard">{{ $data['dailyDiscount'] }}</div>
                                    </div>
            
                                </div>
                            </div>
                        </div>
                    </div>
            
                    <!-- Today sell Amount Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4 text-center topCard">
                        <div class="card border-left-info shadow h-100 py-4">
            
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"> {{ __('translate.Monthly Return') }}</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800" id="dailyProfitCard">{{ $data['dailyReturn'] }}</div>
                                    </div>
            
                                </div>
                            </div>
                        </div>
                    </div>
            
                    <!-- Today sell Amount Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4 text-center topCard">
                        <div class="card border-left-info shadow h-100 py-4">
            
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"> {{ __('translate.Monthly Due') }}</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800" id="dailyProfitCard">{{ $data['dailyDue'] }}</div>
                                    </div>
            
                                </div>
                            </div>
                        </div>
                    </div>
            
                    <!-- Today sell Amount Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4 text-center topCard">
                        <div class="card border-left-info shadow h-100 py-4">
            
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"> {{ __('translate.Monthly Cash Received') }}</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800" id="dailyProfitCard">{{ $data['dailyCashReceived'] }}</div>
                                    </div>
            
                                </div>
                            </div>
                        </div>
                    </div>







                </div>
                
                <div class="row p-2">
                    
                    <div class="col-12 col-md-6 p-0 p-md-4">

                        <x-line-chart :dataArray="$data['dailyCountGraph']" id="dailyCountGraph" />
                        
                    </div>
                    
                    <div class="col-12 col-md-6 p-0 p-md-4">

                        <x-line-chart :dataArray="$data['dailyProductCountGraph']" id="dailyProductCountGraph" />
                        
                    </div>
                    
                    <div class="col-12 col-md-6 p-0 p-md-4">

                        <x-line-chart :dataArray="$data['dailyCostGraph']" id="dailyCostGraph" />
                        
                    </div>
                    
                    <div class="col-12 col-md-6 p-0 p-md-4">

                        <x-line-chart :dataArray="$data['dailyAmountGraph']" id="dailyAmountGraph" />
                        
                    </div>
                    
                    <div class="col-12 col-md-6 p-0 p-md-4">

                        <x-line-chart :dataArray="$data['dailyDiscountGraph']" id="dailyDiscountGraph" />
                        
                    </div>
                    
                    <div class="col-12 col-md-6 p-0 p-md-4">

                        <x-line-chart :dataArray="$data['dailyReturnGraph']" id="dailyReturnGraph" />
                        
                    </div>
                    
                    <div class="col-12 col-md-6 p-0 p-md-4">

                        <x-line-chart :dataArray="$data['dailyDueGraph']" id="dailyDueGraph" />
                        
                    </div>
                    
                    <div class="col-12 col-md-6 p-0 p-md-4">

                        <x-line-chart :dataArray="$data['dailyCashReceivedGraph']" id="dailyCashReceivedGraph" />
                        
                    </div>

                </div>



            </div>
            {{-- Monthly --}}
            <div class="tab-pane fade pt-4 p-2" id="monthly" role="tabpanel" aria-labelledby="monthly-tab">

                <div class="row">

                    <!-- Growth Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4 text-center topCard">
                        <div class="card border-left-info shadow h-100 py-4">
            
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">{{ __('translate.Yearly Sell Count') }}</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800" id="dailySellCard">{{ $data['monthlyCount'] }}</div>
                                    </div>
            
                                </div>
                            </div>
                        </div>
                    </div>
            
                    <!--Today order  Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4 text-center vtopCard">
                        <div class="card border-left-info shadow h-100 py-4">
            
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">{{ __('translate.Yearly Product Count') }}
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800" id="dailyPurchaseCard">{{ $data['monthlyProductCount'] }}</div>
                                    </div>
            
                                </div>
                            </div>
                        </div>
                    </div>
            
                    <!-- Today item selll Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4 text-center topCard">
                        <div class="card border-left-info shadow h-100 py-4">
            
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"> {{ __('translate.Yearly Cost') }}
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800" id="dailyExpenseCard"> {{ $data['monthlyCost'] }} </div>
                                    </div>
            
                                </div>
                            </div>
                        </div>
                    </div>
            
                    <!-- Today sell Amount Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4 text-center topCard">
                        <div class="card border-left-info shadow h-100 py-4">
            
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">{{ __('translate.Yearly Amount') }}</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800" id="dailyProfitCard"> {{ $data['monthlyAmount'] }}</div>
                                    </div>
            
                                </div>
                            </div>
                        </div>
                    </div>
            
                    <!-- Today sell Amount Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4 text-center topCard">
                        <div class="card border-left-info shadow h-100 py-4">
            
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"> {{ __('translate.Yearly Discount') }}</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800" id="dailyProfitCard">{{ $data['monthlyDiscount'] }}</div>
                                    </div>
            
                                </div>
                            </div>
                        </div>
                    </div>
            
                    <!-- Today sell Amount Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4 text-center topCard">
                        <div class="card border-left-info shadow h-100 py-4">
            
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"> {{ __('translate.Yearly Return') }}</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800" id="dailyProfitCard">{{ $data['monthlyReturn'] }}</div>
                                    </div>
            
                                </div>
                            </div>
                        </div>
                    </div>
            
                    <!-- Today sell Amount Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4 text-center topCard">
                        <div class="card border-left-info shadow h-100 py-4">
            
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"> {{ __('translate.Yearly Due') }}</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800" id="dailyProfitCard">{{ $data['monthlyDue'] }}</div>
                                    </div>
            
                                </div>
                            </div>
                        </div>
                    </div>
            
                    <!-- Today sell Amount Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4 text-center topCard">
                        <div class="card border-left-info shadow h-100 py-4">
            
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"> {{ __('translate.Yearly Cash Received') }}</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800" id="dailyProfitCard">{{ $data['monthlyCashReceived'] }}</div>
                                    </div>
            
                                </div>
                            </div>
                        </div>
                    </div>







                </div>
                
                <div class="row p-2">
                    
                    <div class="col-12 col-md-6 p-0 p-md-4">

                        <x-line-chart :dataArray="$data['monthlyCountGraph']" id="monthlyCountGraph" />
                        
                    </div>
                    
                    <div class="col-12 col-md-6 p-0 p-md-4">

                        <x-line-chart :dataArray="$data['monthlyProductCountGraph']" id="monthlyProductCountGraph" />
                        
                    </div>
                    
                    <div class="col-12 col-md-6 p-0 p-md-4">

                        <x-line-chart :dataArray="$data['monthlyCostGraph']" id="monthlyCostGraph" />
                        
                    </div>
                    
                    <div class="col-12 col-md-6 p-0 p-md-4">

                        <x-line-chart :dataArray="$data['monthlyAmountGraph']" id="monthlyAmountGraph" />
                        
                    </div>
                    
                    <div class="col-12 col-md-6 p-0 p-md-4">

                        <x-line-chart :dataArray="$data['monthlyDiscountGraph']" id="monthlyDiscountGraph" />
                        
                    </div>
                    
                    <div class="col-12 col-md-6 p-0 p-md-4">

                        <x-line-chart :dataArray="$data['monthlyReturnGraph']" id="monthlyReturnGraph" />
                        
                    </div>
                    
                    <div class="col-12 col-md-6 p-0 p-md-4">

                        <x-line-chart :dataArray="$data['monthlyDueGraph']" id="monthlyDueGraph" />
                        
                    </div>
                    
                    <div class="col-12 col-md-6 p-0 p-md-4">

                        <x-line-chart :dataArray="$data['monthlyCashReceivedGraph']" id="monthlyCashReceivedGraph" />
                        
                    </div>

                </div>


            </div>

            {{-- Yearly --}}
            <div class="tab-pane fade pt-4 p-2" id="yearly" role="tabpanel" aria-labelledby="yearly-tab">


                <div class="row">

                    <!-- Growth Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4 text-center topCard">
                        <div class="card border-left-info shadow h-100 py-4">
            
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"> {{ __('translate.Total Sell Count') }}</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800" id="dailySellCard">{{ $data['yearlyCount'] }}</div>
                                    </div>
            
                                </div>
                            </div>
                        </div>
                    </div>
            
                    <!--Today order  Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4 text-center vtopCard">
                        <div class="card border-left-info shadow h-100 py-4">
            
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"> {{ __('translate.Total Product Count') }}
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800" id="dailyPurchaseCard">{{ $data['yearlyProductCount'] }}</div>
                                    </div>
            
                                </div>
                            </div>
                        </div>
                    </div>
            
                    <!-- Today item selll Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4 text-center topCard">
                        <div class="card border-left-info shadow h-100 py-4">
            
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"> {{ __('translate.Total Cost') }}
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800" id="dailyExpenseCard"> {{ $data['yearlyCost'] }} </div>
                                    </div>
            
                                </div>
                            </div>
                        </div>
                    </div>
            
                    <!-- Today sell Amount Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4 text-center topCard">
                        <div class="card border-left-info shadow h-100 py-4">
            
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"> {{ __('translate.Total Amount') }}</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800" id="dailyProfitCard"> {{ $data['yearlyAmount'] }}</div>
                                    </div>
            
                                </div>
                            </div>
                        </div>
                    </div>
            
                    <!-- Today sell Amount Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4 text-center topCard">
                        <div class="card border-left-info shadow h-100 py-4">
            
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"> {{ __('translate.Total Discount') }}</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800" id="dailyProfitCard">{{ $data['yearlyDiscount'] }}</div>
                                    </div>
            
                                </div>
                            </div>
                        </div>
                    </div>
            
                    <!-- Today sell Amount Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4 text-center topCard">
                        <div class="card border-left-info shadow h-100 py-4">
            
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"> {{ __('translate.Total Return') }}</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800" id="dailyProfitCard">{{ $data['yearlyReturn'] }}</div>
                                    </div>
            
                                </div>
                            </div>
                        </div>
                    </div>
            
                    <!-- Today sell Amount Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4 text-center topCard">
                        <div class="card border-left-info shadow h-100 py-4">
            
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">{{ __('translate.Total Due') }}</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800" id="dailyProfitCard">{{ $data['yearlyDue'] }}</div>
                                    </div>
            
                                </div>
                            </div>
                        </div>
                    </div>
            
                    <!-- Today sell Amount Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4 text-center topCard">
                        <div class="card border-left-info shadow h-100 py-4">
            
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">{{ __('translate.Total Cash Received') }}</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800" id="dailyProfitCard">{{ $data['yearlyCashReceived'] }}</div>
                                    </div>
            
                                </div>
                            </div>
                        </div>
                    </div>







                </div>
                
                <div class="row p-2">
                    
                    <div class="col-12 col-md-6 p-0 p-md-4">

                        <x-line-chart :dataArray="$data['yearlyCountGraph']" id="yearlyCountGraph" />
                        
                    </div>
                    
                    <div class="col-12 col-md-6 p-0 p-md-4">

                        <x-line-chart :dataArray="$data['yearlyProductCountGraph']" id="yearlyProductCountGraph" />
                        
                    </div>
                    
                    <div class="col-12 col-md-6 p-0 p-md-4">

                        <x-line-chart :dataArray="$data['yearlyCostGraph']" id="yearlyCostGraph" />
                        
                    </div>
                    
                    <div class="col-12 col-md-6 p-0 p-md-4">

                        <x-line-chart :dataArray="$data['yearlyAmountGraph']" id="yearlyAmountGraph" />
                        
                    </div>
                    
                    <div class="col-12 col-md-6 p-0 p-md-4">

                        <x-line-chart :dataArray="$data['yearlyDiscountGraph']" id="yearlyDiscountGraph" />
                        
                    </div>
                    
                    <div class="col-12 col-md-6 p-0 p-md-4">

                        <x-line-chart :dataArray="$data['yearlyReturnGraph']" id="yearlyReturnGraph" />
                        
                    </div>
                    
                    <div class="col-12 col-md-6 p-0 p-md-4">

                        <x-line-chart :dataArray="$data['yearlyDueGraph']" id="yearlyDueGraph" />
                        
                    </div>
                    
                    <div class="col-12 col-md-6 p-0 p-md-4">

                        <x-line-chart :dataArray="$data['yearlyCashReceivedGraph']" id="yearlyCashReceivedGraph" />
                        
                    </div>

                </div>


            </div>
          </div>

    </div>
</div>




<script>

    $(document).ready(function(){
        var month = @json($data['month']);
        var year = @json($data['year']);
        $('#daily-tab').on('click',function(){
            $('#monthOrYear').text('('+month+')');
            $('#searchByMonth').html('');
            var html = '';
            html+= '<div><form method="get"> <div class="form-row align-items-center"> <div class="col-auto">'+'{{ __("translate.Select A Month") }} '+' </div><div class="col-auto"> <input type="month" name="month"  class="form-control mb-2" id="inlineFormInput" required>';
            html+='</div><div class="col-auto"> <button type="submit" class="btn btn-primary mt-3"  >{{ __("translate.Submit") }}</button> </div>  </div> </form></div>';
            $('#searchByMonth').html(html);
        });
        
        $('#monthly-tab').on('click',function(){
            
            $('#monthOrYear').text('('+year+')');
            $('#searchByMonth').html('');
            var html = '';
            html+= '<div><form method="get"> <div class="form-row align-items-center"> <div class="col-auto">'+'{{ __("translate.Enter A Year") }} '+' </div><div class="col-auto"> <input type="number" name="year" placeholder="YYYY" min="2017" max="2100"  class="form-control mb-2" id="inlineFormInput" required>';
            html+='</div><div class="col-auto"> <button type="submit" class="btn btn-primary mt-3"  >{{ __("translate.Submit") }}</button> </div>  </div> </form></div>';
            $('#searchByMonth').html(html);
        });

        $('#yearly-tab').on('click',function(){
            $('#monthOrYear').text('');
            var html = '';
            $('#searchByMonth').html(html);
        });
    });


</script>


@endsection
