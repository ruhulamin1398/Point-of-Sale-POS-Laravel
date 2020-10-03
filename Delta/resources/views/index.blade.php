
@extends('includes.app')


@section('content')




<x-data-table
:fieldList="$fieldList"
:items="$items"
:routes="$routes"
:componentDetails="$componentDetails"

/>


 
@endsection