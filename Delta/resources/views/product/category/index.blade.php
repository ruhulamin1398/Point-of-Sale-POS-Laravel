
@extends('includes.app')


@section('content')




<x-data-table
:items="$items"
:routes="$routes"
:componentDetails="$componentDetails"
:settings="$settings"

/>


 
@endsection