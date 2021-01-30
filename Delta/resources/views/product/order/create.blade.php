@extends('includes.app')


@section('content')

<div class="row">

    <div class="col-8">

        <div class="card mb-4 shadow">

            <div class="card-header py-3 bg-abasas-dark  text-light ">
                <nav class="navbar ">
                    <span><a class="navbar-brand">{{ __('translate.Purchase') }}</a> @can('Super Admin') <i class="fas fa-tools pl-2"
                        id="pageSetting" data-toggle="modal" data-target="#setting-modal"></i> @endcan </span>

                </nav>

            </div>
            <div class="card-body">
                <form id="orderProductInputForm">

                    <div class="form-row align-items-center">


    

                        {{-- <div >
                            
                            <input type="text" name="product_id" id="purchaseProductInputId" size="50" value=""
                                class=" " autofocus autocomplete="off">
                        </div> --}}

                        <div class="col-12" style="position: relative;">
                            <span class="text-dark  pl-2"> {{ __('translate.Search') }}</span>
                            <input type="text" name="" id="purchaseProductInputId" class="form-control form-control-lg  mb-4 p-4 inputMinZero rounded-1 border-info"
                                autocomplete="off" autofocus >
                            <div id="productSuggession" class="list-group"   style="position: absolute;   left:20px; z-index:9999; max-height: 200px;overflow:scroll; "> </div>
                        </div>

                        
                        
                        
    

                        {{-- <div class="col-auto">
                            <span class="text-dark  pl-2"> পণ্যের আইডি</span>
                            <input type="text" name="product_id" id="purchaseProductInputId" size="10" value=""
                                class="form-control  mb-2 inputMinZero " autofocus>
                        </div> --}}

                        <input type="text" name="" id="productIdHidden" hidden  >


                        <div class="col-auto">
                            <span class="text-dark  pl-2">{{ __('translate.Product Name') }} </span>
                            <input type="text" name="name" id="purchaseProductInputName" size="20" value=""
                                class="form-control  mb-2" readonly>
                        </div>
                        <div class="col-auto">

                            <span class="text-dark pl-1"> {{ __('translate.Price') }} </span>
                            <input type="text" name="price" id="purchaseProductInputPrice" size="6" value=0 min="0"
                                class="form-control  mb-2  inputMinZero">
                        </div>

                        <div class="col-auto">

                            <span class="text-dark pl-1">{{ __('translate.Discount') }} <span id="percentageIcon"> ( % ) </span> <i
                                    class="fas fa-tools" id="disCountSetting"></i></span>
                            <input type="text" name="discount" id="purchaseProductInputdiscount" size="6" min="0"
                                value=0 class="form-control  mb-2 inputMinZero">
                        </div>




                        <!-- <div class="col-auto">
                          
                        <span class="text-dark pl-1"> </span>
                        <select class="form-control form-control" name="discount_type" value="amount" required>
                            <option value="amount">fixed</option>
                            <option value="percentage">%</option>
                        </select>
                        </div> 
                    -->
                        <input type="text" name="" id="purchaseProductInputDiscountType" value="1" hidden>
                        <input type="text" name="" id="purchaseProductInputDiscountValue" value="0" hidden>

                        <div class="col-auto">
                            <span class="text-dark pl-1">{{ __('translate.Quantity') }} </span>
                            <input type="text" name="quantity" id="purchaseProductInputQuantity" size="6" value=1
                                min="1" class="form-control  mb-2  inputMinOne">
                        </div>




                        <div class="col-auto">

                            <span class="text-dark pl-1">{{ __('translate.Total') }}</span>
                            <input type="text" name="total" id="purchaseProductInputTotal" size="10" value=0
                                class="form-control  mb-2  inputMinZero ">
                        </div>



                        <div class="col-auto">
                            <button type="button" id="purchaseProductInputSubmit" data-submit-type="create"
                                data-item-id="0" class="btn btn-success mt-3" disabled="true"> {{ __('translate.Submit') }}</button>
                        </div>

                    </div>

                </form>
                <div id="purchaseProductError" class="text-danger ">{{ __('translate.Product not found, try again !!!') }} </div>



            </div>
        </div>


        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 bg-abasas-dark">
                <b>{{ __('translate.Products List') }} </b>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="orderProductTable" width="100%"
                        cellspacing="0">
                        <thead class="bg-abasas-dark">


                            <tr>
                                <th>#</th>
                                <th>{{ __("translate.Id") }}</th>
                                <th>{{ __("translate.Name") }}</th>
                                <th>{{ __("translate.Price") }} </th>
                                <th>{{ __("translate.Quantity") }} </th>
                                <th>{{ __("translate.Discount") }} </th>
                                <th>{{ __("translate.Total") }} </th>
                                <th>{{ __("translate.Action") }}</th>

                            </tr>
                        </thead>
                        <tfoot class="bg-abasas-dark">
                            <tr>
                                
                                <th>#</th>
                                <th>{{ __("translate.Id") }}</th>
                                <th>{{ __("translate.Name") }}</th>
                                <th>{{ __("translate.Price") }} </th>
                                <th>{{ __("translate.Quantity") }} </th>
                                <th>{{ __("translate.Discount") }} </th>
                                <th>{{ __("translate.Total") }} </th>
                                <th>{{ __("translate.Action") }}</th>
                            </tr>

                        </tfoot>
                        <tbody id="purchaseProductTableTbody">
                        </tbody>
                    </table>

                </div>
            </div>

        </div>



    </div>
    <div class="col-4 row">

        <x-customer-phone />





        <div class="col-xl-12 col-md-12 mb-2 mt-2 text-center p-2 ">
            <div class="card border-none   bg-abasas-dark  p-1">
                <div class="card-body">

                    <div class="row border-bottom border-dark mb-2">
                        <div class="col-6 ">
                            <div class="text-left  "> {{ __("translate.Prodcut Discount") }}</div>
                        </div>
                        <div class="col-6">
                            <div class="text-right " id="ProductDiscountTotal">0</div>
                        </div>
                    </div>

                    <input type="text" name="" id="productPurchaseTotal" value='0' class="inputMinZero" hidden>

                    <div class="row border-bottom border-dark mb-2">
                        <div class="col-8 ">
                            <div class="text-left  "> {{ __("translate.Discount More") }} <span id="moreDiscountPercentageIcon"> ( % ) </span>
                                <i class="fas fa-tools pl-2" id="purchasePageMoreDiscountSetting"></i></div>
                        </div>
                        <div class="col-4">
                            <input type="text" id="moreDiscountInput" class="form-control form-control-sm inputMinZero"
                                value="0">
                        </div>
                    </div>

                    <input type="text" id="productPurchaseMoreDiscountType" value='1' class="inputMinZero" hidden>

                    <input type="text" name="" id="discountTotal" value="0" class="inputMinZero" hidden>
                    <div class="row border-bottom border-dark mb-2">
                        <div class="col-6 ">
                            <div class="text-left  "> {{ __("translate.Total Dioscount") }} </div>
                        </div>
                        <div class="col-6">
                            <div class="text-right " id="totalDiscountInText">0 + 0</div>
                        </div>
                    </div>


                    <div class="row border-bottom border-dark bg-dark mb-2">
                        <div class="col-6 ">
                            <div class="text-left  ">  {{ __("translate.Sub Total") }}</div>
                        </div>
                        <div class="col-6">
                            <div class="text-right" id="purchaseSubtotal">0</div>
                        </div>
                    </div>


                    <div class="row border-bottom border-dark mb-2">
                        <div class="col-6 ">
                            <div class="text-left  "> {{ __("translate.Tax") }} ( <span id="taxView">15</span>%) <i class="fas fa-tools pl-2"
                                    id="TaxSetting"></i></span></div>
                        </div>
                        <div class="col-6">
                            <div class="text-right " id="taxValue">0</div>
                        </div>
                    </div>
                    <div class="row border-bottom border-dark  mb-2">
                        <div class="col-6 ">
                            <div class="text-left  "> {{ __("translate.Previous Due") }}</div>
                        </div>
                        <div class="col-6">

                            <!-- //////////////////////************************* *////////////
**************************  This property updated from supplier Component 
                               when fatch customer data
//////////////////////************************* *//////////// -->
                            <div class="text-right" id="purchasePreviousDue">0</div>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-12 col-md-6 pt-1 pb-1 border-dark bg-dark border-dotted ">
                            <div class="text-center h5 "> {{ __("translate.Total") }}</div>
                            <input type="text" name="" id="totalWithOutDue" value=0 class="inputMinZero" hidden>
                            <div class="text-center h5 text-success " id="finalTotal">0</div>
                        </div>

                        <div class="col-12 col-md-6  border-dark pt-1 pb-1  border-dotted">
                            <div class="text-center h5">  {{ __("translate.Due") }}</div>
                            <div class="text-center h5 text-danger" id="totalDue">0 </div>
                        </div>
                    </div>



                    <div class="row   mb-2">

                        <div class="text-center  border-top border-dark  mb-2 col-12 ">  {{ __("translate.Add Payment") }}</div>
                        {{--
              <form>
@foreach($paymentSystems as $paymentSystem)
  <div class="custom-control custom-radio custom-control-inline">
    <input type="radio" class="custom-control-input" id="customRadio{{ $paymentSystem->id }}" name="example"
                        value="{{ $paymentSystem->id }}">
                        <label class="custom-control-label"
                            for="customRadio{{ $paymentSystem->id }}">{{ $paymentSystem->payment_system }}</label>
                    </div>
                    @endforeach
                    </form>
                    --}}
{{-- 
                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                        @foreach($paymentSystems as $paymentSystem)
                            @if($loop->first)
                                <label class="btn btn-dark p-2 m-1 " checked="checked">
                                    <input type="radio" name="paymentSystem" id="Radio{{ $paymentSystem->id }}"
                                        autocomplete="off" checked="checked"> {{ $paymentSystem->payment_system }}
                                </label>
                                @else
                               
                                <label class="btn btn-dark p-2 m-1 " checked="checked">
                                    <input type="radio" name="paymentSystem" id="Radio{{ $paymentSystem->id }}"
                                        autocomplete="off" checked="checked"> {{ $paymentSystem->payment_system }}
                                </label>
                            @endif




                        @endforeach
                    </div> --}}

<input type="text" value="1" id="paymentSystemId" hidden>


                    @foreach($paymentSystems as $paymentSystem)
                    @if($loop->first)
                    <div class="form-check form-check-inline ">
                        <input class="form-check-input paymentSystem" type="radio" name="paymentSystem" id="Radio{{ $paymentSystem->id }}" value="{{ $paymentSystem->id }}" checked>
                        <label class="form-check-label" for="Radio{{ $paymentSystem->id }}">{{ $paymentSystem->payment_system }}</label>
                      </div>
                        @else
                        <div class="form-check form-check-inline ">
                            <input class="form-check-input paymentSystem" type="radio" name="paymentSystem" id="Radio{{ $paymentSystem->id }}" value="{{ $paymentSystem->id }}">
                            <label class="form-check-label" for="Radio{{ $paymentSystem->id }}">{{ $paymentSystem->payment_system }}</label>
                          </div>
                   
                    @endif




                @endforeach
      

                  
             












                    <div class="row mb-2 mt-4">
                        <div class="input-group col-12">
                            <input type="text" class="form-control inputMinZero " id="PayAmount"
                                aria-describedby="inputGroupAppend" value="0" required>
                            <div class="input-group-append">
                                <button type="button" class="btn btn-success" id="orderCompleteButton" disabled="false"> {{ __('translate.Complete') }}</button>
                            </div>
                        </div>
                    </div>
                    <div class="text-success" id="changeAmount"></div>





                </div>
            </div>
        </div>


    </div>


</div>





<!-- Select Discount Type Modal -->

<div class="modal fade   " id="discountModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered  border-none " role="document">
        <div class="modal-content bg-abasas-dark">
            <div class="modal-body p-4 border border-light m-2">
                <div class="form-check form-inline justify-content-center p-4 m-4">
                    <label class="form-check-label pl-4 pr-4">
                        <input type="radio" class="form-check-input purchasePagePercentageSelect" name="optradio"
                            value="1" id="purchaseModalDiscountTypePercentage"> Percentage ( % )
                    </label>
                    <label class="form-check-label pl-4 pr-4">
                        <input type="radio" class="form-check-input purchasePagePercentageSelect" name="optradio"
                            value="2" id="purchaseModalDiscountTypeFixed">Fixed Price
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- /Select Discount Type Modal-->





<!-- More Discount Type Modal -->

<div class="modal fade   " id="moreDiscountModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered  border-none " role="document">
        <div class="modal-content bg-abasas-dark">
            <div class="modal-body p-4 border border-light m-2">
                <div class="form-check form-inline justify-content-center p-4 m-4">
                    <label class="form-check-label pl-4 pr-4">
                        <input type="radio" class="form-check-input purchasePageMoreDiscountSelect" name="more-discount"
                            value="1" id="purchaseMoreModalDiscountTypePercentage"> Percentage ( % )
                    </label>
                    <label class="form-check-label pl-4 pr-4">
                        <input type="radio" class="form-check-input purchasePageMoreDiscountSelect" name="more-discount"
                            value="2" id="purchaseMoreModalDiscountTypeFixed">Fixed Price
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>





<!-- Tax Discount Type Modal -->

<div class="modal fade   " id="taxModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered  border-none " role="document">
        <div class="modal-content bg-abasas-dark">

            <div class="modal-body p-4 border border-light m-2">
                <div class="text-center h3 p-4">
                    Tax Setting
                </div>
                <div class="input-group ">
                    <input type="text" class="form-control 
             " id="taxInput" aria-describedby="inputGroupAppend" value="15">
                    <div class="input-group-append">
                        <span class="btn btn-success" id="inputGroupPrepend">%</span>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>

<!-- /// purchase  Complete modal  -->
<div class=" modal fade" id="PrintPurchaseModalwwwwwwwwww" tabindex="-1" role="dialog" aria-labelledby="edit-modal-label"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-abasas-dark">
                <h5 class="modal-title p-2" id="edit-modal-label"> {{ __('translate.Purchase Complete') }} </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>

            </div>
            <div class="modal-body align-item-center p-2 m-4" id="attachment-body-content">

                <div style="margin:0 auto; width:250px;">
                    <!--  <button class="btn btn-success text-white p-4 m-2"> <a href=""   class="text-white" id="printGiftInvoice">  Gift Invoice </a> </button> -->
                    <button class="btn btn-success text-white p-2 m-2"> <a href=""  class="text-white" id="printInvoice"> Invoice </a> </button>

                    <button class="btn btn-danger text-white p-2 m-2"> <a
                            href="{{ $_SERVER["REQUEST_URI"] }}"   class="text-white"id="printInvoice">  {{ __('translate.Cancel') }} </a>
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>






@can('Super Admin')
 <!-- Permission Modal -->
 <div class="modal fade" id="setting-modal" tabindex="-1" role="dialog" aria-labelledby="setting-modal-label"
     aria-hidden="true">
     <div class="modal-dialog modal-lg" role="document">
         <div class="modal-content">
             <div class="modal-header bg-abasas-dark">

                <nav class="navbar navbar-light  ">
                    <a class="navbar-brand">{{__('translate.Permission')}}</a>
    
                </nav>
                
            <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;</span>
            </button>

             </div>
             <form action="{{ route('rolepermissionstore') }}" method="post">
                @csrf
                <input type="text" name="page_name" value="Order Create" required hidden>
             <div class="modal-body" >


                
                <div class="table-responsive">
                    <table class="table table-striped table-bordered"  width="100%"
                        cellspacing="0">
                        <thead class="bg-abasas-dark">

                            <tr>

                                <th>{{ __('translate.Permission') }} </th>

                                @for ($i=1 ; $i<5 ; $i++) <th>{{ $roles[$i]->name }}</th>
                                    @endfor
                            </tr>
                        </thead>


                        <tbody>


                            @php
                            $permision_name = "Order Create Page";
                            @endphp
                            
                            <tr class="data-row">
                                <td class="iteration">{{ __('translate.Page Access') }}</td>
                                @for ($i=1 ; $i<5 ; $i++) <td
                                    class="word-break name justify-content-center">
                                    <label class="checkbox-inline"><input type="checkbox"
                                            name="page{{ $i }}"
                                            @if($roles[$i]->hasPermissionTo($permision_name)) checked
                                        @endif></label>
                                    </td>
                                    @endfor

                            </tr>

                        </tbody>



                    </table>
                </div>

             </div>

             <div class="modal-footer">
                <button type="submit"
                                 class="btn bg-abasas-dark btn-block form-control  ">{{ __('translate.Save')  }}</button>
            </div>
             </form>
         </div>
     </div>
 </div>




@endcan





<!-- Attachment Modal -->
<div class="modal fade" id="PrintPurchaseModal" tabindex="-1" role="dialog" aria-labelledby="edit-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark" id="edit-modal-label ">ffgfdhfghfghgfhghghghghg </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="attachment-body-content">
                <form id="data-edit-form" class="form-horizontal" method="POST" action="">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label class="col-form-label" for="modal-update-hidden-id">{{__('translate.Id')}} </label>
                        <input type="text" name="id" class="form-control" id="modal-update-hidden-id" required readonly>
                    </div>

                    <div id="editOptions"></div>





                    <div class="form-group">

                        <input type="submit" id="submit-button" value=" {{__('translate.Submit')}}" class="form-control btn btn-success">
                    </div>




                </form>
            </div>

        </div>
    </div>
</div>
<!-- /Attachment Modal -->



<script src="{{ asset('js/abasas/order.js') }}"></script>

@endsection