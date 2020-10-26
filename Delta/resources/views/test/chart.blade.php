
@extends('includes.app')


@section('content')


<h1 style="text-align: center">Pie Chart</h1> 
<x-pie-chart :dataArray="$dataArray" />
<h1 style="text-align: center">LIne Chart</h1> 


<x-line-chart :dataArray="$dataArray" />
<h1 style="text-align: center">Bar Chart</h1> 

<x-bar-chart :dataArray="$dataArray" />
<h1 style="text-align: center">Doughnut Chart</h1> 

<x-doughnut-chart :dataArray="$dataArray" />
<h1 style="text-align: center">Polar Area Chart</h1> 

<x-polar-area-chart :dataArray="$dataArray" />
{{-- <h1 style="text-align: center">Time Series Chart</h1> 

<x-time-series-chart :dataArray="$dataArray" />
 --}}

@endsection