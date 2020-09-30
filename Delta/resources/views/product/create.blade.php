@extends('includes.app')


@section('content')







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
                <div class="form-group col-8">
                    <!-- <label for="productName"> পণ্যের নাম</label> -->
                    <textarea type="text"   name="low_limit" class="form-control" id="lowLimit" placeholder="পণ্যের নাম" ></textarea>
                </div>
                <div class="form-group col-4">
                    <label for="productName"> Limit</label>
                    <input type="number" name="number" class="form-control" id="productName" placeholder="" required>
                </div>
                </div>


                <div class="row">

                <div class="form-group col-4">
                    <!-- <label for="catagory_id">পণ্যের ক্যাটাগরি</label> -->
                    <select class="form-control form-control" value="" name="category_id" id="catagory_id" required>
                        <option value="1" selected="selected" >Select Category </option>
                        @foreach ($categories as $category)
                        <option value="{{$category->id}}"> {{$category->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-4">
                    <!-- <label for="catagory_id">পণ্যের ক্যাটাগরি</label> -->
                    <select class="form-control form-control" name="category_id" id="catagory_id" required>
                        <option value="1" >Select Product Types </option>
                        @foreach ($types as $type)
                        <option value="{{$category->id}}"> {{$type->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-4">
                    <!-- <label for="catagory_id">পণ্যের ক্যাটাগরি</label> -->
                    <select class="form-control form-control" name="category_id" id="catagory_id" required>
                        <option value="1" >Select brands </option>
                        @foreach ($brands as $brand)
                        <option value="{{$category->id}}"> {{$brand->name}}</option>
                        @endforeach
                    </select>

                </div>


                
                </div>

<div class="row">

<div class="form-group col-4">
    <!-- <label for="catagory_id">পণ্যের ক্যাটাগরি</label> -->
    <select class="form-control form-control" name="category_id" id="catagory_id" required>
        <option value="1" >ক্যাটাগরি নির্বাচন </option>
        @foreach ($categories as $category)
        <option value="{{$category->id}}"> {{$category->name}}</option>
        @endforeach
    </select>
</div>
<div class="form-group col-4">
    <!-- <label for="catagory_id">পণ্যের ক্যাটাগরি</label> -->
    <select class="form-control form-control" name="category_id" id="catagory_id" required>
        <option value="1" >ক্যাটাগরি নির্বাচন </option>
        @foreach ($categories as $category)
        <option value="{{$category->id}}"> {{$category->name}}</option>
        @endforeach
    </select>
</div>
<div class="form-group col-4">
    <!-- <label for="catagory_id">পণ্যের ক্যাটাগরি</label> -->
    <select class="form-control form-control" name="category_id" id="catagory_id" required>
        <option value="1" >ক্যাটাগরি নির্বাচন </option>
        @foreach ($categories as $category)
        <option value="{{$category->id}}"> {{$category->name}}</option>
        @endforeach
    </select>

</div>



</div>



<div class="row">

           
                <div class="form-group col-9">
                    <label for="lowLimit">description </label>
                    <textarea type="text"   name="low_limit" class="form-control" id="lowLimit" placeholder="" ></textarea>
                </div>


</div>
   


                <button type="button" id="product-create-submit-button" class="btn bg-abasas-dark"     > সাবমিট</button>



            </form>



        </div>
    </div>




</div>






@endsection