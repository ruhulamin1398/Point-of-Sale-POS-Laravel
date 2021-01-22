
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
    <div class="card shadow mb-4">
        <div class="card-header py-3 bg-abasas-dark">
            <nav class="navbar navbar-dark ">
                <a class="navbar-brand">{{ __("translate.Product List") }}</a>
               <a href="{{ route("products.create") }}"> <button class="btn btn-success " id="create-button">{{ __("translate.Add Product") }}</button></a>
            </nav>
        </div>
        <div class="card-body">
            <div class="table-responsive" >
                <table class="table table-striped table-bordered" id="productTable" width="100%" cellspacing="0">
                    <thead class="bg-abasas-dark">


                        <tr>
                            <th>{{ __("translate.Id") }}</th>
                            <th>{{ __("translate.Name") }}</th>
                            <th>{{ __("translate.Category") }}</th>
                            <th>{{ __("translate.Brand") }}</th>
                            <th>{{ __("translate.Cost") }}</th>
                            <th>{{ __("translate.Price") }} </th>
                            <th>{{ __("translate.Stock") }} </th>
                            <th>{{ __("translate.tax") }} (%)</th>
                            <th>{{ __("translate.warrenty") }} </th>
                            <th>{{ __("translate.Action") }}</th>
                        </tr>
                    </thead>
                    <tfoot class="bg-abasas-dark">
                        <tr> 
                            <th>{{ __("translate.Id") }}</th>
                            <th>{{ __("translate.Name") }}</th>
                            <th>{{ __("translate.Category") }}</th>
                            <th>{{ __("translate.Brand") }}</th>
                            <th>{{ __("translate.Cost") }}</th>
                            <th>{{ __("translate.Price") }} </th>
                            <th>{{ __("translate.Stock") }} </th>
                            <th>{{ __("translate.tax") }} (%)</th>
                            <th>{{ __("translate.warrenty") }} </th>
                            <th>{{ __("translate.Action") }}</th>
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
                            <td id="viewCost">{{$product->cost_per_unit}}</td>
                            <td id="viewCost"> {{$product->price_per_unit * $product->unit->value}} 
                                 @if ($product->is_fixed_price == 1)
                                    (Fixed)
                                @else 
                                 (Not Fixed)
                                @endif  </td>
                            <td id="viewLowLimit">{{$product->stock / $product->unit->value}}</td>
                            <td id="viewLowLimit">{{$product->tax}} ({{ $product->taxType->name }})</td>
                            <td id="viewLowLimit">{{$product->warrenty->name}}</td>



                            <td class="align-middle"> 
                                <a href="{{ route('products.edit',$product->id) }}"> <button type="button" title="Edit Product" class="btn btn-success btn-sm" id="edit-product-button" product-item-id={{$id}} value={{$id}}> <i class="fa fa-edit" aria-hidden="false"> </i></button></a>


                                <form method="POST" action="{{ route('products.destroy',  $product->id )}} " id="delete-form-{{ $product->id }}" style="display:none; ">
                                    {{csrf_field() }}
                                    {{ method_field("delete") }}
                                </form>
                               




                                <button title="Delete Product" class="btn btn-danger  btn-sm" onclick="if(confirm('are you sure to delete this')){
				document.getElementById('delete-form-{{ $product->id }}').submit();
			}
			else{
				event.preventDefault();
			}
			" class="btn btn-danger btn-sm btn-raised">
                                    <i class="fa fa-trash" aria-hidden="false">

                                    </i>
                                </button>

                                <button type="button" class="btn btn-info btn-sm" title="Print Barcode" id="barcode-print-button" product-item-id={{$id}} value={{$id}} data-toggle="modal" data-target="#barcode-print-modal"> <i class="fa fa-print" aria-hidden="false"> </i></button>
                                <a href="{{ route('products.show',$id) }}"><button type="button" class="btn btn-primary btn-sm" title="View product" id="product-view-button" > <i class="fa fa-eye" aria-hidden="false"> </i></button></a>


                            </td>

                        </tr>
                        @endforeach 

                    </tbody>
                </table>



            </div>
        </div>
    </div>

</div>






<!-- print code  product -->
<div class="modal fade" id="barcode-print-modal" tabindex="-1" role="dialog" aria-labelledby="edit-product-modal-label"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark" id="edit-product-modal-label ">Print Barcode</h5>
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
                                <form method="POST" action="{{ route('bar-codes.store') }}">
                                    @csrf
                                    <div id="barcodePrintData">

                                    </div>
                                    <div class="row align-items-center">



                                        <div class="col-auto">
                                            <span class="text-dark pl-2"> Product Id</span>
                                            <input type="number" name="product_id" id="barcodeProductInputId"
                                                class="form-control mb-2" required readonly>
                                        </div>

                                        <div class="col-auto">

                                            <span class="text-dark pl-2"> Quantity</span>
                                            <input type="number" name="quantity" class="form-control mb-2" required>
                                        </div>

                                        <div class="col-auto" id="checkBoxDiv">
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

        $(document).on('click','#barcode-print-button',function(){
          
           var id = $(this).attr('product-item-id'); 
           $('#barcodeProductInputId').val(id);
           var html = '';
           var allProducts = @json($products);
           var product ;
           
           $.each(allProducts, function (key, value) {
                if(value.id == id){
                    product = value;
                }
           });
            if(product.is_fixed_price == 1){
                html += '<input class="form-check-input" type="checkbox" name="print_price" id="print_price" checked>';
                html += '<label class="form-check-label" for="print_price">Print Price  </label>';
            }
            else{
                
                html += '<input class="form-check-input" type="checkbox" name="print_price" id="print_price">';
                html += '<label class="form-check-label" for="print_price">Print Price  </label>';

            }
            $('#checkBoxDiv').html(html);
        });





        
    })
</script>


 
@endsection