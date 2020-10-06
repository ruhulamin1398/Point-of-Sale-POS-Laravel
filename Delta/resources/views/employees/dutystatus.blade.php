@extends('includes.app')


@section('content')


<x-data-table :fieldList="$fieldList" :items="$items" :routes="$routes" :componentDetails="$componentDetails" />



<script>
    $(document).ready(function() {

        $('body').on('click', '#AddNewFormButton', function() {
         alert("Can't Add Data here");

        });

    });
</script>



@endsection