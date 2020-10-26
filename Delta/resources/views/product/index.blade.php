
@extends('includes.app')

@section('content')



<!-- Begin Page Content -->
<div class="container-fluid">




    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 bg-abasas-dark">
            <nav class="navbar navbar-dark ">
                <a class="navbar-brand">Product List</a>
               <a href="{{ route("products.create") }}"> <button class="btn btn-success " id="create-button">Add Product</button></a>
            </nav>
        </div>
        <div class="card-body">
            <div class="table-responsive" >
                <table class="table table-striped table-bordered" id="productTable" width="100%" cellspacing="0">
                    <thead class="bg-abasas-dark">


                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Brand</th>
                            <th>Sell Type</th>
                            <th>Cost</th>
                            <th> Price</th>
                            <th> Stock</th>
                            <th> Stock Alert</th>
                            <th> tax (%)</th>
                            <th> warrenty</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot class="bg-abasas-dark">
                        <tr> 
                            <th>Id</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Brand</th>
                            <th>Sell Type</th>
                            <th>Cost</th>
                            <th> Price</th>
                            <th> Stock</th>
                            <th> Stock Alert</th>
                            <th> tax (%)</th>
                            <th> warrenty</th>
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
                            <td id="viewSell">{{$product->category->name}}</td>
                            <td id="viewProductTypeId">{{$product->brand->name}}</td>
                            <td id="viewProductTypeId">{{$product->type->name}}</td>
                            <td id="viewCost">{{$product->cost_per_unit}}</td>
                            <td id="viewCost">{{$product->price_per_unit}}</td>
                            <td id="viewLowLimit">{{$product->stock}}</td>
                            <td id="viewLowLimit">{{$product->stock_alert}}</td>
                            <td id="viewLowLimit">{{$product->tax}} ({{ $product->taxType->name }})</td>
                            <td id="viewLowLimit">{{$product->warrenty->name}}</td>



                            <td class="align-middle">
                                <button type="button" title="Edit Product" class="btn btn-success m-1" id="edit-product-button" product-item-id={{$id}} value={{$id}}> <i class="fa fa-edit" aria-hidden="false"> </i></button>


                                <form method="POST" action="{{ route('products.destroy',  $product->id )}} " id="delete-form-{{ $product->id }}" style="display:none; ">
                                    {{csrf_field() }}
                                    {{ method_field("delete") }}
                                </form>
                               




                                <button title="Delete Product" class="btn btn-danger m-1 " onclick="if(confirm('are you sure to delete this')){
				document.getElementById('delete-form-{{ $product->id }}').submit();
			}
			else{
				event.preventDefault();
			}
			" class="btn btn-danger btn-sm btn-raised">
                                    <i class="fa fa-trash" aria-hidden="false">

                                    </i>
                                </button>

                                <button type="button" class="btn btn-info m-1" title="Print Barcode" id="barcode-print-button" product-item-id={{$id}} value={{$id}}> <i class="fa fa-print" aria-hidden="false"> </i></button>


                            </td>

                        </tr>
                        @endforeach 

                    </tbody>
                </table>



            </div>
        </div>
    </div>

</div>



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

                <form method="POST" id="create-form" action="">  {{-- {{ route('products.update' ) }} --}}

                    @csrf


                    <div class="form-group">
                        <label for="editProductId2">Id</label>
                        <input type="text" class="form-control" id="editProductId2" disabled>
                    </div>

                    <div class="form-group">

                        <input type="text" name="id" class="form-control" id="editProductId" placeholder="Enter product name" hidden>
                    </div>

                    <div class="form-group">
                        <label for="editProductName"> Product Name</label>
                        <input type="text" name="name" class="form-control" id="editProductName" placeholder="Enter product name"required>
                    </div>

                    <div class="form-group">
                        <label for="editProductCatagoryId">Product Category</label>
                        <select class="form-control form-control" name="category_id" id="editProductCatagoryId"required>

                        </select>
                    </div>

                    <div class="form-group">
                        <label for="editProductBrandId">Product Brand</label>
                        <select class="form-control form-control" name="brand_id" id="editProductBrandId"required>

                        </select>
                    </div>

                    <div class="form-group">
                        <label for="editProductTypeId">Sell Type</label>
                        <select class="form-control form-control" name="type_id" id="editProductTypeId"required>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="editProductUnitId">Unit Type</label>
                        <select class="form-control form-control" name="unit_id" id="editProductUnitId"required>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="editProductTaxtId">Tax Type</label>
                        <select class="form-control form-control" name="tax_type_id" id="editProductTaxtId"required>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="editProductTax"> Tax (%)</label>
                        <input type="number" name="tax" class="form-control" id="editProductTax" placeholder="" required>
                    </div>

                    <div class="form-group">
                        <label for="editProductPrice">Price</label>
                        <input type="number" step="any" name="price" class="form-control" id="editProductPrice" placeholder=""required>
                    </div>

                    <div class="form-group">
                        <label for="editStockAlert">Stock Alert</label>
                        <input type="number" step="any" name="stock_alert" class="form-control" id="editStockAlert" placeholder=""required>
                    </div>


                    <button type="submit" class="btn btn-primary"> সাবমিট</button>



                </form>



            </div>

        </div>
    </div>
</div>
</div>
<!-- /edit  product-->




<!-- print code  product -->
<div class="modal fade" id="barcode-print-modal" tabindex="-1" role="dialog" aria-labelledby="edit-product-modal-label"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark" id="edit-product-modal-label ">Print Code</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="attachment-body-content">


                <div class="row ">

                    <!-- main body start -->
                    <div class="col-xl-12 col-lg-12 col-md-12   ">


                        <div class="card mb-4 shadow">




                            <div class="card-body">
                                <form method="POST" action="{{ route('bar_code.store') }}">
                                    @csrf
                                    <div id="barcodePrintData">

                                    </div>
                                    <div class="form-row align-items-center">



                                        <div class="col-auto">
                                            <span class="text-dark pl-2"> Product Id</span>
                                            <input type="number" name="id" id="barcodeProductInput"
                                                class="form-control mb-2" required readonly>
                                        </div>

                                        <div class="col-auto">

                                            <span class="text-dark pl-2"> Quantity</span>
                                            <input type="number" name="amount" class="form-control mb-2" required>
                                        </div>


                                        <div class="col-auto">
                                            <button type="submit" class="btn btn-primary mt-3"> Submit</button>
                                        </div>

                                    </div>

                                </form>
                            </div>
                        </div>






                    </div>

                </div>

            </div>

        </div>
    </div>
</div>





<script>
    $(document).ready(function(){
        
        $('#productTable').DataTable({   
            dom: 'lBfrtip',
            buttons: [
                'copy', 'csv', 'excel' , 'pdf' , 'print'
            ]
        });






        
    })
</script>


 
@endsection