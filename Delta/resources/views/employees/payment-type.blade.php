@extends('includes.app')


@section('content')


<x-data-table :fieldList="$fieldList" :items="$items" :routes="$routes" :componentDetails="$componentDetails" />

<!--   This Page is only readable or not -->
<script>
    $(document).ready(function() {

        $('body').on('click', '#AddNewFormButton', function() {
           alert("Can't Add data here");

        });

    });
</script>



@endsection