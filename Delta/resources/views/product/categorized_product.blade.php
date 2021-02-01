@extends('includes.app')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">



    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 bg-abasas-dark">
            <nav class="navbar navbar-dark ">
                
                
                <span>
                    {{ __("translate.Categorized Product List") }}   @can('Super Admin') <i class="fas fa-tools pl-2"
                    id="pageSetting" data-toggle="modal" data-target="#setting-modal"></i> @endcan  </span>
                   
            </nav>
        </div>
        @can('Product Read')
        <div class="card-body">
            <div class="table-responsive" >
                <table class="table table-striped table-bordered" id="productTable" width="100%" cellspacing="0">
                    <thead class="bg-abasas-dark">


                        <tr>
                            <th>{{ __("translate.Id") }}</th>
                            <th>{{ __("translate.Name") }}</th>
                            <th>{{ __("translate.Category") }}</th>
                            <th>{{ __("translate.Brand") }}</th>
                            @can('Product Cost')
                            <th>{{ __("translate.Cost") }}</th>
                            @endcan
                            @can('Product Price')
                            <th>{{ __("translate.Price") }} </th>
                            @endcan
                            <th>{{ __("translate.Stock") }} </th>
                            <th>{{ __("translate.tax") }} (%)</th>
                            <th>{{ __("translate.warrenty") }} </th>
                            @if( auth()->user()->can('Product Delete') || auth()->user()->can('Product Edit') ||
                         auth()->user()->can('Product View') || auth()->user()->can('Product Print')  )
                            <th>{{ __("translate.Action") }}</th>
                            @endcan
                        </tr>
                    </thead>
                    <tfoot class="bg-abasas-dark">
                        <tr> 
                            <th>{{ __("translate.Id") }}</th>
                            <th>{{ __("translate.Name") }}</th>
                            <th>{{ __("translate.Category") }}</th>
                            <th>{{ __("translate.Brand") }}</th>
                            @can('Product Cost')
                            <th>{{ __("translate.Cost") }}</th>
                            @endcan
                            @can('Product Price')
                            <th>{{ __("translate.Price") }} </th>
                            @endcan
                            <th>{{ __("translate.Stock") }} </th>
                            <th>{{ __("translate.tax") }} (%)</th>
                            <th>{{ __("translate.warrenty") }} </th>
                            @if( auth()->user()->can('Product Delete') || auth()->user()->can('Product Edit') ||
                         auth()->user()->can('Product View') || auth()->user()->can('Product Print')  )
                            <th>{{ __("translate.Action") }}</th>
                            @endcan
                        </tr>

                    </tfoot>
                     <tbody>
                     <?php $id = 1 ?>
                     @foreach ($categories as $category)
                          
                        @foreach ($category->products as $product)
                        <?php $id = $product->id; ?>
                        <tr class="data-row">
                            <td class="iteration">{{$id}}</td>
                            <td id="viewName">{{$product->name}}</td>
                            <td id="viewSell">{{$product->category->name}}</td>
                            <td id="viewProductTypeId">{{$product->brand->name}}</td>
                            @can('Product Cost')
                            <td id="viewCost">{{$product->cost_per_unit * $product->unit->value}}</td>
                            @endcan
                            @can('Product Price')
                            <td id="viewPrice"> {{$product->price_per_unit * $product->unit->value}} 
                                 @if ($product->is_fixed_price == 1)
                                    (Fixed)
                                @else 
                                 (Not Fixed)
                                @endif  </td>
                            @endcan
                            <td id="viewStock">{{$product->stock / $product->unit->value}}</td>
                            <td id="viewTax">{{$product->tax}} ({{ $product->taxType->name }})</td>
                            <td id="viewWarrenty">{{$product->warrenty->name}}</td>



                            @if( auth()->user()->can('Product Delete') || auth()->user()->can('Product Edit') ||
                         auth()->user()->can('Product View') || auth()->user()->can('Product Print')  )
                            <td class="align-middle"> 
                                @can('Product Edit')
                                <a href="{{ route('products.edit',$product->id) }}"> <button type="button" title="Edit Product" class="btn btn-success btn-sm" id="edit-product-button" product-item-id={{$id}} value={{$id}}> <i class="fa fa-edit" aria-hidden="false"> </i></button></a>
                                @endcan
                                @can('Product Delete')
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
                                @endcan
                                @can('Product Print')
                                <button type="button" class="btn btn-info btn-sm" title="Print Barcode" id="barcode-print-button" product-item-id={{$id}} value={{$id}} data-toggle="modal" data-target="#barcode-print-modal"> <i class="fa fa-print" aria-hidden="false"> </i></button>
                                @endcan
                                @can('Product View')
                                <a href="{{ route('products.show',$id) }}"><button type="button" class="btn btn-primary btn-sm" title="View product" id="product-view-button" > <i class="fa fa-eye" aria-hidden="false"> </i></button></a>
                                @endcan

                            </td>
                            @endcan 

                        </tr>
                        @endforeach 
                        @endforeach

                    </tbody>
                </table>



            </div>
        </div>
        @endcan
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