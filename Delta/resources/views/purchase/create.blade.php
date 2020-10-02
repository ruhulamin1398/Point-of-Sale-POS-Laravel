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

        <div class="row">
            <div class="col-12">

            


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