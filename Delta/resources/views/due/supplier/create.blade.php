@extends('includes.app')
@section('content')


@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ __('translate.'.$error) }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session()->has('success'))
<div class="alert alert-success">
    @if(is_array(session('success')))
        <ul>
            @foreach (session('success') as $message)
                <li>{{  __('translate.'.$message) }}</li>
            @endforeach
        </ul>
    @else
        {{ session('success') }}
    @endif
</div>
@endif


<!-- Content Row -->
<div class="container-fluid ">

    <div class="row ">

        <!-- main body start -->
        <div class="col-xl-8 col-lg-8 col-md-8   ">


            <div class="card mb-4 shadow">

                <div class="card-header bg-abasas-dark py-3">
                    <nav class="navbar navbar-dark">
                        <h6 class="m-0 font-weight-bold ">Due Pay</h6>
                        <a href="{{ route('supplier-due-pays.index') }}" class="text-light">  <button class="btn btn-success " id="create-button"> Due Paid List  </button></a>

                    </nav>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('supplier-due-pays.store') }}">
                        @csrf
                        <div class="form-row align-items-center">

                        
                                <input type="text" name="supplier_id" id="SupplierCashsupplierId" value=0 class="form-control mb-2" hidden>
                            
                            <div class="col-12 col-md-4">
                                <label for="SupplierCashAmount">Amount<span class="text-danger">*</span></label>
                                <input type="number" step="any" id="SupplierCashAmount" name="amount" class="form-control mb-2" required>
                            </div>

                            <div class="col-12 col-md-4">

                                <label for="comment">Comment</label>
                                <input type="text" name="comment" id="comment" class="form-control mb-2">
                            </div>


                            <div class="col-12 col-md-4">
                                <button type="submit" class="btn btn-primary btn-block mt-3" id="supplierCashPaySubmit">Submit</button>
                            </div>

                        </div>

                    </form>
                </div>
            </div>






        </div>

        <!-- Left Sidebar Start -->
        <div class="col-xl-4 col-lg-4 col-md-4   ">

            <x-supplier-phone />

        </div>
    </div>


    <!-- Content Row -->

   <script>
       $(document).ready(function(){
            $('#supplierCashPaySubmit').on('click',function(){
                var id = $('#supplier_input_id').val();
                $('#SupplierCashsupplierId').val(id);
            })
       });
   </script>



    @endsection