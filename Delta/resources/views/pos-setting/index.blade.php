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
                <form action="{{ route('pos-setting.store') }}" method="POST" enctype="multipart/form-data">

                    @csrf
                    <div class="row m-4" >

                        <div class="form-group col-12 col-md-3">
                            <label for="name"> {{ __('translate.Shop Name') }} <span class="text-danger">*</span></label>
                        </div>

                        <div class=" form-group col-12 col-md-3">
                            <input type="text" name="shop_name" class="form-control" id="name" value="abasas">
                        </div>



                        <div class="form-group col-12 col-md-3">
                            <label for="shop_moto"> {{ __('translate.Shop Moto') }} <span
                                    class="text-danger">*</span></label>
                        </div>


                        <div class="form-group col-12 col-md-3">
                            <input type="text" name="shop_moto" class="form-control" id="moto" value="abasas moto">
                        </div>




                    </div>


                    <div class="row m-4">

                        <div class="form-group col-12 col-md-3">
                            <label for="phone"> {{ __('translate.Shop Phone') }} <span class="text-danger">*</span></label>
                        </div>

                        <div class="form-group col-12 col-md-3">
                            <input type="text" name="shop_phone" class="form-control" id="phone" value="01712111111">
                        </div>



                        <div class="form-group col-12 col-md-3">
                            <label for="shop_email"> {{ __('translate.Shop Name') }} <span
                                    class="text-danger">*</span></label>
                        </div>


                        <div class="form-group col-12 col-md-3">
                            <input type="email" name="shop_email" class="form-control" id="email" value="abasas@gamil.com">
                        </div>




                    </div>


                    <div class="row m-4">

                        <div class="form-group col-12 col-md-3">
                            <label for="language"> {{ __('translate.Language') }} <span class="text-danger">*</span></label>
                        </div>

                        <div class="form-group col-12 col-md-3">
                            <select class="form-control" value="" name="language" id="language">
                                <option selected disabled value="">Select Language </option>


                                <option value="1"> English</option>
                                <option value="2"> বাংলা</option>


                            </select>

                        </div>



                        <div class="form-group col-12 col-md-3">
                            <label for="due_system"> {{ __('translate.Due System') }} <span
                                    class="text-danger">*</span></label>
                        </div>


                        <div class="form-group col-12 col-md-3">
                            <select class="form-control" value="" name="due_system" id="due_system">
                                <option selected disabled value="">Select</option>


                                <option value="Yes"> Yes</option>
                                <option value="No"> No</option>


                            </select>

                        </div>




                    </div>


                    <div class="row m-4">

                        <div class="form-group col-12 col-md-3">
                            <label for="customer_due"> {{ __('translate.Customer Due') }} <span class="text-danger">*</span></label>
                        </div>

                        <div class="form-group col-12 col-md-3">
                            <select class="form-control" value="" name="customer_due" id="customer_due">
                                <option selected disabled value="">Select</option>


                                <option value="Yes"> Yes</option>
                                <option value="No"> No</option>


                            </select>


                        </div>



                        <div class="form-group col-12 col-md-3">
                            <label for="supplier_due"> {{ __('translate.Supplier Due') }} <span
                                    class="text-danger">*</span></label>
                        </div>


                        <div class="form-group col-12 col-md-3">
                            <select class="form-control" value="" name="supplier_due" id="supplier_due">
                                <option selected disabled value="">Select</option>


                                <option value="Yes"> Yes</option>
                                <option value="No"> No</option>


                            </select>


                        </div>




                    </div>

                    <div class="row m-4">

                        <div class="form-group col-12 col-md-3">
                            <label for="customer_due"> {{ __('translate.Shop Logo') }} <span class="text-danger">*</span></label>
                        </div>

                        
                        <div class="form-group col-12 col-md-3">
                           <input type="file" name="logo" class="form-control-file" id="logo">
                        </div>


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
