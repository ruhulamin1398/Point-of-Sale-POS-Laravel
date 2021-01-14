@extends('includes.app')
@section('content')


<!-- Content Row -->
<div class="container-fluid ">

    <div class="row ">

        <!-- main body start -->
        <div class="col-xl-8 col-lg-8 col-md-8   ">


            <div class="card mb-4 shadow">

                <div class="card-header py-3 bg-abasas-dark">
                    <nav class="navbar ">
                         পণ্য ফেরত
                    </nav>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('return_products.store') }}">
                        @csrf
                        <div class="form-row align-items-center">

                            <div class="col-auto">
                                <input type="text" name="customer_id" id="CustomerCashcustomerId" value=0 class="form-control mb-2" hidden>
                            </div>

                            <div class="col-auto">
                                <input type="text" name="pre_due" id="CustomerCashcustomerPreviousDue" value=0 class="form-control mb-2" hidden>
                            </div>


                            <div class="col-auto">
                                <span class="text-dark  pl-2"> পণ্যের আইডি</span>
                                <input type="text" name="product_id" id="orderProductInputId" size="10" value="" class="form-control  mb-2" required>
                            </div>

                            <div class="col-auto">
                                <span class="text-dark  pl-2"> পণ্যের নাম </span>
                                <input type="text" name="name" id="orderProductInputName" size="20" value="" class="form-control  mb-2" disabled="true" required>
                            </div>


                            <div class="col-auto">

                                <span class="text-dark pl-2"> পরিমান</span>
                                <input type="text" name="quantity" class="form-control mb-2" required>
                            </div>

                            <div class="col-auto">

                                <span class="text-dark pl-2"> মূল্য</span>
                                <input type="text" name="price" class="form-control mb-2" required>
                            </div>



                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary mt-3" id="customerCashReceiveSubmit" disabled="true"> সাবমিট</button>
                            </div>

                        </div>

                    </form>
                </div>
            </div>








            <div class="card shadow mb-4">
                <div class="card-header py-3 bg-abasas-dark">
                    <nav class="navbar navbar-light ">
                        <a class="navbar-brand">পণ্য ফেরতের লিস্ট</a>

                    </nav>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="dataTable1" width="100%" cellspacing="0">
                            <thead class="bg-abasas-dark">


                                <tr>
                                    <th>#</th>
                                    <th>রেফারেন্স</th>
                                    <th>ক্রেতা</th>
                                    <th>পণ্যের আইডি</th>
                                    <th>পণ্যের নাম</th>
                                    <th>পরিমান</th>
                                    <th>মূল্য</th>
                                </tr>
                            </thead>
                            <tfoot class="bg-abasas-dark">
                                <tr>

                                <tr>
                                <th>#</th>
                                    <th>রেফারেন্স</th>
                                    <th>ক্রেতা</th>
                                    <th>পণ্যের আইডি</th>
                                    <th>পণ্যের নাম</th>
                                    <th>পরিমান</th>
                                    <th>মূল্য</th>
                                </tr>
                                </tr>

                            </tfoot>
                            <tbody>
                                {{-- <?php $id = 1 ?>
                                @foreach ($orderReturnProducts as $orderReturnProduct)

                                <tr class="data-row">
                                    <td>{{$id++}}</td>
                                    <td>{{$orderReturnProduct->user->name}}</td>
                                    <td>{{$orderReturnProduct->customer->phone}}</td>
                                    <td>{{$orderReturnProduct->product_id}}</td>
                                    <td>{{$orderReturnProduct->product->name}}</td>
                                    <td>{{$orderReturnProduct->quantity}}</td>
                                    
                                    <td>{{$orderReturnProduct->price}}</td>
                                </tr>
                                @endforeach --}}
                            </tbody>
                        </table>



                    </div>
                </div>
            </div>





        </div>

        <!-- Left Sidebar Start -->
        <div class="col-xl-4 col-lg-4 col-md-4   ">



            <!-- Supplier Area Start -->

            <div class="col-xl-12 col-md-12 mb-4  text-center  bg-abasas-dark p-2 ">
                <div class="card border-none   bg-abasas-dark  p-2">
                    <h3 class="text-white">ক্রেতা</h3>

                    <div class="card-body">
                        <div class="row no-gutters ">


                            <form method="GET" id="cashReceiveCustomerForm">
                                @csrf
                                <div class="form-row ">
                                    <div class="col-auto">
                                        <form method="post">


                                            <div class=" col-auto">
                                                <label class="text-light" for="cashReceiveCustomerPhoneField">ক্রেতার নাম্বার </label>
                                                <input type="text" name="phone" id="cashReceiveCustomerPhoneField" class="form-control mb-2">
                                                <div class="text-danger text-small" id="cashReceiveCustomerPhoneFieldLength"> সঠিক নাম্বার দিন </div>
                                                <div class="text-danger text-small" id="cashReceiveCustomerPhoneFieldNotFound"> ক্রেতা পাওয়া যায়নি </div>
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
