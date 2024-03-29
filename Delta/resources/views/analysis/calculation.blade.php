@extends('includes.app')


@section('content')



<div class="container-fluid  p-0">
    <div class="card mb-4 shadow">

        <div class="card-header py-3 bg-abasas-dark">
            <nav class="navbar  ">

                <div class="navbar-brand">
                     {{ __('translate.Calculation Analysis') }} <span id="monthOrYear"> ({{ $data['month'] }})</span>@can('Super Admin') <i class="fas fa-tools pl-2"
                     id="pageSetting" data-toggle="modal" data-target="#setting-modal"></i> @endcan
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
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">{{ __('translate.Monthly Buy') }}</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800" id="dailySellCard">{{ $data['dailyBuy'] }}</div>
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
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">{{ __('translate.Monthly Sell') }}
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800" id="dailyPurchaseCard">{{ $data['dailySell'] }}</div>
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
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">{{ __('translate.Monthly Sell Profit') }}
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800" id="dailyExpenseCard"> {{ $data['dailySellProfit'] }} </div>
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
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">{{ __('translate.Monthly Profit') }}</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800" id="dailyProfitCard"> {{ $data['dailySellProfit'] }}</div>
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
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"> {{ __('translate.Monthly Drop') }}</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800" id="dailyProfitCard">{{ $data['dailyDrop'] }}</div>
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
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">{{ __('translate.Monthly Expense') }}</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800" id="dailyProfitCard">{{ $data['dailyExpense'] }}</div>
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
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"> {{ __('translate.Monthly Payment') }}</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800" id="dailyProfitCard">{{ $data['dailyPayment'] }}</div>
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
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">{{ __('translate.Monthly Tax') }}</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800" id="dailyProfitCard">{{ $data['dailyTax'] }}</div>
                                    </div>
            
                                </div>
                            </div>
                        </div>
                    </div>







                </div>

                <div class="row p-2">
                    
                    <div class="col-12 col-md-6 p-0 p-md-4">

                        <x-line-chart :dataArray="$data['dailyBuyGraph']" id="dailyBuyGraph" />
                        
                    </div>
                    
                    <div class="col-12 col-md-6 p-0 p-md-4">

                        <x-line-chart :dataArray="$data['dailySellGraph']" id="dailySellGraph" />
                        
                    </div>
                    
                    <div class="col-12 col-md-6 p-0 p-md-4">

                        <x-line-chart :dataArray="$data['dailySellProfitGraph']" id="dailySellProfitGraph" />
                        
                    </div>
                    
                    <div class="col-12 col-md-6 p-0 p-md-4">

                        <x-line-chart :dataArray="$data['dailyProfitGraph']" id="dailyProfitGraph" />
                        
                    </div>
                    
                    <div class="col-12 col-md-6 p-0 p-md-4">

                        <x-line-chart :dataArray="$data['dailyDropGraph']" id="dailyDropGraph" />
                        
                    </div>
                    
                    <div class="col-12 col-md-6 p-0 p-md-4">

                        <x-line-chart :dataArray="$data['dailyExpenseGraph']" id="dailyExpenseGraph" />
                        
                    </div>
                    
                    <div class="col-12 col-md-6 p-0 p-md-4">

                        <x-line-chart :dataArray="$data['dailyPaymentGraph']" id="dailyPaymentGraph" />
                        
                    </div>
                    
                    <div class="col-12 col-md-6 p-0 p-md-4">

                        <x-line-chart :dataArray="$data['dailyTaxGraph']" id="dailyTaxGraph" />
                        
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
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"> {{ __('translate.Yearly Buy') }}</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800" id="monthlySellCard">{{ $data['monthlyBuy'] }}</div>
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
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">{{ __('translate.Yearly Sell') }}
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800" id="monthlyPurchaseCard">{{ $data['monthlySell'] }}</div>
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
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"> {{ __('translate.Yearly Sell Profit') }}
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800" id="monthlyExpenseCard">{{ $data['monthlySellProfit'] }} </div>
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
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"> {{ __('translate.Yearly Profit') }}</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800" id="monthlyProfitCard">{{ $data['monthlyProfit'] }}</div>
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
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"> {{ __('translate.Yearly Drop') }}</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800" id="monthlyProfitCard">{{ $data['monthlySellProfit'] }}</div>
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
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">{{ __('translate.Yearly Expense') }}</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800" id="monthlyProfitCard">{{ $data['monthlyDrop'] }}</div>
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
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">{{ __('translate.Yearly Payment') }}</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800" id="monthlyProfitCard">{{ $data['monthlyExpense'] }}</div>
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
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"> {{ __('translate.Yearly Tax') }}</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800" id="monthlyProfitCard">{{ $data['monthlyTax'] }}</div>
                                    </div>
            
                                </div>
                            </div>
                        </div>
                    </div>



                </div>
                
                <div class="row p-2">
                    
                    <div class="col-12 col-md-6 p-0 p-md-4">

                        <x-line-chart :dataArray="$data['monthlyBuyGraph']" id="monthlyBuyGraph" />
                        
                    </div>
                    
                    <div class="col-12 col-md-6 p-0 p-md-4">

                        <x-line-chart :dataArray="$data['monthlySellGraph']" id="monthlySellGraph" />
                        
                    </div>
                    
                    <div class="col-12 col-md-6 p-0 p-md-4">

                        <x-line-chart :dataArray="$data['monthlySellProfitGraph']" id="monthlySellProfitGraph" />
                        
                    </div>
                    
                    <div class="col-12 col-md-6 p-0 p-md-4">

                        <x-line-chart :dataArray="$data['monthlyProfitGraph']" id="monthlyProfitGraph" />
                        
                    </div>
                    
                    <div class="col-12 col-md-6 p-0 p-md-4">

                        <x-line-chart :dataArray="$data['monthlyDropGraph']" id="monthlyDropGraph" />
                        
                    </div>
                    
                    <div class="col-12 col-md-6 p-0 p-md-4">

                        <x-line-chart :dataArray="$data['monthlyExpenseGraph']" id="monthlyExpenseGraph" />
                        
                    </div>
                    
                    <div class="col-12 col-md-6 p-0 p-md-4">

                        <x-line-chart :dataArray="$data['monthlyPaymentGraph']" id="monthlyPaymentGraph" />
                        
                    </div>
                    
                    <div class="col-12 col-md-6 p-0 p-md-4">

                        <x-line-chart :dataArray="$data['monthlyTaxGraph']" id="monthlyTaxGraph" />
                        
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
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"> {{ __('translate.Total Buy') }}</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800" id="YearlySellCard">{{ $data['yearlyBuy'] }}</div>
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
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"> {{ __('translate.Total Sell') }}
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"  id="YearlyPurchaseCard">{{ $data['yearlySell'] }}</div>
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
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"> {{ __('translate.Total Sell Profit') }}
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"  id="YearlyExpenseCard">{{ $data['yearlySellProfit'] }} </div>
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
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"> {{ __('translate.Total Profit') }}</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"  id="YearlyProfitCard">{{ $data['yearlyProfit'] }}</div>
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
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"> {{ __('translate.Total Drop') }}</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"  id="YearlyProfitCard">{{ $data['yearlyDrop'] }}</div>
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
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"> {{ __('translate.Total Expense') }} </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"  id="YearlyProfitCard">{{ $data['yearlyExpense'] }}</div>
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
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"> {{ __('translate.Total Payment') }}</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"  id="YearlyProfitCard">{{ $data['yearlyPayment'] }}</div>
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
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"> {{ __('translate.Total Tax') }}</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"  id="YearlyProfitCard">{{ $data['yearlyTax'] }}</div>
                                    </div>
            
                                </div>
                            </div>
                        </div>
                    </div>



                </div>
                
                <div class="row p-2">
                    
                    <div class="col-12 col-md-6 p-0 p-md-4">

                        <x-line-chart :dataArray="$data['yearlyBuyGraph']" id="yearlyBuyGraph" />
                        
                    </div>
                    
                    <div class="col-12 col-md-6 p-0 p-md-4">

                        <x-line-chart :dataArray="$data['yearlySellGraph']" id="yearlySellGraph" />
                        
                    </div>
                    
                    <div class="col-12 col-md-6 p-0 p-md-4">

                        <x-line-chart :dataArray="$data['yearlySellProfitGraph']" id="yearlySellProfitGraph" />
                        
                    </div>
                    
                    <div class="col-12 col-md-6 p-0 p-md-4">

                        <x-line-chart :dataArray="$data['yearlyProfitGraph']" id="yearlyProfitGraph" />
                        
                    </div>
                    
                    <div class="col-12 col-md-6 p-0 p-md-4">

                        <x-line-chart :dataArray="$data['yearlyDropGraph']" id="yearlyDropGraph" />
                        
                    </div>
                    
                    <div class="col-12 col-md-6 p-0 p-md-4">

                        <x-line-chart :dataArray="$data['yearlyExpenseGraph']" id="yearlyExpenseGraph" />
                        
                    </div>
                    
                    <div class="col-12 col-md-6 p-0 p-md-4">

                        <x-line-chart :dataArray="$data['yearlyPaymentGraph']" id="yearlyPaymentGraph" />
                        
                    </div>
                    
                    <div class="col-12 col-md-6 p-0 p-md-4">

                        <x-line-chart :dataArray="$data['yearlyTaxGraph']" id="yearlyTaxGraph" />
                        
                    </div>

                </div>


            </div>
          </div>

    </div>
</div>






@can('Super Admin')

 <!-- Attachment Modal -->
 <div class="modal fade" id="setting-modal" tabindex="-1" role="dialog" aria-labelledby="setting-modal-label"
     aria-hidden="true">
     <div class="modal-dialog modal-lg" role="document">
         <div class="modal-content">
             <div class="modal-header bg-abasas-dark">

                <nav class="navbar navbar-light  ">
                    <a class="navbar-brand">{{__('translate.Permission')}}</a>
    
                </nav>
                
            <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;</span>
            </button>

             </div>
             <form action="{{ route('rolepermissionstore') }}" method="post">
                @csrf
                <input type="text" name="page_name" value="Calculation Analysis" required hidden>
             <div class="modal-body" >


                
                <div class="table-responsive">
                    <table class="table table-striped table-bordered"  width="100%"
                        cellspacing="0">
                        <thead class="bg-abasas-dark">

                            <tr>

                                <th>{{ __('translate.Permission') }} </th>

                                @for ($i=1 ; $i<5 ; $i++) <th>{{ $roles[$i]->name }}</th>
                                    @endfor
                            </tr>
                        </thead>


                        <tbody>


                            @php
                            $permision_name = "Calculation Analysis Page";
                            @endphp
                            
                            <tr class="data-row">
                                <td class="iteration">{{ __('translate.Page Access') }}</td>
                                @for ($i=1 ; $i<5 ; $i++) <td
                                    class="word-break name justify-content-center">
                                    <label class="checkbox-inline"><input type="checkbox"
                                            name="page{{ $i }}"
                                            @if($roles[$i]->hasPermissionTo($permision_name)) checked
                                        @endif></label>
                                    </td>
                                    @endfor

                            </tr>

                        </tbody>



                    </table>
                </div>

             </div>

             <div class="modal-footer">
                <button type="submit"
                                 class="btn bg-abasas-dark btn-block form-control  ">{{ __('translate.Save')  }}</button>
            </div>
             </form>
         </div>
     </div>
 </div>


@endcan






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
