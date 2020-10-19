
@extends('includes.app')

@section('content')


<!-- Begin Page Content -->
<div id="createNewDropProduct">
    <div class="card mb-4 shadow">

        <div class="card-header py-3  bg-abasas-dark ">
            <nav class="navbar navbar-dark">
                <a class="navbar-brand text-light"> {{ __('translate.Drop Product')  }}</a>
            </nav>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('drop_products.store') }}">
                @csrf
                <div class="form-row align-items-center" id="createFormDropProductList">
                  
                


                    

                   



                   

                </div>
                <div class="col-12">
                        <button type="submit" class="btn bg-abasas-dark mt-3">{{ __('translate.Submit')  }}</button>
                    </div>

            </form>
        </div>
    </div>
</div>

<x-data-table
:dataArray="$dataArray"

/>


<script>
    $(document).ready(function(){
        $('#createNewForm').hide().removeClass("collapse");
        $('#AddNewFormButtonDiv').hide();
        $('#componentDetailsTitle').text("Today's Dropped Products");
    });
</script>



@endsection


