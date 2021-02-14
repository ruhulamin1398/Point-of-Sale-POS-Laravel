@extends('includes.app')


@php
 $dataArray['items'] = $dataArray['items']->sortByDesc('id');
 $settings= $dataArray['settings'];
 $fieldList=$settings->setting[0]['fieldList'];
 $routes=$settings->setting[0]['routes'];
 $componentDetails=$settings->setting[0]['componentDetails'];
 $items= $dataArray['items'];
 $page_name = $dataArray['page_name'];
 $GLOBALS['CurrentUser']= auth()->user();  


@endphp
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
<div class="container-fluid p-0">


    <div class="row ">

        <!-- main body start -->
        <div class="col-xl-12 col-lg-12 col-md-12  p-0 ">


            <div class="card mb-4 shadow">


                <div class="card-header py-3 bg-abasas-dark text-light">
                    <nav class="navbar navbar-light">
                        <a class="navbar-brand">{{ __('translate.Brand Details') }}</a>

                    </nav>
                </div>
                <div class="card-body">
                    
                    <div class="row">
                        <div class="col-12 col-md-6">

                            <h1> {{ __("translate.Name") }} : {{$brand->name}}</h1>
                            <b> {{ __("translate.Description") }} : {{$brand->description}} </b><br>

                            @can('Brand Graph')

                            <div class="p-0 pt-4">
                                <h5 class="text-left"> {{ __('translate.Analysis Results') }}:</h5>
                                <table class="table table-striped table-bordered" id="SingleProductChartTable" width="100%"
                                    cellspacing="0">
                                    <tbody>
                                        <tr class="data-row">
                                            <th>{{ __('translate.Purchase') }}</th>
                                            <td> {{ $dataArrayPie['datasets'][0]['data'][0] }} </td>
                                        </tr>
                                        <tr class="data-row">
                                            <th>{{ __('translate.Sell') }}</th>
                                            <td> {{ $dataArrayPie['datasets'][0]['data'][1] }} </td>
                                        </tr>
                                        <tr class="data-row">
                                            <th>{{ __('translate.Profit') }}</th>
                                            <td>{{ $dataArrayPie['datasets'][0]['data'][4] }} </td>
                                        </tr>
            
                                        <tr class="data-row">
                                            <th> {{ __('translate.Return') }}</th>
                                            <td>{{ $dataArrayPie['datasets'][0]['data'][2] }} </td>
                                        </tr>
                                        <tr class="data-row">
                                            <th> {{ __('translate.Drop') }}</th>
                                            <td> {{ $dataArrayPie['datasets'][0]['data'][3] }} </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                           
                        
                            @endcan
                        </div>
                        @can('Brand Graph')
                        <div class="col-12 col-md-6">
                            <x-pie-chart :dataArray="$dataArrayPie" id="productAnalysispie" />
                        </div>
                        @endcan
                    </div>
                </div>


            </div>



    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 bg-abasas-dark">
            <nav class="navbar navbar-dark ">
                
                
                <span>
                    {{ __("translate.Product List") }}   </span>
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

                            @foreach( $fieldList as $field)
                            @if($field['name'] ==  'price'   )
                                @if($field['read']==1 &&  $GLOBALS['CurrentUser']->can('Product Price'))
                                <th> {{ __('translate.'.$field['title'])  }}</th>
                                @endif
                            @elseif($field['name'] ==  'cost' )
                                @if($field['read']==1 && $GLOBALS['CurrentUser']->can('Product Cost')  )
                                <th> {{ __('translate.'.$field['title'])  }}</th>
                                @endif
                            @else 
                                @if($field['read']==1)
                                <th> {{ __('translate.'.$field['title'])  }}</th>
                                @endif

                            @endif
                            @endforeach
        
                            @if( $GLOBALS['CurrentUser']->can('Product Delete') || $GLOBALS['CurrentUser']->can('Product Edit') ||
                         $GLOBALS['CurrentUser']->can('Product View') || $GLOBALS['CurrentUser']->can('Product Print')  )
                            <th>{{ __("translate.Action") }}</th>
                            @endcan
                        </tr>
                    </thead>
                    <tfoot class="bg-abasas-dark">
                        <tr> 
                            
                            @foreach( $fieldList as $field)
                            
                            @if($field['name'] ==  'price'  )
                                @if($field['read']==1  && $GLOBALS['CurrentUser']->can('Product Price'))
                                <th> {{ __('translate.'.$field['title'])  }}</th>
                                @endif
                            @elseif($field['name'] ==  'cost'   )
                                @if($field['read']==1 && $GLOBALS['CurrentUser']->can('Product Cost'))
                                <th> {{ __('translate.'.$field['title'])  }}</th>
                                @endif
                            @else 
                                @if($field['read']==1)
                                <th> {{ __('translate.'.$field['title'])  }}</th>
                                @endif

                            @endif


                            @endforeach




                            @if( $GLOBALS['CurrentUser']->can('Product Delete') || $GLOBALS['CurrentUser']->can('Product Edit') ||
                         $GLOBALS['CurrentUser']->can('Product View') || $GLOBALS['CurrentUser']->can('Product Print')  )
                            <th>{{ __("translate.Action") }}</th>
                            @endcan
                        </tr>

                    </tfoot>
                      <tbody>

                        @foreach ($items as $item)
                        
                        @php
                        $item->abasas();
                        $itemId = $item->id;
                        @endphp

                        <tr class="data-row">
                            
                         @foreach( $fieldList as $field)


                         @if ( $field['name'] ==  'price'  )
                            @if($field['read']==1 && $GLOBALS['CurrentUser']->can('Product Price') )
                                @php
                                $name= $field['name'];
                                @endphp
                                <td class="  word-break  {{$field['database_name']}} "> {{ $item->$name}}</td>
                            @endif

                         @elseif( $field['name'] ==  'cost'  )
                            @if($field['read']==1  && $GLOBALS['CurrentUser']->can('Product Cost'))
                                @php
                                $name= $field['name'];
                                @endphp
                                <td class="  word-break  {{$field['database_name']}} "> {{ $item->$name}}</td>
                            @endif

                         @else 
                            @if($field['read']==1)
                                @php
                                $name= $field['name'];
                                @endphp
                                <td class="  word-break  {{$field['database_name']}} "> {{ $item->$name}}</td>
                            @endif
                             
                         @endif

                        

                         @endforeach


 
                            @if( $GLOBALS['CurrentUser']->can('Product Delete') || $GLOBALS['CurrentUser']->can('Product Edit') ||
                         $GLOBALS['CurrentUser']->can('Product View') || $GLOBALS['CurrentUser']->can('Product Print')  )
                            <td class="align-middle"> 
                                @can('Product Edit')
                                <a href="{{ route('products.edit',$itemId) }}"> <button type="button" title="Edit Product" class="btn btn-success btn-sm" id="edit-product-button" product-item-id={{$itemId}} value={{$itemId}}> <i class="fa fa-edit" aria-hidden="false"> </i></button></a>
                                @endcan
                                @can('Product Delete')
                                <form method="POST" action="{{ route('products.destroy',  $itemId )}} " id="delete-form-{{ $itemId }}" style="display:none; ">
                                    {{csrf_field() }}
                                    {{ method_field("delete") }}
                                </form>
                               




                                <button title="Delete Product" class="btn btn-danger  btn-sm" onclick="if(confirm('are you sure to delete this')){
				document.getElementById('delete-form-{{ $itemId }}').submit();
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
                                <button type="button" class="btn btn-info btn-sm" title="Print Barcode" id="barcode-print-button" product-item-id={{$itemId}} value={{$itemId}} data-toggle="modal" data-target="#barcode-print-modal"> <i class="fa fa-print" aria-hidden="false"> </i></button>
                                @endcan
                                @can('Product View')
                                <a href="{{ route('products.show',$itemId) }}"><button type="button" class="btn btn-primary btn-sm" title="View product" id="product-view-button" > <i class="fa fa-eye" aria-hidden="false"> </i></button></a>
                                @endcan

                            </td>
                            @endif  

                        </tr>
                        @endforeach 

                    </tbody> 
                </table>



            </div>
        </div>
        @endcan
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
                                            <span class="text-dark pl-2"> {{ __('trranslate.Product Id') }}</span>
                                            <input type="number" name="product_id" id="barcodeProductInputId"
                                                class="form-control mb-2" required readonly>
                                        </div>

                                        <div class="col-auto">

                                            <span class="text-dark pl-2">{{ __('trranslate.Quantity') }} </span>
                                            <input type="number" name="quantity" class="form-control mb-2" required>
                                        </div>

                                        <div class="col-auto" id="checkBoxDiv">
                                        </div>


                                        <div class="col-auto">
                                            <button type="submit" class="btn btn-primary mt-3">{{ __('trranslate.Submit') }} </button>
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
               'csv', 'excel' , 'pdf' , 'print'
            ]
        });

        $(document).on('click','#barcode-print-button',function(){
          
           var id = $(this).attr('product-item-id'); 
           $('#barcodeProductInputId').val(id);
           var html = '';
           var allProducts = @json($items);
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
