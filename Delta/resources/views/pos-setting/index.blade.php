@extends('includes.app')

@section('content')


@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{  __('translate.'.$error) }}</li>
        @endforeach
    </ul>
</div>
@endif

@if (session()->has('success'))
<div class="alert alert-success">
    @if(is_array(session('success')))
    <ul>
        @foreach (session('success') as $message)
        <li>{{  __('translate.'.$message) }}</li>
        @endforeach
    </ul>
    @else
    {{ session('success') }}
    @endif
</div>
@endif




<!-- Begin Page Content -->
<div class="container-fluid">




    <!-- DataTales Example -->
    <div class="card shadow mb-4 ml-0 mr-0">
        <div class="card-header py-3 bg-abasas-dark">
            <nav class="navbar navbar-dark ">
                <a class="navbar-brand">{{ __('translate.System Settings') }}  @can('Super Admin') <i class="fas fa-tools pl-2"
                    id="pageSetting" data-toggle="modal" data-target="#setting-modal"></i> @endcan
</a>

            </nav>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('pos-setting.update',1) }}" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="row m-md-4 m-0">

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


                <div class="row m-md-4 m-0">

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


                <div class="row m-md-4 m-0">

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


                <div class="row m-md-4 m-0">


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
                    <div class="form-group col-12 col-md-3">
                        <label for="stock_controll"> {{ __('translate.Stock Controll') }} </label>
                    </div>


                    <div class="form-group col-12 col-md-3">
                        <select class="form-control" value="" name="stock_controll" id="stock_controll">
                            <option selected disabled value="">Select</option>


                          @if($settings->stock_controll == 'yes')
                            <option selected value="yes"> Yes</option>
                            <option value="no"> No</option>

                        @else
                        <option  value="yes"> Yes</option>
                        <option selected value="no"> No</option>
                         @endif

                          

                        </select>


                    </div>
                    
                    <div class="form-group col-12 col-md-3">
                        <label for="customer_due"> {{ __('translate.Shop Logo') }} </label>
                    </div>


                    <div class="form-group col-12 col-md-3">
                        <input type="file" name="logo"  class="form-control-file" id="logoImage" accept=".png, .jpg, .jpeg" >
                    </div>





                </div>

                <div class="row m-md-4 m-0">




                </div>

                <div class=" col-12 col-md-3 ">
                    <button type="submit" id="submit" class="form-control btn bg-abasas-dark btn-block">
                        {{ __('translate.Update') }}</button>


                </div>



            </form>
        </div>




    </div>
</div>


@can('Super Admin')
<!-- Attachment Modal -->
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
           <input type="text" name="page_name" value="Pos Setting" required hidden>
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
                       $permision_name = "Pos Setting Page";
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




@endsection
