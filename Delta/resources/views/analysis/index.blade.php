
@extends('includes.app')


@section('content')


<h1 style="text-align: center">Sell Daily</h1> 
<x-bar-chart :dataArray="$sellAnalysisDaily" />
<h1 style="text-align: center">Sell Monthly</h1> 
<x-bar-chart :dataArray="$sellAnalysisMonthly" />
<h1 style="text-align: center">Amount Monthly</h1> 
<x-bar-chart :dataArray="$amountAnalysisMonthly" />
<h1 style="text-align: center">Amount Daily</h1> 
<x-bar-chart :dataArray="$amountAnalysisDaily" />

 
@endsection