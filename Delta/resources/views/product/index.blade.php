
@extends('includes.app')

@section('content')




<x-data-table
:fieldList="$fieldList"
:fieldTitleList="$fieldTitleList"
:items="$items"
:routes="$routes"
:componentDetails="$componentDetails"

/>


 
@endsection