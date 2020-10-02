@extends('includes.app')


@section('content')

<div class="row">

    <div class="col-9">

        <div class="card mb-4 shadow">

            <div class="card-header py-3 bg-abasas-dark  text-light ">
                <nav class="navbar ">
                    <a class="navbar-brand">Purchase</a>

                </nav>

            </div>
            <div class="card-body">
                <form id="orderProductInputForm">

                    <div class="form-row align-items-center">


                        <!-- <div class="col-auto">
        <span class="text-dark  pl-2"> cost</span>
        <input type="text" name="productCost" id="orderProductInputCost" size="10" value="" class="form-control  mb-2">
      </div> -->

                        <div class="col-auto">
                            <span class="text-dark  pl-2"> পণ্যের আইডি</span>
                            <input type="text" name="product_id" id="purchaseProductInputId" size="10" value="" class="form-control  mb-2 inputMinZero " autofocus >
                        </div>


                        <div class="col-auto">
                            <span class="text-dark  pl-2"> পণ্যের নাম</span>
                            <input type="text" name="name" id="purchaseProductInputName" size="20" value="" class="form-control  mb-2" readonly>
                        </div>
                        <div class="col-auto">

                            <span class="text-dark pl-1"> মূল্য</span>
                            <input type="text" name="price" id="purchaseProductInputPrice" size="6" value=0 min="0" class="form-control  mb-2  inputMinZero">
                        </div>

                        <div class="col-auto">

                            <span class="text-dark pl-1"> ডিসকাউন্ট <span id="percentageIcon"> ( % )  </span>  <i class="fas fa-cog" id="disCountSetting"></i></span>
                            <input type="text" name="discount" id="purchaseProductInputdiscount" size="6" min="0" value=0 class="form-control  mb-2 inputMinZero">
                        </div>




                        <!-- <div class="col-auto">
                          
                        <span class="text-dark pl-1"> </span>
                        <select class="form-control form-control" name="discount_type" value="amount" required>
                            <option value="amount">fixed</option>
                            <option value="percentage">%</option>
                        </select>
                        </div> 
                    -->
                    <input type="text" name="" id="purchaseProductInputDiscountType" value="1" hidden >
                    <input type="text" name="" id="purchaseProductInputDiscountValue" value="0" hidden >

                        <div class="col-auto">
                            <span class="text-dark pl-1"> পরিমান </span>
                            <input type="text" name="quantity" id="purchaseProductInputQuantity" size="6" value=1 min="1" class="form-control  mb-2  inputMinOne">
                        </div>




                        <div class="col-auto">

                            <span class="text-dark pl-1"> মোট</span>
                            <input type="text" name="total" id="purchaseProductInputTotal" size="10" value=0 class="form-control  mb-2  inputMinZero ">
                        </div>



                        <div class="col-auto">
                            <button type="button" id="purchaseProductInputSubmit" data-submit-type="create" data-item-id="0" class="btn btn-success mt-3" disabled="true" > সাবমিট</button>
                        </div>

                    </div>

                </form>
                <div id="purchaseProductError" class="text-danger "> পণ্যটি পাওয়া যায়নি , আবার চেষ্টা করুন !!! </div>



            </div>
        </div>


             <!-- DataTales Example -->
      <div class="card shadow mb-4">
        <div class="card-header py-3 bg-abasas-dark">
          <b>পণ্যের লিস্ট</b>

        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-striped table-bordered" id="orderProductTable" width="100%" cellspacing="0">
              <thead class="bg-abasas-dark">


                <tr>
                  <th>#</th>
                  <th>আইডি</th>
                  <th>নাম</th>
                  <th> মূল্য</th>
                  <th>পরিমান</th>
                  <th>Discount</th>
                  <th>মোট</th>
                  <th> একশন</th>
                </tr>
              </thead>
              <tfoot class="bg-abasas-dark">
                <tr>
                <th>#</th>
                  <th>আইডি</th>
                  <th>নাম</th>
                  <th> মূল্য</th>
                  <th>পরিমান</th>
                  <th>Discount</th>
                  <th>মোট</th>
                  <th>একশন</th>
                </tr>

              </tfoot>
              <tbody id="purchaseProductTableTbody">
              </tbody>
            </table>

          </div>
        </div>

      </div>


      
    </div>
    <div class="col-3">

        <x-supplier-phone />

      

            
        <div class="col-xl-12 col-md-12 mb-4  text-center  bg-abasas-dark p-2 ">
          <div class="card border-none   bg-abasas-dark  p-1">

            <div class="card-body">
              
            <input type="number" name="" value="0" id="totalPricehidden" hidden >
              <div class="font-weight-blod h3 text-light">Total : <span id="totalPrice">0</span> </div>
              <div class="col-auto">
                <label class="text-light" for="orderPaymentField">পেমেন্ট :</label>
                <input type="text" id="orderPaymentField" class="form-control mb-2" value="0" required>
              </div>

              <hr class="sidebar-divider bg-light m-1 p-0 ">

              <input type="number" name="" value="0" id="totalProductPriceDiscount" hidden >
              <input type="number" name="" value="0" id="orderMoreDiscount" hidden >
              
              <div class="font-weight-blod  text-light">ছাড়: <span id="totalPriceDiscount">0</span> </div>

              <div class="col-auto">
                <label class="text-light" for="orderMoreDiscountField">অতিরিক্ত ছাড়  : </label>
                <input type="text" id="orderMoreDiscountField" value="0" min="0" class="form-control mb-2" required>
              </div>

              <!-- Divider -->
              <hr class="sidebar-divider bg-light m-1 p-0 ">
              <div class="text-light font-weight-bold">ফেরত : <span id="exchange">0</span> </div>
              <div class="form-group">
                    <label for="paymentMethod">পেমেন্ট মেথড</label>
                    <select class="form-control form-control" name="method" id="paymentMethod" value="Cash" required>     
                        <option value="Cash"> Cash</option>
                        <option value="Bkash">Bkash </option>
                        <option value="Rocket">Rocket</option>
                        <option value="Card"> Card</option>
                       
                    </select>
                </div>
              <!-- Divider --> 
              <hr class="sidebar-divider bg-light m-1 p-0 ">
              <button id="orderCompleteButton" class="btn btn-success"> সাবমিট </button>
            </div>

            <!-- submit form start  -->
            <form action="" id="orderSubmitForm" method="POST">
              @csrf

              <input type=" text" name="user_id" id="orderSubmitFormUserId" hidden ">
            <input type=" text" name="customer_id" id="orderSubmitFormCustomerId" hidden ">
            <input type=" text" name="pay" id="orderSubmitFormPayment" hidden ">
            <!-- <input type=" text" name="due" id="orderSubmitFormDue" hidden "> -->
            <!-- <input type=" text" name="pre_due" id="orderSubmitFormPreDue" hidden "> -->
            
            <input type=" text" name="discount" id="orderSubmitFormDiscount" hidden ">
            <input type=" text" name="total" id="orderSubmitFormTotal" hidden ">
            <input type=" text" name="method" id="orderSubmitMethod" value="Cash" hidden ">
            </form>
            <!-- product add database link  -->
            {{--
            <!-- submit form start  -->
            <!-- <form action=" {{route('orders_details.store')}}" id=" orderProd-uctAddForm" method="POST">
              @csrf

              <input type=" text" name="order_id" id="orderProductAddOrderId" hidden ">
            <input type=" text" name="product_id" id="orderProductAddProductId" hidden ">
            <input type=" text" name="price" id="orderProductAddPrice" hidden ">
            <input type=" text" name="quantity" id="orderProductAddQuantity" hidden ">
            <input type=" text" name="total" id="orderProductAddTotal" hidden ">
            </form>
            --}}

                      <!-- submit form start  -->
            <form action="" id="orderProductAddForm" method="POST">
            
              @csrf

              <input type=" text" name="order_id" id="orderProductAddOrderId" hidden ">
            <input type=" text" name="product_id" id="orderProductAddProductId" hidden ">
            <input type=" text" name="price" id="orderProductAddPrice" hidden ">
            <input type=" text" name="quantity" id="orderProductAddQuantity" hidden ">
            <input type=" text" name="total" id="orderProductAddTotal" hidden ">
              


            </form>





          </div>
        </div>


            

    </div>
</div>







<!-- Select Discount Type Modal -->

<div class="modal fade   " id="discountModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered  border-none " role="document">
        <div class="modal-content bg-abasas-dark">
            <!-- <div class="modal-header bg-abasas-dark ">
                <h5 class="modal-title " id="exampleModalCenterTitle">Select Discount Type</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-light">&times;</span>
                </button>
            </div> -->
            <div class="modal-body p-4 border border-light m-2">


                <div class="form-check form-inline justify-content-center p-4 m-4">
                    <label class="form-check-label pl-4 pr-4">
                        <input type="radio" class="form-check-input purchasePagePercentageSelect" name="optradio" value="1" id="purchaseModalDiscountTypePercentage" > Percentage ( % )
                    </label>
                
              
                    <label class="form-check-label pl-4 pr-4">
                        <input type="radio" class="form-check-input purchasePagePercentageSelect" name="optradio" value="2" id="purchaseModalDiscountTypeFixed" >Fixed Price
                    </label>
                </div>
          

            </div>
            <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> -->
        </div>
    </div>
</div>

<!-- /Select Discount Type Modal-->







<script src="{{asset('js/abasas/purchase.js')}}"></script>


@endsection