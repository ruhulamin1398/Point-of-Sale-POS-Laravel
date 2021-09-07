@extends('includes.app')


@section('content')

@php
$create_setting = $settings->setting;
@endphp

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
<div class="container-fluid   p-0">
    <div class="card mb-4 shadow">


        <div class="card-header py-3 bg-abasas-dark">
            <nav class="navbar navbar-dark ">
                <a class="navbar-brand">{{__('translate.New Product')  }} @can('Super Admin') <i
                        class="fas fa-tools pl-2" id="pageSetting" data-toggle="modal" data-target="#setting-modal"></i>
                    @endcan </a>

            </nav>
        </div>
        <div class="card-body">



            <form method="POST" id="product-create-form" action="{{ route('products.store') }}">
                @csrf


                <div class="row">

                    <div class="col-md-8 col-12">
                        <div class="row">


                            <div class="form-group col-12 ">
                                <div class="row">
                                    <div class="col-md-4 col-12">
                                        <label for="productName"> {{ __('translate.Product Name') }} <span
                                                class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-md-8 col-12">
                                        <textarea type="text" name="name" class="form-control" id="name"
                                            placeholder="Product Name" required></textarea>
                                    </div>



                                </div>

                            </div>


                            <div class="form-group col-12 ">
                                <div class="row">
                                    <div class="col-md-4 col-12">
                                        <label for="brand_id"> {{ __('translate.Product Brand') }} <span
                                                class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-md-8 col-12">
                                        <select class="form-control" value="" name="brand_id" id="brand_id" required>
                                            <option selected="selected" disabled value="">Select Brand</option>
                                            @foreach ($brands as $brand)
                                            @if ($create_setting['brand_id'] == $brand->id)
                                            <option selected value="{{$brand->id}}"> {{$brand->name}}</option>
                                            @else
                                            <option value="{{$brand->id}}"> {{$brand->name}}</option>
                                            @endif

                                            @endforeach
                                        </select>
                                    </div>



                                </div>

                            </div>

                            <div class="form-group col-12 ">
                                <div class="row">
                                    <div class="col-md-4 col-12">
                                        <label for="catagory_id">{{ __('translate.Product Category') }} <span
                                                class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-md-8 col-12">
                                        <select class="form-control form-control" value="" name="category_id"
                                            id="catagory_id" required>
                                            <option selected="selected" disabled value="">Select Category</option>

                                            @foreach ($categories as $category)
                                            @if ($create_setting['category_id']== $category->id)
                                            <option selected value="{{$category->id}}"> {{$category->name}}</option>
                                            @else
                                            <option value="{{$category->id}}"> {{$category->name}}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                    </div>



                                </div>

                            </div>



                            <div class="form-group col-12 ">
                                <div class="row">
                                    <div class="col-md-4 col-12">
                                        <label for="type_id"> {{ __('translate.Product Type') }}<span
                                                class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-md-8 col-12">
                                        <select class="form-control form-control" name="type_id" id="type_id" required>
                                            <option selected disabled value="">Select Product Types </option>
                                            @foreach ($types as $type)
                                            @if($create_setting['type_id']== $type->id)
                                            <option selected value="{{$type->id}}"> {{$type->name}}</option>
                                            @else
                                            <option value="{{$type->id}}"> {{$type->name}}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                    </div>



                                </div>

                            </div>








                            <div class="form-group col-12 ">
                                <div class="row">
                                    <div class="col-md-4 col-12">
                                        <label for="unit_id">{{ __('translate.Unit') }} <span
                                                class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-md-8 col-12">

                                        <select class="form-control form-control" name="unit_id" id="unit_id" required>
                                            <option selected disabled value="">Select Unit</option>
                                            @foreach ($units[$create_setting['type_id']] as $unit)
                                            @if($create_setting['unit_id']== $unit->id)
                                            <option selected value="{{$unit->id}}"> {{$unit->name}}</option>
                                            @else
                                            <option value="{{$unit->id}}"> {{$unit->name}}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                    </div>



                                </div>

                            </div>





                            <div class="form-group col-12 ">
                                <div class="row">
                                    <div class="col-md-4 col-12">
                                        <label for="price">{{ __('translate.Price') }} <span
                                                class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <select class="form-control form-control" name="is_fixed_price"
                                            id="is_fixed_price" required>
                                            @if($create_setting['is_fixed_price']== 1)
                                            <option selected value="1"> {{ __('translate.Fixed Price') }} </option>
                                            <option value="0"> {{ __('translate.Not Fixed') }} </option>
                                            @else
                                            <option value="1"> {{ __('translate.Fixed Price') }} </option>
                                            <option selected value="0"> {{ __('translate.Not Fixed') }} </option>
                                            @endif
                                        </select>
                                    </div>
                                    <div class="col-md-4 col-12" id="priceDiv">
                                        <input type="number" step="any" name="price" id="price" class="form-control"
                                            min='0' placeholder="Price" required>

                                    </div>



                                </div>

                            </div>


                            <div class="form-group col-12 ">
                                <div class="row">
                                    <div class="col-md-4 col-12">
                                        <label for="description"> {{ __('translate.Description') }}</label>
                                    </div>
                                    <div class="col-md-8 col-12">
                                        <textarea type="text" name="description" class="form-control" id="description"
                                            placeholder="Description"></textarea>
                                    </div>



                                </div>

                            </div>



                        </div>


                    </div>

                    <div class="col-md-4 col-12 text-dark" style="background-color: #E5E4E2;">


                        <div class="form-group col-12  ">
                            <label for="stock_alert"> {{ __('translate.Stock Alert') }}</label>
                            <input type="number" step="any" name="stock_alert" class="form-control" id="stock_alert"
                                value="{{ $create_setting['stock_alert'] }}" min=1>
                        </div>




                        <div class="form-group col-12  ">
                            <label for="warrenty_id"> {{ __('translate.Warrenty') }}</label>
                            <select class="form-control" name="warrenty_id" id="warrenty_id" required>

                                @foreach ($warrenties as $warrenty)
                                @if($create_setting['warrenty_id']== $warrenty->id)
                                <option selected value="{{$warrenty->id}}"> {{$warrenty->name}}</option>
                                @else
                                <option value="{{$warrenty->id}}"> {{$warrenty->name}}</option>
                                @endif

                                @endforeach

                            </select>
                        </div>
      @can('tax')
                        <div class="form-group col-12  ">
                            <label for="tax_type_id"> {{ __('translate.Tax Type') }}</label>
                            <select class="form-control" name="tax_type_id" id="tax_type_id" required>

                                @foreach ($tax_types as $tax_type)
                                @if($create_setting['tax_type_id']== $tax_type->id)
                                <option selected value="{{$tax_type->id}}"> {{$tax_type->name}}</option>
                                @else
                                <option value="{{$tax_type->id}}"> {{$tax_type->name}}</option>
                                @endif

                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-12  ">
                            <label for="tax">{{ __('translate.Tax') }} (%)</label>

                            <input type="number" step="any" name="tax" id="tax" class="form-control" min=0 value="0">
                        </div>

                 

                    
@endcan
                        <div class="form-group col-12  ">
                            <label for="stock_controll"> {{ __('translate.Stock Control') }}</label>
                            <select class="form-control" name="stock_controll" id="stock_controll">
                                @if ($create_setting['stock_controll'] == "yes")
                                <option selected value="yes"> Yes</option>
                                <option value="no">No</option>
                                @else
                                <option value="yes"> Yes</option>
                                <option selected value="no">No</option>
                                @endif
                            </select>
                        </div>


                    </div>

                    <button type="submit" id="product-create-submit-button btn-lg" class="btn bg-abasas-dark">
                        {{ __('translate.Submit')}}</button>

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
                    <a class="navbar-brand">{{__('translate.Initial Setup')}}</a>

                </nav>

                <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span>
                </button>

            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <form method="POST" action="{{route('settings.update',$settings->id)}}">
                        @csrf
                        @method('put') 
                        <table class="table table-striped table-bordered" width="100%" cellspacing="0">
                            <tbody>

                                <tr class="data-row">

                                    <td>{{ __('translate.Product Brand') }} </td>
                                    <td> <select class="form-control" value="" name="brand_id" id="brand_id" required>
                                            <option selected="selected" disabled value="">Select Brand</option>
                                            @foreach ($brands as $brand)
                                            @if ($create_setting['brand_id'] == $brand->id)
                                            <option selected value="{{$brand->id}}"> {{$brand->name}}</option>
                                            @else
                                            <option value="{{$brand->id}}"> {{$brand->name}}</option>
                                            @endif

                                            @endforeach
                                        </select> </td>


                                </tr>

                                <tr class="data-row">

                                    <td>{{ __('translate.Product Category') }} </td>
                                    <td>
                                        <select class="form-control form-control" value="" name="category_id"
                                            id="catagory_id" required>
                                            <option selected="selected" disabled value="">Select Category</option>

                                            @foreach ($categories as $category)
                                            @if ($create_setting['category_id']== $category->id)
                                            <option selected value="{{$category->id}}"> {{$category->name}}</option>
                                            @else
                                            <option value="{{$category->id}}"> {{$category->name}}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                    </td>


                                </tr>

                                <tr class="data-row">

                                    <td>{{ __('translate.Product Type') }} </td>
                                    <td> <select class="form-control form-control" name="type_id" id="modal_type_id"
                                            required>
                                            <option selected disabled value="">Select Product Types </option>
                                            @foreach ($types as $type)
                                            @if($create_setting['type_id']== $type->id)
                                            <option selected value="{{$type->id}}"> {{$type->name}}</option>
                                            @else
                                            <option value="{{$type->id}}"> {{$type->name}}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                    </td>


                                </tr>

                                <tr class="data-row">

                                    <td>{{ __('translate.Unit') }} </td>
                                    <td>
                                        <select class="form-control form-control" name="unit_id" id="modal_unit_id"
                                            required>
                                            <option selected disabled value="">Select Unit</option>
                                            @foreach ($units[$create_setting['type_id']] as $unit)
                                            @if($create_setting['unit_id']== $unit->id)
                                            <option selected value="{{$unit->id}}"> {{$unit->name}}</option>
                                            @else
                                            <option value="{{$unit->id}}"> {{$unit->name}}</option>
                                            @endif
                                            @endforeach

                                        </select>
                                    </td>


                                </tr>

                                <tr class="data-row">

                                    <td>{{ __('translate.Price Type') }} </td>
                                    <td>
                                        <select class="form-control form-control" name="is_fixed_price"
                                            id="is_fixed_price" required>
                                            @if($create_setting['is_fixed_price']== 1)
                                            <option selected value="1"> {{ __('translate.Fixed Price') }} </option>
                                            <option value="0"> {{ __('translate.Not Fixed') }} </option>
                                            @else
                                            <option value="1"> {{ __('translate.Fixed Price') }} </option>
                                            <option selected value="0"> {{ __('translate.Not Fixed') }} </option>
                                            @endif
                                        </select>
                                    </td>


                                </tr>

                                <tr class="data-row">

                                    <td>{{ __('translate.Stock Alert') }} </td>
                                    <td>
                                        <input type="number" step="any" name="stock_alert" class="form-control"
                                            id="stock_alert" value="{{ $create_setting['stock_alert'] }}" min=1>
                                    </td>


                                </tr>

                                <tr class="data-row">

                                    <td>{{ __('translate.Warrenty') }} </td>
                                    <td>
                                        <select class="form-control" name="warrenty_id" id="warrenty_id" required>

                                            @foreach ($warrenties as $warrenty)
                                            @if($create_setting['warrenty_id']== $warrenty->id)
                                            <option selected value="{{$warrenty->id}}"> {{$warrenty->name}}</option>
                                            @else
                                            <option value="{{$warrenty->id}}"> {{$warrenty->name}}</option>
                                            @endif

                                            @endforeach

                                        </select>
                                    </td>


                                </tr>

                                <tr class="data-row">

                                    <td>{{ __('translate.Tax Type') }} </td>
                                    <td>
                                        <select class="form-control" name="tax_type_id" id="tax_type_id" required>

                                            @foreach ($tax_types as $tax_type)
                                            @if($create_setting['tax_type_id']== $tax_type->id)
                                            <option selected value="{{$tax_type->id}}"> {{$tax_type->name}}</option>
                                            @else
                                            <option value="{{$tax_type->id}}"> {{$tax_type->name}}</option>
                                            @endif

                                            @endforeach
                                        </select>
                                    </td>


                                </tr>

                                <tr class="data-row">

                                    <td>{{ __('translate.Tax') }} </td>
                                    <td>

                                        <input type="number" step="any" name="tax" id="tax" class="form-control" min=0
                                            value="{{ $create_setting['tax'] }}">
                                    </td>


                                </tr>

                                <tr class="data-row">

                                    <td>{{ __('translate.Stock Control') }} </td>
                                    <td>
                                        <select class="form-control" name="stock_controll" id="stock_controll">
                                            @if ($create_setting['stock_controll'] == "yes")
                                            <option selected value="yes"> Yes</option>
                                            <option value="no">No</option>
                                            @else
                                            <option value="yes"> Yes</option>
                                            <option selected value="no">No</option>
                                            @endif

                                        </select>
                                    </td>


                                </tr>
                            </tbody>
                        </table>

                        <button type="submit" id="product-create-submit-button btn-lg" class="btn bg-abasas-dark" style="float: right">
                            {{ __('translate.Submit')}}</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endcan


<script>
    $(document).ready(function () {


        $("#type_id").on('change', function () {
            var type_id = $("#type_id").val();
            var units = @json($units);
            var dataArray = units[type_id];
            // console.log(type_id);units[type_id]


            html = "";
            $.each(dataArray, function (key) {

                html += '<option value="' + dataArray[key].id + '" >' + dataArray[key].name +
                    '</option>';
            });
            $("#unit_id").html(html);
        });




        $("#modal_type_id").on('change', function () {
            var type_id = $("#modal_type_id").val();
            var units = @json($units);
            var dataArray = units[type_id];
            // console.log(type_id);units[type_id]


            html = "";
            $.each(dataArray, function (key) {

                html += '<option value="' + dataArray[key].id + '" >' + dataArray[key].name +
                    '</option>';
            });
            $("#modal_unit_id").html(html);
        });
    });

</script>



@endsection
