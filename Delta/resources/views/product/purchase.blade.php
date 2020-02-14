@extends('layout.app')
@section('content')


<!-- Content Row -->
<div class="container-fluid ">

  <div class="row ">

    <!-- main body start -->
    <div class="col-xl-8 col-lg-8 col-md-8   ">



      <div class="card mb-4 shadow">

        <div class="card-header py-3 bg-dark  text-light ">
          <nav class="navbar ">
            <a class="navbar-brand">Purchase New</a>
            <button class="btn btn-success " id="create-button"> <a href="{{ route('supplier_payment') }} " class="text-light">Cash Payment</a> </button>
            
          </nav>

        </div>
        <div class="card-body">
          <form id="purchaseProductInputForm">

            <div class="form-row align-items-center">
              <div class="col-auto">
                <span class="text-dark  pl-2"> Product Id</span>
                <input type="text" name="product_id" id="purchaseProductInputId" size="10" value="" class="form-control  mb-2">
              </div>

              <div class="col-auto">
                <span class="text-dark  pl-2"> Product Name</span>
                <input type="text" name="name" id="purchaseProductInputName" size="20" value="" class="form-control  mb-2" disabled="true">
              </div>
              <div class="col-auto">

                <span class="text-dark pl-1"> Price</span>
                <input type="text" name="price" id="purchaseProductInputPrice" size="6" value=0 class="form-control  mb-2 " disabled="true">
              </div>
              <div class="col-auto">

                <span class="text-dark pl-1"> Quantity</span>
                <input type="text" name="quantity" id="purchaseProductInputQuantity" size="6" value=0 class="form-control  mb-2 " disabled="true">
              </div>



              <div class="col-auto">

                <span class="text-dark pl-1"> Total</span>
                <input type="text" name="total" id="purchaseProductInputTotal" size="10" value=0 class="form-control  mb-2 " disabled="true">
              </div>



              <div class="col-auto">
                <button type="button" id="purchaseProductInputSubmit" class="btn btn-success mt-3" disabled="true">Submit</button>
              </div>

            </div>

          </form>
          <div id="purchaseProductError" class="text-danger "> Product Not Fount , Try again !!! </div>



        </div>
      </div>


      <!-- Begin Page Content -->





      <!-- DataTales Example -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <b>Product list</b>

        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-striped table-bordered" id="purchaseProductTable" width="100%" cellspacing="0">
              <thead class="thead-dark">


                <tr>
                  <th>#</th>
                  <th>Id</th>
                  <th>Name</th>
                  <th>Price</th>
                  <th>Quantity</th>
                  <th>Total</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tfoot class="thead-dark">
                <tr>
                  <th>#</th>
                  <th>Id</th>
                  <th>Name</th>
                  <th>Price</th>
                  <th>Quantity</th>
                  <th>Total</th>
                  <th>Action</th>
                </tr>

              </tfoot>
              <tbody id="purchaseProductTableTbody">
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
          <h3 class="text-white">Supplier</h3>
          <div class="card-body">
            <div class="row no-gutters ">


              <form method="GET" id="purchasePageSupplierForm">
                @csrf
                <div class="form-row ">
                  <div class="col-auto">
                    <form method="post">


                      <div class=" col-auto">
                        <label class="text-light" for="purchasePageSupplierPhoneField">Supplier Phone</label>
                        <input type="text" name="phone" id="purchasePageSupplierPhoneField" class="form-control mb-2">
                        <div class="text-danger text-small" id="purchasePageSupplierPhoneFieldLength">Enter a Valid Phone Number</div>
                      </div>
                      <input type=" number" name="efsd" hidden ">
                  </form>
                  </div>
                </div>
              </form>

            </div>
            <div class=" text-samall text-danger" id="purchasePageAddSupplierError">
                  </div>

                  <div id="purchasePageSupplierView">
                    <div id="purchasePageSupplierName" class="text-light font-weight-bold"></div>
                    <div id="purchasePageSupplierPhone" class="text-light "></div>
                    <div id="purchasePageSupplieCompany" class="text-light "></div>
                    <div id="purchasePageSupplierDue" class="text-danger font-weight-bold"></div>
                  </div>

                  <form method="POST" action="{{ route('suppliers.store') }} " id="purchasePageAddSupplierForm">
                    @csrf
                    <div class="form-row a">
                      <div class="col-auto">
                        <input type="text" id="purchasePageAddSupplierFormName" name="name" placeholder="name" class="form-control mb-2">
                      </div>
                      <div class="col-auto">
                        <input type="text" id="purchasePageAddSupplierFormPhone" name="phone" class="form-control mb-2" hidden>
                      </div>
                      <div class="col-auto">
                        <input type="text" id="purchasePageAddSupplierFormAddress" name="address" placeholder="address" class="form-control mb-2">
                      </div>
                      <div class="col-auto">
                        <input type="text" id="purchasePageAddSupplierFormCompany" name="company" placeholder="company" class="form-control mb-2">
                      </div>

                      <div class="col-auto">
                        <button type="button" id="purchasePageAddSupplierButton" class="btn btn-primary mt-3">done</button>
                      </div>



                  </form>
                </div>

            </div>
          </div>
          <!-- Growth Card Example -->
        </div>




        <!-- sumit Area Start -->


        <div class="col-xl-12 col-md-12 mb-4  text-center  bg-dark p-2 ">
          <div class="card border-none   bg-dark  h-100 p-1">

            <div class="card-body">
              <div class="font-weight-blod h3 text-light">Total: <span id="totalPrice">0</span> </div>
              <div class="col-auto">
                <label class="text-light" for="purchasePaymentField">Payment</label>
                <input type="text" id="purchasePaymentField" class="form-control mb-2" value="0" required>
              </div>

              <hr class="sidebar-divider bg-light m-1 p-0 ">

              <div class="font-weight-blod  text-light">Discount: <span id="totalPriceDiscount">0</span> </div>

              <div class="col-auto">
                <label class="text-light" for="purchaseMoreDiscountField">More Discount</label>
                <input type="text" id="purchaseMoreDiscountField" value="0" class="form-control mb-2" required>
              </div>

              <!-- Divider -->
              <hr class="sidebar-divider bg-light m-1 p-0 ">
              <div class="text-light font-weight-bold">Due : <span id="totalDue">0</span> </div>

              <!-- Divider -->
              <hr class="sidebar-divider bg-light m-1 p-0 ">
              <button id="purchaseCompleteButton" class="btn btn-success"> Finish </button>
            </div>

            <!-- submit form start  -->
            <form action="{{ route('purchases.store') }}" id="purchaseSubmitForm" method="POST">
              @csrf

              <input type=" text" name="user_id" id="purchaseSubmitFormUserId" hidden ">
            <input type=" text" name="supplier_id" id="purchaseSubmitFormSupplierId" hidden ">
            <input type=" text" name="pay" id="purchaseSubmitFormPayment" hidden ">
            <input type=" text" name="due" id="purchaseSubmitFormDue" hidden ">
            <input type=" text" name="pre_due" id="purchaseSubmitFormPreDue" hidden ">
            
            <input type=" text" name="discount" id="purchaseSubmitFormDiscount" hidden ">
            <input type=" text" name="total" id="purchaseSubmitFormTotal" hidden ">
            </form>
            <!-- product add database link  -->
            
            <!-- submit form start  -->
            <!-- <form action=" {{route('purchases_details.store')}}" id=" orderProd-uctAddForm" method="POST">
              @csrf

              <input type=" text" name="purchase_id" id="orderProductAddPurchaseId" hidden ">
            <input type=" text" name="product_id" id="orderProductAddProductId" hidden ">
            <input type=" text" name="price" id="orderProductAddPrice" hidden ">
            <input type=" text" name="quantity" id="orderProductAddQuantity" hidden ">
            <input type=" text" name="total" id="orderProductAddTotal" hidden ">
            </form> -->

                      <!-- submit form start  -->
            <form action="{{route('purchases_details.store')}} " id="orderProductAddForm" method="POST">
            
              @csrf

              <input type=" text" name="purchase_id" id="orderProductAddPurchaseId" hidden ">
            <input type=" text" name="product_id" id="orderProductAddProductId" hidden ">
            <input type=" text" name="price" id="orderProductAddPrice" hidden ">
            <input type=" text" name="quantity" id="orderProductAddQuantity" hidden ">
            <input type=" text" name="total" id="orderProductAddTotal" hidden ">
              


            </form>





          </div>
        </div>

        <!-- sumit Area End -->



      </div>
      <!-- supplier area End  -->


    </div>
  </div>

  <!-- Content Row -->







<!-- Create new product -->
<div class=" modal fade" id="Print-modal" tabindex="-1" role="dialog" aria-labelledby="edit-modal-label" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title text-dark" id="edit-modal-label ">Purchase Completed </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body" id="attachment-body-content">


                    <button class="btn btn-success text-white"> <a href="{{route('purchases-receipt-show',[0])}}" id="printInvoice"> Print Invoice </a> </button>

                  </div>

                </div>
              </div>
          </div>
        </div>
        <!-- /Create new product-->

        @endsection