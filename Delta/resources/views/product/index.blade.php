
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
                            <th> tax</th>
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
                            <th> tax</th>
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
                            <td id="viewProductTypeId">{{$product->Brand->name}}</td>
                            <td id="viewProductTypeId">{{$product->type->name}}</td>
                            <td id="viewCost">{{$product->cost_per_unit}}</td>
                            <td id="viewCost">{{$product->price_per_unit}}</td>
                            <td id="viewLowLimit">{{$product->stock}}</td>
                            <td id="viewLowLimit">{{$product->tax}} ({{ $product->taxType->name }})</td>
                            <td id="viewLowLimit">{{$product->warrenty->name}}</td>



                            <td class="align-middle">
                                <button type="button" title="Edit Product" class="btn btn-success" id="edit-product-button" product-item-id={{$id}} value={{$id}}> <i class="fa fa-edit" aria-hidden="false"> </i></button>


                                <form method="POST" action="{{ route('products.destroy',  $product->id )}} " id="delete-form-{{ $product->id }}" style="display:none; ">
                                    {{csrf_field() }}
                                    {{ method_field("delete") }}
                                </form>
                               




                                <button title="Delete Product" onclick="if(confirm('are you sure to delete this')){
				document.getElementById('delete-form-{{ $product->id }}').submit();
			}
			else{
				event.preventDefault();
			}
			" class="btn btn-danger btn-sm btn-raised">
                                    <i class="fa fa-trash" aria-hidden="false">

                                    </i>
                                </button>

                                <button type="button" class="btn btn-info" title="Print Barcode" id="barcode-print-button" product-item-id={{$id}} value={{$id}}> <i class="fa fa-print" aria-hidden="false"> </i></button>


                            </td>

                        </tr>
                        @endforeach 

                    </tbody>
                </table>



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