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
                       Return Product 
                    </nav>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('customer_cash_receive_store') }}">
                        @csrf
                        <div class="form-row align-items-center">

                            <div class="col-auto">
                                <input type="text" name="customer_id" id="CustomerCashcustomerId" value=0 class="form-control mb-2" hidden>
                            </div>

                            <div class="col-auto">
                                <input type="text" name="pre_due" id="CustomerCashcustomerPreviousDue" value=0 class="form-control mb-2" hidden>
                            </div>


                            <div class="col-auto">
                <span class="text-dark  pl-2"> Product Id</span>
                <input type="text" name="product_id" id="orderProductInputId" size="10" value="" class="form-control  mb-2">
              </div>

              <div class="col-auto">
                <span class="text-dark  pl-2"> Product Name</span>
                <input type="text" name="name" id="orderProductInputName" size="20" value="" class="form-control  mb-2" disabled="true">
              </div>
                            <div class="col-auto">

                                <span class="text-dark pl-2"> Commment</span>
                                <input type="text" name="comment" class="form-control mb-2">
                            </div>
                            <div class="col-auto">

                                <span class="text-dark pl-2"> Commment</span>
                                <input type="text" name="comment" class="form-control mb-2">
                            </div>
                            <div class="col-auto">

                                <span class="text-dark pl-2"> Commment</span>
                                <input type="text" name="comment" class="form-control mb-2">
                            </div>
                            <div class="col-auto">

                                <span class="text-dark pl-2"> Commment</span>
                                <input type="text" name="comment" class="form-control mb-2">
                            </div>


                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary mt-3" id="customerCashReceiveSubmit" disabled="true">Submit</button>
                            </div>

                        </div>

                    </form>
                </div>
            </div>








            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <nav class="navbar navbar-light bg-light">
                        <a class="navbar-brand">Product Return list</a>

                    </nav>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="dataTable1" width="100%" cellspacing="0">
                            <thead class="thead-dark">


                                <tr>
                                    <th>#</th>
                                    <th>Ref</th>
                                    <th>Customer</th>
                                    <th>Product Id</th>
                                    <th>Product Name</th>
                                    <th>Price</th>
                                    <th>Profit</th>
                                </tr>
                            </thead>
                            <tfoot class="thead-dark">
                                <tr>

                                <tr>
                                    <th>#</th>
                                    <th>Ref</th>
                                    <th>Customer</th>
                                    <th>Product Id</th>
                                    <th>Product Name</th>
                                    <th>Price</th>
                                    <th>Profit</th>
                                </tr>
                                </tr>

                            </tfoot>
                            <tbody>
                                <?php $id = 1 ?>
                                @foreach ($orderReturnProducts as $orderReturnProduct)

                                <tr class="data-row">
                                    <td >{{$id++}}</td>
                                    <td >{{$orderReturnProduct->user->name}}</td>
                                    <td >{{$orderReturnProduct->customer->phone}}</td>
                                    <td >{{$orderReturnProduct->product_id}}</td>
                                    <td >{{$orderReturnProduct->product->name}}</td>
                                    <td >{{$orderReturnProduct->price}}</td>
                                    <td >{{$orderReturnProduct->profit}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>



                    </div>
                </div>
            </div>





        </div>

        <!-- Left Sidebar Start -->
        <div class="col-xl-4 col-lg-4 col-md-4   ">



            <!-- Supplier Area Start -->
            <div class="col-xl-12 col-md-12 mb-4  text-center  bg-dark p-2 ">
                <div class="card border-none   bg-dark  h-100 p-2">
                    <h3 class="text-white">Customer</h3>
                    <div class="card-body">
                        <div class="row no-gutters ">


                            <form method="GET" id="cashReceiveCustomerForm">
                                @csrf
                                <div class="form-row ">
                                    <div class="col-auto">
                                        <form method="post">


                                            <div class=" col-auto">
                                                <label class="text-light" for="cashReceiveCustomerPhoneField">Customer Phone</label>
                                                <input type="text" name="phone" id="cashReceiveCustomerPhoneField" class="form-control mb-2">
                                                <div class="text-danger text-small" id="cashReceiveCustomerPhoneFieldLength">Enter a Valid Phone Number</div>
                                                <div class="text-danger text-small" id="cashReceiveCustomerPhoneFieldNotFound">Customer Not Found</div>
                                            </div>
                                            <input type=" number" name="efsd" hidden ">
                  </form>
                  </div>
                </div>
              </form>

            </div>
            <div class=" text-samall text-danger" id="purchasePageAddSupplierError">
                                    </div>

                                    <div id="cashReceiveCustomerView">
                                        <div id="cashReceiveCustomerName" class="text-light font-weight-bold"></div>
                                        <div id="cashReceiveCustomerPhone" class="text-light "></div>
                                        <div id="purchasePageSupplieCompany" class="text-light "></div>
                                        <div id="cashReceiveCustomerDue" class="text-danger font-weight-bold"></div>
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