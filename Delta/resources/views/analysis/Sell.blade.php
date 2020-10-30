
@extends('includes.app')


@section('content')



<h1 style="text-align: center">Bar Chart</h1> 
<x-bar-chart :dataArray="$dataArray" />

 
@endsection