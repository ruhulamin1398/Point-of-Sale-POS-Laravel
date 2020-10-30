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
                    <div class="form-group col-md-8 col-sm-12 ">
                        <label for="productName"> পণ্যের নাম</label>
                        <textarea type="text" name="name" class="form-control" id="name" placeholder="পণ্যের নাম"></textarea>
                    </div>
                    <div class="form-group col-md-4 col-sm-12 ">
                        <label for="productName"> Limit</label>
                        <input type="number" name="stock_alert" class="form-control" id="stock_alert" placeholder="" value="1" min=1>
                    </div>





                    <div class="form-group col-md-4 col-sm-12  p-4">
                         <label for="catagory_id">পণ্যের ক্যাটাগরি</label> 
                        <select class="form-control form-control" value="" name="category_id" id="catagory_id" required>
                            <option selected="selected">Select Category </option>
                            @foreach ($categories as $category)
                            <option value="{{$category->id}}"> {{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-4 col-sm-12  p-4">
                      <label for="catagory_id">পণ্যের ক্যাটাগরি</label> 
                        <select class="form-control form-control" name="type_id" id="type_id" required>
                            <option>Select Product Types </option>
                            @foreach ($types as $type)
                            <option value="{{$type->id}}"> {{$type->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-4 col-sm-12  p-4">
                        <label for="catagory_id">পণ্যের ক্যাটাগরি</label>
                        <select class="form-control form-control" name="brand_id" required>
                            <option>Select brands </option>
                            @foreach ($brands as $brand)
                            <option value="{{$brand->id}}"> {{$brand->name}}</option>
                            @endforeach
                        </select>

                    </div>





                    <div class="form-group col-md-4 col-sm-12 p-4">

                        <label for="catagory_id">পণ্যের ক্যাটাগরি</label>
                        <input type="number" name="sell" id="" class="form-control" min='0' placeholder="Price">
                    </div>


                    <div class="form-group col-md-4 col-sm-12  p-4">
                        <label for="catagory_id">পণ্যের ক্যাটাগরি</label>
                        <select class="form-control form-control" name="unit_id" id="unit_id" required>
                            <option> Select Unit </option>
                            {{---
                            @foreach ($units as $unit)
                            <option value="{{$unit->id}}"> {{$unit->name}}</option>
                            @endforeach
                            ---}}
                        </select>
                    </div>

                    <div class="form-group col-md-4 col-sm-12  p-4">
                        <label for="catagory_id">পণ্যের ক্যাটাগরি</label> 

                        <input type="number" name="tax" id="" class="form-control" min=0 placeholder="Tax %">
                    </div>
                </div>







                <!-- 
<div class="row">

           
                <div class="form-group col-9">
                    <label for="lowLimit">description </label>
                    <textarea type="text"   name="low_limit" class="form-control" id="lowLimit" placeholder="" ></textarea>
                </div>


</div>
    -->


                <button type="submit" id="product-create-submit-button" class="btn bg-abasas-dark"> সাবমিট</button>



            </form>



        </div>
    </div>




</div>


<script>
    $(document).ready(function() {


        $("#type_id").on('change', function() {
            var type_id = $("#type_id").val();
            var units = @json($units);
            var dataArray=units[type_id] ;
            // console.log(type_id);units[type_id]


            html = "";
            $.each(dataArray, function(key) {

                html += '<option value="' + dataArray[key].id + '" >' + dataArray[key].name + '</option>';
            });
            $("#unit_id").html(html);
        });
    });
</script>



@endsection