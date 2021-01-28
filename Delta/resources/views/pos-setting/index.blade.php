@extends('includes.app')

@section('content')






<!-- Begin Page Content -->
<div class="container-fluid">




    <!-- DataTales Example -->
    <div class="card shadow mb-4 ml-0 mr-0">
        <div class="card-header py-3 bg-abasas-dark">
            <nav class="navbar navbar-dark ">
                <a class="navbar-brand">{{ __('translate.System Settings') }}</a>

            </nav>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('pos-setting.update',1) }}" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="row m-4">

                    <div class="form-group col-12 col-md-3">
                        <label for="name"> {{ __('translate.Shop Name') }}  </label>
                    </div>

                    <div class=" form-group col-12 col-md-3">
                        <input type="text" name="shop_name" class="form-control" id="name"
                            value="{{ $settings->shop_name }}">
                    </div>



                    <div class="form-group col-12 col-md-3">
                        <label for="shop_moto"> {{ __('translate.Shop Slogan') }} </label>
                    </div>


                    <div class="form-group col-12 col-md-3">
                        <input type="text" name="shop_moto" class="form-control" id="moto"
                            value="{{ $settings->shop_moto }}">
                    </div>




                </div>


                <div class="row m-4">

                    <div class="form-group col-12 col-md-3">
                        <label for="phone"> {{ __('translate.Shop Phone') }}  </label>
                    </div>

                    <div class="form-group col-12 col-md-3">
                        <input type="text" name="shop_phone" class="form-control" id="phone"
                            value="{{ $settings->shop_phone }}">
                    </div>



                    <div class="form-group col-12 col-md-3">
                        <label for="shop_email"> {{ __('translate.Shop Email') }} </label>
                    </div>


                    <div class="form-group col-12 col-md-3">
                        <input type="email" name="shop_email" class="form-control" id="email"
                            value="{{ $settings->shop_email }}">
                    </div>




                </div>


                <div class="row m-4">

                    <div class="form-group col-12 col-md-3">
                        <label for="language"> {{ __('translate.Language') }}  </label>
                    </div>

                    <div class="form-group col-12 col-md-3">
                        <select class="form-control" value="" name="language" id="language">
                            <option selected disabled value="">Select Language </option>



                            @if ($settings->language == 'bn')
                            <option value="en"> English</option>
                            <option selected value="bn"> বাংলা</option>
                            @else

                            <option selected value="en"> English</option>
                            <option value="bn"> বাংলা</option>

                            @endif
                        </select>

                    </div>


                    <div class="form-group col-12 col-md-3">
                        <label for="customer_due"> {{ __('translate.Customer Due') }} </label>
                    </div>

                    <div class="form-group col-12 col-md-3">
                        <select class="form-control" value="" name="customer_due" id="customer_due">
                            <option selected disabled value="">Select</option>

                          @if($settings->customer_due == 'yes')
                            <option selected value="yes"> Yes</option>
                            <option value="no"> No</option>

                        @else
                        <option  value="yes"> Yes</option>
                        <option selected value="no"> No</option>
                         @endif  

                    </select>


                    </div>




                </div>


                <div class="row m-4">

                    <div class="form-group col-12 col-md-3">
                        <label for="customer_due"> {{ __('translate.Shop Logo') }} </label>
                    </div>


                    <div class="form-group col-12 col-md-3">
                        <input type="file" name="logo" class="form-control-file" id="logo">
                    </div>


                    <div class="form-group col-12 col-md-3">
                        <label for="supplier_due"> {{ __('translate.Supplier Due') }} </label>
                    </div>


                    <div class="form-group col-12 col-md-3">
                        <select class="form-control" value="" name="supplier_due" id="supplier_due">
                            <option selected disabled value="">Select</option>


                          @if($settings->supplier_due == 'yes')
                            <option selected value="yes"> Yes</option>
                            <option value="no"> No</option>

                        @else
                        <option  value="yes"> Yes</option>
                        <option selected value="no"> No</option>
                         @endif

                          

                        </select>


                    </div>




                </div>

                <div class="row m-4">




                </div>

                <div class=" col-12 col-md-3 ">
                    <button type="submit" id="submit" class="form-control btn bg-abasas-dark btn-block">
                        {{ __('translate.Update') }}</button>


                </div>



            </form>
        </div>




    </div>
</div>





@endsection
