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
    <div class="card mb-4 shadow">


        <div class="card-header py-3 bg-abasas-dark">
            <nav class="navbar navbar-dark ">
                <a class="navbar-brand">{{ __('translate.Edit Product') }}</a>

            </nav>
        </div>
        <div class="card-body">



            <form method="POST" id="product-create-form" action="{{ route('products.update',$product->id) }}">
                @csrf
                @method('put')


                <div class="row">

                    <div class="col-md-8 col-12">
                        <div class="row">


                            <div class="form-group col-12 ">
                                <div class="row">
                                    <div class="col-md-4 col-12">
                                        <label for="productName"> {{ __('translate.Product Name') }} <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-md-8 col-12">
                                        <textarea type="text" name="name" class="form-control" id="name" placeholder="Product Name"  required>{{ $product->name }}</textarea>
                                    </div>



                                </div>
                                
                            </div>


                            <div class="form-group col-12 ">
                                <div class="row">
                                    <div class="col-md-4 col-12">
                                        <label for="brand_id">{{ __('translate.Product Brand') }}  <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-md-8 col-12">
                                        <select class="form-control" value="" name="brand_id" id="brand_id"
                                            required>
                                            <option selected="selected" disabled value="">Select Category </option>
                                            @foreach ($brands as $brand)
                                            @if ($brand->id == $product->brand_id)
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
                                        <label for="catagory_id">{{ __('translate.Product Category') }}  <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-md-8 col-12">
                                        <select class="form-control form-control" value="" name="category_id" id="catagory_id"
                                            required>
                                            <option selected="selected" disabled value="">Select Category </option>
                                            @foreach ($categories as $category)
                                            @if ($category->id == $product->category_id)
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
                                        <label for="catagory_id">{{ __('translate.Product Type') }}<span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-md-8 col-12">
                                        <select class="form-control form-control" name="type_id" id="type_id" required>
                                            <option selected disabled value="">Select Product Types </option>
                                            @foreach ($types as $type)
                                            @if($type->id == $product->type_id)
                                            <option selected="selected" value="{{$type->id}}"> {{$type->name}}</option>
                                            @else 
                                            <option  value="{{$type->id}}"> {{$type->name}}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                    </div>



                                </div>
                                
                            </div>




                            

                            

                            <div class="form-group col-12 ">
                                <div class="row">
                                    <div class="col-md-4 col-12">
                                        <label for="catagory_id">{{ __('translate.Unit') }}  <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-md-8 col-12">
                                        
                                        <select class="form-control form-control" name="unit_id" id="unit_id"  required>
                                            <option selected disabled value=""> Select Unit </option>
                                            {{---
                                    @foreach ($units as $unit)
                                    <option value="{{$unit->id}}"> {{$unit->name}}</option>
                                            @endforeach
                                            ---}}
                                        </select>
                                    </div>



                                </div>
                                
                            </div>




                            
                            <div class="form-group col-12 ">
                                <div class="row">
                                    <div class="col-md-4 col-12">
                                        <label for="catagory_id">{{ __('translate.Price') }}   <span class="text-danger">*</span></label>
                                    </div>
                                    

                                    <div class="col-md-4 col-12">
                                        <select class="form-control form-control" name="is_fixed_price" id="is_fixed_price" required>
                                            @if ($product->is_fixed_price ==1)
                                                <option selected value="1"> {{ __('translate.Fixed Price') }} </option>
                                                <option  value="0"> {{ __('translate.Not Fixed') }} </option>
                                             @else 
                                                <option  value="1"> {{ __('translate.Fixed Price') }} </option>
                                                 <option selected  value="0"> {{ __('translate.Not Fixed') }} </option>
                                            @endif
                                        </select>
                                    </div>
                                    <div class="col-md-4 col-12" id="priceDiv">
                                        <input type="number" step="any" name="price" id="price" class="form-control" min='0' placeholder="Price" required>
                                        
                                    </div>




                                </div>
                                
                            </div>

                            
                            <div class="form-group col-12 ">
                                <div class="row">
                                    <div class="col-md-4 col-12">
                                        <label for="productName"> {{ __('translate.Description') }}</label>
                                    </div>
                                    <div class="col-md-8 col-12">
                                        <textarea type="text" name="description" class="form-control" id="description" placeholder="Description">{{ $product->description }}</textarea>
                                    </div>



                                </div>
                                
                            </div>



                        </div>


                    </div>

                    <div class="col-md-4 col-12 text-dark" style="background-color: #E5E4E2;">


                        <div class="form-group col-12  ">
                            <label for="productName">{{ __('translate.Stock Alert') }}</label>
                            <input type="number" step="any" name="stock_alert" class="form-control" id="stock_alert" 
                                value="{{ $product->stock_alert }}" min=1>
                        </div>




                        <div class="form-group col-12  ">
                            <label for="warrenty_id">{{ __('translate.Warrenty') }}</label>
                            <select class="form-control" name="warrenty_id" id="warrenty_id" required>
                                
                                @foreach ($warrenties as $warrenty)
                                @if($warrenty->id == $product->warrenty_id)
                                <option  selected value="{{$warrenty->id}}"> {{$warrenty->name}}</option>
                                @else
                                <option value="{{$warrenty->id}}"> {{$warrenty->name}}</option>
                                @endif
                                    
                                @endforeach

                            </select>
                        </div>

                        <div class="form-group col-12  ">
                            <label for="tax_type_id">{{ __('translate.Tax Type') }}</label>
                            <select class="form-control" name="tax_type_id" id="tax_type_id" required>
                               
                                @foreach ($tax_types as $tax_type)
                                @if($tax_type->id == $product->tax_type_id)
                                <option selected value="{{$tax_type->id}}"> {{$tax_type->name}}</option>
                                @else
                                <option value="{{$tax_type->id}}"> {{$tax_type->name}}</option>
                                @endif
                                    
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-12  ">
                            <label for="catagory_id">{{ __('translate.Tax') }} (%)</label>

                            <input type="number" step="any" name="tax" id="" class="form-control" min=0 value="{{ $product->tax }}">
                        </div>
                        
                        <div class="form-group col-12  ">
                            <label for="stock_controll"> {{ __('translate.Stock Control') }}</label>
                            <select class="form-control" name="stock_controll" id="stock_controll">
                                @if($product->stock_controll=='yes')
                                <option selected value="yes"> Yes</option>
                                <option  value="no">No</option>
                                @else 
                                <option  value="yes"> Yes</option>
                                <option selected value="no">No</option>
                                @endif

                            </select>
                        </div>

                    </div>

                   <button type="submit" id="product-create-submit-button btn-lg" class="btn bg-abasas-dark"> {{ __('translate.Submit')}}</button>

                </div>

            </form>



        </div>
    </div>




</div>


<script>
    $(document).ready(function () {

        var product = @json($product);
        
      

            var type_id = $("#type_id").val();
            var units = @json($units);
            var dataArray = units[type_id];
            
            console.log(type_id);units[type_id]


            html = "";
            $.each(dataArray, function (key) {
                if(dataArray[key].id == product.unit_id){
                    html += '<option selected value="' + dataArray[key].id + '" >' + dataArray[key].name +
                    '</option>';

                    $('#price').val(product.price_per_unit * dataArray[key].value);
                }
                else{
                    html += '<option  value="' + dataArray[key].id + '" >' + dataArray[key].name +
                    '</option>';
                }
                
            });
            $("#unit_id").html(html);
        


        

        $("#type_id").on('change', function () {

            
            type_id = $("#type_id").val();
            
            dataArray = units[type_id];
            
            console.log(type_id);units[type_id]


            html = "";
            $.each(dataArray, function (key) {
                if(dataArray[key].id == product.unit_id){
                    html += '<option selected value="' + dataArray[key].id + '" >' + dataArray[key].name +
                    '</option>';

                    $('#price').val(product.price_per_unit * dataArray[key].value);
                }
                else{
                    html += '<option  value="' + dataArray[key].id + '" >' + dataArray[key].name +
                    '</option>';
                }
                
            });
            $("#unit_id").html(html);
        
           

        });
    });

</script>



@endsection
