
@extends('includes.app')

@section('content')


<x-data-table
:dataArray="$dataArray"

/>

<script>
    $(document).ready(function(){
        $('.dataDeleteItemClass').hide();


       var html= '<div> <nav class="navbar  "><div class="navbar-brand"> Month : {{ $month }}</div>  <div ><form method="get" ><div class="form-row align-items-center"><div class="col-auto">Select A Month</div> <div class="col-auto"> <input type="month" name="month"  class="form-control mb-2" id="monthFormInput" required>  </div> <div class="col-auto">  <button type="submit" class="btn btn-primary mt-3"  >Submit</button>   </div> </div></form></div></nav></div>';


        $('#AddNewFormButtonDiv').parent().parent().append(html);
    });
</script>


@endsection

