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
                <a class="navbar-brand">নতুন পণ্য</a>

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
                                        <label for="productName"> Product Name <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-md-8 col-12">
                                        <textarea type="text" name="name" class="form-control" id="name" placeholder="Produc Name" required></textarea>
                                    </div>



                                </div>
                                
                            </div>


                            <div class="form-group col-12 ">
                                <div class="row">
                                    <div class="col-md-4 col-12">
                                        <label for="brand_id">Product Brand  <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-md-8 col-12">
                                        <select class="form-control" value="" name="brand_id" id="brand_id"
                                            required>
                                            <option selected="selected" disabled>Select Category </option>
                                            @foreach ($brands as $brand)
                                            @if ($loop->first)
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
                                        <label for="catagory_id">Product Category  <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-md-8 col-12">
                                        <select class="form-control form-control" value="" name="category_id" id="catagory_id"
                                            required>
                                            <option selected="selected" disabled>Select Category </option>
                                            
                                            @foreach ($categories as $category)
                                            @if ($loop->first)
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
                                        <label for="type_id">Product Type  <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-md-8 col-12">
                                        <select class="form-control form-control" name="type_id" id="type_id" required>
                                            <option selected disabled>Select Product Types </option>
                                            @foreach ($types as $type)
                                            <option value="{{$type->id}}"> {{$type->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>



                                </div>
                                
                            </div>




                            

                            

                            <div class="form-group col-12 ">
                                <div class="row">
                                    <div class="col-md-4 col-12">
                                        <label for="unit_id">Unit  <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-md-8 col-12">
                                        
                                        <select class="form-control form-control" name="unit_id" id="unit_id" required>
                                            <option selected disabled> Select Unit </option>
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
                                        <label for="price">Price  <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-md-8 col-12">
                                        
                                         <input type="number" name="price" id="price" class="form-control" min='0' placeholder="Price" required>
                                    </div>



                                </div>
                                
                            </div>

                            
                            <div class="form-group col-12 ">
                                <div class="row">
                                    <div class="col-md-4 col-12">
                                        <label for="description"> Description</label>
                                    </div>
                                    <div class="col-md-8 col-12">
                                        <textarea type="text" name="description" class="form-control" id="description" placeholder="Description"></textarea>
                                    </div>



                                </div>
                                
                            </div>



                        </div>


                    </div>

                    <div class="col-md-4 col-12 text-dark" style="background-color: #E5E4E2;">


                        <div class="form-group col-12  ">
                            <label for="stock_alert"> Stock Alert</label>
                            <input type="number" name="stock_alert" class="form-control" id="stock_alert" 
                                value="1" min=1>
                        </div>




                        <div class="form-group col-12  ">
                            <label for="warrenty_id">Warrenty</label>
                            <select class="form-control" name="warrenty_id" id="warrenty_id" required>
                                
                                @foreach ($warrenties as $warrenty)
                                @if($loop->first)
                                <option  selected value="{{$warrenty->id}}"> {{$warrenty->name}}</option>
                                @else
                                <option value="{{$warrenty->id}}"> {{$warrenty->name}}</option>
                                @endif
                                    
                                @endforeach

                            </select>
                        </div>

                        <div class="form-group col-12  ">
                            <label for="tax_type_id">Tax Type</label>
                            <select class="form-control" name="tax_type_id" id="tax_type_id" required>
                               
                                @foreach ($tax_types as $tax_type)
                                @if($loop->first)
                                <option selected value="{{$tax_type->id}}"> {{$tax_type->name}}</option>
                                @else
                                <option value="{{$tax_type->id}}"> {{$tax_type->name}}</option>
                                @endif
                                    
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-12  ">
                            <label for="tax">Tax (%)</label>

                            <input type="number" name="tax" id="tax" class="form-control" min=0 value="0">
                        </div>

                    </div>

                   <button type="submit" id="product-create-submit-button btn-lg" class="btn bg-abasas-dark"> Create Product</button>

                </div>

            </form>



        </div>
    </div>




</div>


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
    });

</script>



@endsection
