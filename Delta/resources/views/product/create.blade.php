@extends('layout.app')
@section('content')





<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card mb-4 shadow">

        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Add New Product</h6>
        </div>     <div class="card-body">



            <form method="POST" id="create-form" action="{{ route('products.store') }}">
                @csrf


                <div class="form-group">
                    <label for="productName">Product Name</label>
                    <input type="text" name="name" class="form-control" id="productName" placeholder="Enter product name" required>
                </div>

                <div class="form-group">
                    <label for="catagory_id">Procuct Category</label>
                    <select class="form-control form-control" name="category_id" id="catagory_id" required>
                        <option value="1" selected="selected">Select Category </option>
                        @foreach ($categories as $category)
                        <option value="{{$category->id}}"> {{$category->name}}</option>
                        @endforeach
                    </select>
                </div>


                <div class="form-group">
                    <label for="product_type_id">Procuct Type</label>
                    <select class="form-control form-control" name="product_type_id" id="product_type_id" required>

                        <option value="1" selected="selected">Select Product Type</option>
                        @foreach ($productTypes as $productType)
                        <option value="{{$productType->id}}"> {{$productType->name}}</option>
                        @endforeach
                    </select>
                </div>



                <div class="form-group">
                    <label for="price">Weight</label>
                    <input type="number" name="weight" class="form-control" id="weight" placeholder="120">
                </div>
                


                <div class="form-group">
                    <label for="price_per_unit"> Price Per Unit</label>
                    <input type="number" name="price_per_unit" class="form-control" id="price_per_unit" placeholder="120">
                </div>

                <div class="form-group">
                    <label for="lowLimit">Low Limit</label>
                    <input type="number" name="low_limit" class="form-control" id="lowLimit" placeholder="Enter Lowest Limit">
                </div>


                <button type="submit" class="btn btn-primary">Submit</button>



            </form>



        </div>
    </div>




</div>




@endsection