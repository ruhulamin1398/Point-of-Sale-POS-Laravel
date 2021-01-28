
@extends('includes.app')

@section('content')


<x-data-table
:dataArray="$dataArray"

/>

<script>
    $(document).ready(function(){
      //  $('.dataDeleteItemClass').hide();


       var html= '<div> <nav class="navbar  "><div class="navbar-brand"> {{ __("translate.Month") }} : {{ $month }}</div>  <div ><form method="get" ><div class="form-row align-items-center"><div class="col-auto">{{ __("translate.Select A Month") }}</div> <div class="col-auto"> <input type="month" name="month"  class="form-control mb-2" id="monthFormInput" required>  </div> <div class="col-auto">  <button type="submit" class="btn btn-primary mt-3"  >{{ __("translate.Submit") }}</button>   </div> </div></form></div></nav></div>';


        $('#searchByMonth').parent().parent().append(html);
        // $('#searchByMonth').html(html);
    });
</script>


@endsection

