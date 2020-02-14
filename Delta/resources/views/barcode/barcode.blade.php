@extends('layout.app')
@section('content')


<!-- Content Row -->
<div class="container-fluid ">

    <div class="row ">

        <!-- main body start -->
        <div class="col-xl-8 col-lg-8 col-md-8   ">


            <div class="card mb-4 shadow">

                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Print barcode</h6>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('barcode_print') }}">
                        @csrf
                        <div class="form-row align-items-center">

        

                            <div class="col-auto">
                                <span class="text-dark pl-2"> Code</span>
                                <input type="text" name="id"  class="form-control mb-2" required >
                            </div>

                            <div class="col-auto">

                                <span class="text-dark pl-2"> Amount</span>
                                <input type="number" name="amount" class="form-control mb-2" required>
                            </div>


                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary mt-3"  >Submit</button>
                            </div>

                        </div>

                    </form>
                </div>
            </div>




            

        </div>

    </div>

    <!-- Content Row -->




    @endsection