@extends('includes.app')


@section('content')



<div class="container-fluid  p-0">
    <div class="row">

        <!-- Growth Card Example -->
        <div class="col-xl-3 col-md-6 mb-4 text-center topCard">
            <div class="card border-left-primary shadow h-100 py-4">

                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Today's Sell</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $sell }}</div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!--Today order  Card Example -->
        <div class="col-xl-3 col-md-6 mb-4 text-center vtopCard">
            <div class="card border-left-success shadow h-100 py-4">

                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Today's Purchase
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $purchase }}</div>
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
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Today's Expense
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $expense }} </div>
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
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Today's Profit</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $profit }}</div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card mb-4 shadow">



        <div class="card-header py-3 bg-abasas-dark">
            <nav class="navbar navbar-dark ">
                <a class="navbar-brand">Daily Sell</a>

                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                    <label class="btn btn-outline-info active" id="dailySellBar">
                        <input type="radio" name="options"  autocomplete="off" checked> Bar Chart
                    </label>
                    <label class="btn btn-outline-success" id="dailySellline">
                        <input type="radio" name="options"  autocomplete="off"> Line Chart
                    </label>
                </div>
            </nav>
        </div>

        <div class="card-body" id="sellDailylbar">
            <x-bar-chart :dataArray="$sellAnalysisDaily" id='sellAnalysisDailyBar' />
        </div>
        <div class="card-body" id="sellDailylLine" style="display: none;">
            <x-line-chart :dataArray="$sellAnalysisDaily" id='sellAnalysisDailyLine' />
        </div>







        <div class="card-header py-3 bg-abasas-dark">
            <nav class="navbar navbar-dark ">
                <a class="navbar-brand">Monthly Sell</a>
                
                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                    <label class="btn btn-outline-info active" id="monthlySellBar">
                        <input type="radio" name="options"  autocomplete="off" checked> Bar Chart
                    </label>
                    <label class="btn btn-outline-success" id="monthlySellline">
                        <input type="radio" name="options"  autocomplete="off"> Line Chart
                    </label>
                </div>
            </nav>
        </div>
        
        <div class="card-body" id="sellMonthlylbar">
            <x-bar-chart :dataArray="$sellAnalysisMonthly" id='sellAnalysisMonthlyBar' />
        </div>
        <div class="card-body" id="sellMonthlylLine" style="display: none;">
            <x-line-chart :dataArray="$sellAnalysisMonthly" id='sellAnalysisMonthlyLine' />
        </div>





        <div class="card-header py-3 bg-abasas-dark">
            <nav class="navbar navbar-dark ">
                <a class="navbar-brand">Calculations Daily</a>
                
                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                    <label class="btn btn-outline-info active" id="dailyAmountBar">
                        <input type="radio" name="options"  autocomplete="off" checked> Bar Chart
                    </label>
                    <label class="btn btn-outline-success" id="dailyAmountLine">
                        <input type="radio" name="options"  autocomplete="off"> Line Chart
                    </label>
                </div>
            </nav>
        </div>
        
        <div class="card-body" id="amountDailylbar">
            <x-bar-chart :dataArray="$amountAnalysisDaily" id='amountAnalysisDailyBar' />
        </div>
        <div class="card-body" id="amountDailyline" style="display: none;">
            <x-line-chart :dataArray="$amountAnalysisDaily" id='amountAnalysisDailyLine' />
        </div>





        <div class="card-header py-3 bg-abasas-dark">
            <nav class="navbar navbar-dark ">
                <a class="navbar-brand">Calculations Monthly</a>
                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                    <label class="btn btn-outline-info active" id="monthlyAmountBar">
                        <input type="radio" name="options"  autocomplete="off" checked> Bar Chart
                    </label>
                    <label class="btn btn-outline-success" id="monthlyAmountLine">
                        <input type="radio" name="options"  autocomplete="off"> Line Chart
                    </label>
                </div>
            </nav>
        </div>
        
        <div class="card-body" id="amountMonthlylbar">
            <x-bar-chart :dataArray="$amountAnalysisMonthly" id='amountAnalysisMonthlyBar' />
        </div>
        <div class="card-body" id="amountMonthlyline" style="display: none;">
            <x-line-chart :dataArray="$amountAnalysisMonthly" id='amountAnalysisMonthlyLine' />
        </div>




    </div>
</div>


<script>
    $(document).ready(function(){

        // daily sell
        $('#dailySellBar').on('click',function(){
            $('#sellDailylLine').hide();
            $('#sellDailylbar').show();
            
        });
        $('#dailySellline').on('click',function(){
            $('#sellDailylbar').hide();
            $('#sellDailylLine').show();
        });

        //monthly sell

        $('#monthlySellBar').on('click',function(){
            $('#sellMonthlylLine').hide();
            $('#sellMonthlylbar').show();
            
        });
        $('#monthlySellline').on('click',function(){
            $('#sellMonthlylbar').hide();
            $('#sellMonthlylLine').show();
        });

        
        // daily amount
        $('#dailyAmountBar').on('click',function(){
            $('#amountDailyline').hide();
            $('#amountDailylbar').show();
            
        });
        $('#dailyAmountLine').on('click',function(){
            $('#amountDailylbar').hide();
            $('#amountDailyline').show();
        });

        //monthly amount
        $('#monthlyAmountBar').on('click',function(){
            $('#amountMonthlyline').hide();
            $('#amountMonthlylbar').show();
            
        });
        $('#monthlyAmountLine').on('click',function(){
            $('#amountMonthlylbar').hide();
            $('#amountMonthlyline').show();
        });


    });

</script>



@endsection
