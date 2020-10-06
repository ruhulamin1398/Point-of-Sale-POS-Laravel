@extends('includes.app')


@section('content')

<!-- Front-end must change according to employee selection -->






<x-data-table :fieldList="$fieldList" :items="$items" :routes="$routes" :componentDetails="$componentDetails" />


<script>
    $(document).ready(function() {

        $('body').on('click', '#AddNewFormButton', function() {
            $('#PlusButton').toggleClass('fa-plus').toggleClass('fa-minus');    
                
        });

    });
</script>



@endsection