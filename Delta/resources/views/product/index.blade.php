
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
                
                
                <span>
                    {{ __("translate.Product List") }}   @can('Super Admin') <i class="fas fa-tools pl-2"
                    id="pageSetting" data-toggle="modal" data-target="#setting-modal"></i> @endcan  </span>
                    @can('Product Create')
               <a href="{{ route("products.create") }}"> <button class="btn btn-success " id="create-button">{{ __("translate.Add Product") }}</button></a>
               @endcan
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
                        @foreach ($products as $product)
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

                    </tbody>
                </table>



            </div>
        </div>
        @endcan
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






@can('Super Admin')
 <!-- Attachment Modal -->
 <div class="modal fade" id="setting-modal" tabindex="-1" role="dialog" aria-labelledby="setting-modal-label"
     aria-hidden="true">
     <div class="modal-dialog modal-lg" role="document">
         <div class="modal-content">
             <div class="modal-header bg-abasas-dark">

                <nav class="navbar navbar-light  ">
                    <a class="navbar-brand">{{__('translate.Permission')}}</a>
    
                </nav>
                
            <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;</span>
            </button>

             </div>
             <form action="{{ route('rolepermissionstore') }}" method="post">
                @csrf
                <input type="text" name="page_name" value="Product" required hidden>
             <div class="modal-body" >


                
                <div class="table-responsive">
                    <table class="table table-striped table-bordered"  width="100%"
                        cellspacing="0">
                        <thead class="bg-abasas-dark">

                            <tr>

                                <th>{{ __('translate.Permission') }} </th>

                                @for ($i=1 ; $i<5 ; $i++) <th>{{ $roles[$i]->name }}</th>
                                    @endfor
                            </tr>
                        </thead>


                        <tbody>


                            @php
                            $permision_name = "Product Page";
                            @endphp
                            
                            <tr class="data-row">
                                <td class="iteration">{{ __('translate.Page Access') }}</td>
                                @for ($i=1 ; $i<5 ; $i++) <td
                                    class="word-break name justify-content-center">
                                    <label class="checkbox-inline"><input type="checkbox"
                                            name="page{{ $i }}"
                                            @if($roles[$i]->hasPermissionTo($permision_name)) checked
                                        @endif></label>
                                    </td>
                                    @endfor

                            </tr>


                            
                            @php
                            $permision_name = "Product Create";

                            @endphp

                            <tr class="data-row">
                                <td class="iteration">{{ __('translate.Create Access') }} </td>

                                @for ($i=1 ; $i<5 ; $i++) <td
                                    class="word-break name justify-content-center">
                                    <label class="checkbox-inline"><input type="checkbox"
                                            name="create{{ $i }}"
                                            @if($roles[$i]->hasPermissionTo($permision_name)) checked
                                        @endif></label>
                                    </td>
                                    @endfor

                            </tr>
                            @php
                            $permision_name = "Product Read";

                            @endphp

                            <tr class="data-row">
                                <td class="iteration">{{ __('translate.Read Access') }} </td>


                                @for ($i=1 ; $i<5 ; $i++) <td
                                    class="word-break name justify-content-center">
                                    <label class="checkbox-inline"><input type="checkbox"
                                            name="read{{ $i }}"
                                            @if($roles[$i]->hasPermissionTo($permision_name)) checked
                                        @endif></label>
                                    </td>
                                    @endfor

                            </tr>

                            @php
                            $permision_name = "Product Edit";

                            @endphp

                            <tr class="data-row">
                                <td class="iteration">{{ __('translate.Edit Access') }} </td>


                                @for ($i=1 ; $i<5 ; $i++) <td
                                    class="word-break name justify-content-center">
                                    <label class="checkbox-inline"><input type="checkbox"
                                            name="edit{{ $i }}"
                                            @if($roles[$i]->hasPermissionTo($permision_name)) checked
                                        @endif></label>
                                    </td>
                                    @endfor

                            </tr>

                            @php
                            $permision_name = "Product Delete";

                            @endphp

                            <tr class="data-row">
                                <td class="iteration">{{ __('translate.Delete Access') }} </td>


                                @for ($i=1 ; $i<5 ; $i++) <td
                                    class="word-break name justify-content-center">
                                    <label class="checkbox-inline"><input type="checkbox"
                                            name="delete{{ $i }}"
                                            @if($roles[$i]->hasPermissionTo($permision_name)) checked
                                        @endif></label>
                                    </td>
                                    @endfor

                            </tr>


                            @php
                            $permision_name = "Product View";
                            @endphp

                            <tr class="data-row">
                                <td class="iteration">{{ __('translate.view Access') }}</td>
                                @for ($i=1 ; $i<5 ; $i++) <td
                                    class="word-break name justify-content-center">
                                    <label class="checkbox-inline"><input type="checkbox"
                                            name="view{{ $i }}"
                                            @if($roles[$i]->hasPermissionTo($permision_name)) checked
                                        @endif></label>
                                    </td>
                                    @endfor

                            </tr>

                            @php
                            $permision_name = "Product Price";
                            @endphp

                            <tr class="data-row">
                                <td class="iteration">{{ __('translate.Price Access') }}</td>
                                @for ($i=1 ; $i<5 ; $i++) <td
                                    class="word-break name justify-content-center">
                                    <label class="checkbox-inline"><input type="checkbox"
                                            name="price{{ $i }}"
                                            @if($roles[$i]->hasPermissionTo($permision_name)) checked
                                        @endif></label>
                                    </td>
                                    @endfor

                            </tr>
                            

                            @php
                            $permision_name = "Product Cost";
                            @endphp

                            <tr class="data-row">
                                <td class="iteration">{{ __('translate.Cost Access') }}</td>
                                @for ($i=1 ; $i<5 ; $i++) <td
                                    class="word-break name justify-content-center">
                                    <label class="checkbox-inline"><input type="checkbox"
                                            name="cost{{ $i }}"
                                            @if($roles[$i]->hasPermissionTo($permision_name)) checked
                                        @endif></label>
                                    </td>
                                    @endfor

                            </tr>

                            

                            @php
                            $permision_name = "Product Graph";
                            @endphp

                            <tr class="data-row">
                                <td class="iteration">{{ __('translate.Graph Access') }}</td>
                                @for ($i=1 ; $i<5 ; $i++) <td
                                    class="word-break name justify-content-center">
                                    <label class="checkbox-inline"><input type="checkbox"
                                            name="graph{{ $i }}"
                                            @if($roles[$i]->hasPermissionTo($permision_name)) checked
                                        @endif></label>
                                    </td>
                                    @endfor

                            </tr>
                            @php
                            $permision_name = "Product Print";
                            @endphp

                            <tr class="data-row">
                                <td class="iteration">{{ __('translate.Print Access') }}</td>
                                @for ($i=1 ; $i<5 ; $i++) <td
                                    class="word-break name justify-content-center">
                                    <label class="checkbox-inline"><input type="checkbox"
                                            name="print{{ $i }}"
                                            @if($roles[$i]->hasPermissionTo($permision_name)) checked
                                        @endif></label>
                                    </td>
                                    @endfor

                            </tr>

                          





                        </tbody>



                    </table>
                </div>

             </div>

             <div class="modal-footer">
                <button type="submit"
                                 class="btn bg-abasas-dark btn-block form-control  ">{{ __('translate.Save')  }}</button>
            </div>
             </form>
         </div>
     </div>
 </div>
@endcan



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