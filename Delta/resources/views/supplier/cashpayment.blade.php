@extends('layout.app')
@section('content')


<!-- Content Row -->
<div class="container-fluid ">

    <div class="row ">

        <!-- main body start -->
        <div class="col-xl-8 col-lg-8 col-md-8   ">


            <div class="card mb-4 shadow">

                <div class="card-header py-3">
                 
                    <nav class="navbar navbar-light">
         <h6 class="m-0 font-weight-bold text-primary">Cash Payment</h6>
                <button class="btn btn-success " id="create-button"> <a href="{{ route('supplier_paymnent_store_all') }} " class="text-light">Cash Receive</a> </button>
        
            </nav>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('supplier_paymnent_store') }}">
                        @csrf
                        <div class="form-row align-items-center">

                        <div class="col-auto">
                                <input type="text" name="supplier_id"  id="SupplierCashsupplierId" value=0 class="form-control mb-2" hidden >
                            </div>

                            <div class="col-auto">
                                <input type="text" name="pre_due"  id="SupplierCashsupplierPreviousDue" value=0 class="form-control mb-2" hidden >
                            </div>

                            <div class="col-auto">
                                <span class="text-dark pl-2"> Amount</span>
                                <input type="text" id="SupplierCashAmount" name="amount"  class="form-control mb-2" required >
                            </div>

                            <div class="col-auto">

                                <span class="text-dark pl-2"> Commment</span>
                                <input type="text" name="comment" class="form-control mb-2">
                            </div>


                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary mt-3" id="supplierCashReceiveSubmit" disabled="true" >Submit</button>
                            </div>

                        </div>

                    </form>
                </div>
            </div>




            

        </div>

        <!-- Left Sidebar Start -->
        <div class="col-xl-4 col-lg-4 col-md-4   ">



            <!-- Supplier Area Start -->
            <div class="col-xl-12 col-md-12 mb-4  text-center  bg-dark p-2 ">
                <div class="card border-none   bg-dark  h-100 p-2">
                    <h3 class="text-white">Supplier</h3>
                    <div class="card-body">
                        <div class="row no-gutters ">


                            <form method="GET" id="paymenmtSupplierForm">
                                @csrf
                                <div class="form-row ">
                                    <div class="col-auto">
                                        <form method="post">


                                            <div class=" col-auto">
                                                <label class="text-light" for="paymenmtSupplierPhoneField">Supplier Phone</label>
                                                <input type="text" name="phone" id="paymenmtSupplierPhoneField" class="form-control mb-2">
                                                <div class="text-danger text-small" id="paymenmtSupplierPhoneFieldLength">Enter a Valid Phone Number</div>
                                                <div class="text-danger text-small" id="paymenmtSupplierPhoneFieldNotFound">Supplier Not Found</div>
                                            </div>
                                            <input type=" number" name="efsd" hidden ">
                  </form>
                  </div>
                </div>
              </form>

            </div>
            <div class=" text-samall text-danger" id="purchasePageAddSupplierError">
                                    </div>

                                    <div id="paymenmtSupplierView">
                                        <div id="paymenmtSupplierName" class="text-light font-weight-bold"></div>
                                        <div id="paymenmtSupplierPhone" class="text-light "></div>
                                        <div id="purchasePageSupplieCompany" class="text-light "></div>
                                        <div id="paymenmtSupplierDue" class="text-danger font-weight-bold"></div>
                                    </div>


                                </div>

                        </div>
                    </div>
                    <!-- Growth Card Example -->
                </div>




                <!-- sumit Area Start -->




            </div>
            <!-- supplier area End  -->


        </div>
    </div>

    <!-- Content Row -->




    @endsection