
@extends('includes.app')

@section('content')


<x-data-table
:dataArray="$dataArray"

/>

<script>
    $(document).ready(function(){
        $('#createNewForm').hide().removeClass('collapse');
        var html = '';
        html+= '<div><form method="get"> <div class="form-row align-items-center"> <div class="col-auto">'+' {{ __("translate.Select A Month") }}'+' </div><div class="col-auto"> <input type="month" name="month"  class="form-control mb-2" id="inlineFormInput" required>';
        html+='</div><div class="col-auto"> <button type="submit" class="btn btn-primary mt-3"  >{{ __("translate.Submit") }}</button> </div>  </div> </form></div>';
        $('#AddNewFormButtonDiv').html(html);
        $('.createLabel').hide();

    });
</script>

@endsection


