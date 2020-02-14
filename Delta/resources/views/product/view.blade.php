@extends('layout.app')
@section('content')





<!-- Begin Page Content -->
<div class="container-fluid">




    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <nav class="navbar navbar-light bg-light">
                <a class="navbar-brand">Product list</a>
                <button class="btn btn-success " id="create-button">new Product</button>
            </nav>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="dataTable1" width="100%" cellspacing="0">
                    <thead class="thead-dark">


                        <tr>
                            <th>Product Id</th>
                            <th>Name</th>
                            <th>Weight</th>
                            <th>Sell</th>
                            <th>Category</th>
                            <th>Stock</th>
                            <th>Cost</th>
                            <th>Limit</th>
                            <th>Expire</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot class="thead-dark">
                        <tr>

                            <th>Product Id</th>
                            <th>Name</th>
                            <th>Weight</th>
                            <th>Sell</th>
                            <th>Category</th>
                            <th>Stock</th>
                            <th>Cost</th>
                            <th>Limit</th>
                            <th>Expire</th>
                            <th>Action</th>
                        </tr>

                    </tfoot>
                    <tbody>
                        <?php $id = 1 ?>
                        @foreach ($products as $product)
                        <?php $id = $product->id; ?>
                        <tr class="data-row">
                            <td class="iteration">{{$id}}</td>
                            <td id="viewName">{{$product->name}}</td>
                            <td id="viewCategoryId">{{$product->weight}}</td>
                            <td id="viewSell">{{$product->sell}}</td>
                            <td id="viewProductTypeId">{{$product->category->name}}</td>
                            <td id="viewProductTypeId">{{$product->stock}}</td>
                            <td id="viewCost">{{$product->cost}}</td>
                            <td id="viewLowLimit">{{$product->low_limit}}</td>
                            <td id="viewexpiredate">{{$product->expire_date}}</td>



                            <td class="align-middle">
                                <button type="button" class="btn btn-success" id="edit-product-button" product-item-id={{$id}} value={{$id}}> <i class="fa fa-edit" aria-hidden="false"> </i></button>


                                <form method="POST" action="{{ route('products.destroy',  $product->id )}} " id="delete-form-{{ $product->id }}" style="display:none; ">
                                    {{csrf_field() }}
                                    {{ method_field("delete") }}
                                </form>





                                <button onclick="if(confirm('are you sure to delete this')){
				document.getElementById('delete-form-{{ $product->id }}').submit();
			}
			else{
				event.preventDefault();
			}
			" class="btn btn-danger btn-sm btn-raised">
                                    <i class="fa fa-trash" aria-hidden="false">

                                    </i>
                                </button>



                            </td>

                        </tr>
                        @endforeach

                    </tbody>
                </table>



            </div>
        </div>
    </div>

</div>






<!-- Create new product -->
<div class="modal fade" id="create-modal" tabindex="-1" role="dialog" aria-labelledby="edit-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark" id="edit-modal-label ">Add Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="attachment-body-content">

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
                        <input type="number" name="weight" class="form-control" id="weight" placeholder="" required>
                    </div>

                    <div class="form-group">
                        <label for="cost">Cost</label>
                        <input type="number" name="cost" class="form-control" id="cost" placeholder="" required>
                    </div>


                    <div class="form-group">
                        <label for="price">Sell Price</label>
                        <input type="number" name="price" class="form-control" id="price" placeholder="" required>
                    </div>

                    <div class="form-group">
                        <label for="lowLimit">Low Limit</label>
                        <input type="number" name="low_limit" class="form-control" id="lowLimit" placeholder="Enter Lowest Limit" required>
                    </div>


                    <button type="submit" class="btn btn-primary">Submit</button>



                </form>



            </div>

        </div>
    </div>
</div>
</div>
<!-- /Create new product-->





<!-- edit  product -->
<div class="modal fade" id="edit-product-modal" tabindex="-1" role="dialog" aria-labelledby="edit-product-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark" id="edit-product-modal-label ">Edit Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="attachment-body-content">

                <form method="POST" id="create-form" action="{{ route('productsupdate' ) }}">

                    @csrf


                    <div class="form-group">
                        <label for="editProductId2">Id</label>
                        <input type="text" class="form-control" id="editProductId2" disabled>
                    </div>

                    <div class="form-group">

                        <input type="text" name="id" class="form-control" id="editProductId" placeholder="Enter product name" hidden>
                    </div>

                    <div class="form-group">
                        <label for="editProductName">Product Name</label>
                        <input type="text" name="name" class="form-control" id="editProductName" placeholder="Enter product name"required>
                    </div>

                    <div class="form-group">
                        <label for="editProductCatagoryId">Procuct Category</label>
                        <select class="form-control form-control" name="category_id" id="editProductCatagoryId"required>

                        </select>
                    </div>

                    <div class="form-group">
                        <label for="editProductTypeId">Procuct Type</label>
                        <select class="form-control form-control" name="product_type_id" id="editProductTypeId"required>


                        </select>
                    </div>


                    <div class="form-group">
                        <label for="editProductWeight">Weight</label>
                        <input type="number" name="weight" class="form-control" id="editProductWeight" placeholder="120"required>
                    </div>

                    <div class="form-group">
                        <label for="editProductCost">Cost</label>
                        <input type="number" name="cost" class="form-control" id="editProductCost" placeholder=""required>
                    </div>

                    <div class="form-group">
                        <label for="editProductPrice">Sell Price</label>
                        <input type="number" name="price" class="form-control" id="editProductPrice" placeholder="120"required>
                    </div>

                    <div class="form-group">
                        <label for="editLowLimit">Low Limit</label>
                        <input type="number" name="low_limit" class="form-control" id="editLowLimit" placeholder="Enter Lowest Limit"required>
                    </div>


                    <button type="submit" class="btn btn-primary">Submit</button>



                </form>



            </div>

        </div>
    </div>
</div>
</div>
<!-- /edit  product-->




@endsection