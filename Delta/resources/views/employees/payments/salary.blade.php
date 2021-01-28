
@extends('includes.app')

@section('content')


<x-data-table
:dataArray="$dataArray"

/>



<script>
    $(document).ready(function(){

        var html = '';
        html+= '<div><form method="get"> <div class="form-row align-items-center"> <div class="col-auto">'+'{{ __("Select A Month") }} '+' </div><div class="col-auto"> <input type="month" name="month"  class="form-control mb-2" id="inlineFormInput" required>';
        html+='</div><div class="col-auto"> <button type="submit" class="btn btn-primary mt-3"  >{{ __("Submit") }}</button> </div>  </div> </form></div>';



       

        $('#searchByMonth').html(html);
        


    })
</script>

@endsection
