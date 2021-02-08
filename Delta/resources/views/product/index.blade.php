
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
                            @endif
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
                            @endif
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






<!-- print code  product -->
<div class="modal fade" id="barcode-print-modal" tabindex="-1" role="dialog" aria-labelledby="edit-product-modal-label"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark" id="edit-product-modal-label ">{{ __('translate.Print Barcode') }} </h5>
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
                                            <span class="text-dark pl-2"> {{ __('translate.Product Id') }}</span>
                                            <input type="number" name="product_id" id="barcodeProductInputId"
                                                class="form-control mb-2" required readonly>
                                        </div>

                                        <div class="col-auto">

                                            <span class="text-dark pl-2">{{ __('translate.Quantity') }} </span>
                                            <input type="number" name="quantity" class="form-control mb-2" required>
                                        </div>

                                        <div class="col-auto m-2" id="checkBoxDiv">
                                        </div>


                                        <div class="col-auto">
                                            <button type="submit" class="btn btn-primary mt-3">{{ __('translate.Submit') }} </button>
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




{{-- new one --}}


@can('Super Admin')
<!-- Attachment Modal -->
<div class="modal fade" id="setting-modal" tabindex="-1" role="dialog" aria-labelledby="setting-modal-label"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header ">


                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active " id="setting-tab" data-toggle="tab" href="#Setting" role="tab"
                            aria-controls="Setting" aria-selected="true"><b>{{__('translate.Setting')}}</b> </a>
                    </li>
                  


                    <li class="nav-item">
                        <a class="nav-link" id="permission-tab" data-toggle="tab" href="#permission" role="tab"
                            aria-controls="permission" aria-selected="false"><b> {{__('translate.Permission')}}</b></a>
                    </li>
                   
                </ul>
                {{-- <h5 class="modal-title " id="setting-modal-label "> {{ __('translate.'.$componentDetails['title'])  }}
                </h5> --}}



                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span>
                </button>
            </div>


            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="Setting" role="tabpanel" aria-labelledby="setting-tab">


                    <div class="modal-body" id="attachment-body-content">




                        <table class="table table-striped">

                            <tbody id="sortable">
                                @for( $i=0 ; $i<count($fieldList) ; $i++) <tr
                                    data-position="{{ $fieldList[$i]['position'] }}"
                                    data-name="{{ $fieldList[$i]['name'] }}">
                                    <th scope="row"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>
                                        {{ __('translate.'. $fieldList[$i]['title'] )  }}</th>
                                    <td>
                                        
                                        <div class="form-check-inline">
                                            <label class="form-check-label readLabel" @if( !$GLOBALS['CurrentUser']->can($page_name.' Read')) hidden @endif>
                                                @if( $fieldList[$i]['read'] == 1 )
                                                <input type="checkbox" class="form-check-input read abasasCheckBox "
                                                    value="1" checked>
                                                @elseif( $fieldList[$i]['read'] == 0 )

                                                <input type="checkbox" class="form-check-input read abasasCheckBox "
                                                    value="0">
                                                @elseif( $fieldList[$i]['read'] == 2 )

                                                <input type="checkbox" class="form-check-input read abasasCheckBox "
                                                    value="2" checked disabled>
                                                @else

                                                <input type="checkbox" class="form-check-input read" disabled
                                                    value="3">
                                                @endif
                                                {{ __('translate.Read')  }}
                                            </label>
                                            
                                        </div>
                                       


                                    </td>

                                    </tr>


                                    @endfor



                            </tbody>
                        </table>


                    </div>

                    <div class="modal-footer">
                        <div class="btn bg-abasas-dark btn-block " id="settingsSaveButton"> {{ __('translate.Save')  }}
                        </div>
                    </div>


                </div>


                <div class="tab-pane fade" id="permission" role="tabpanel" aria-labelledby="permission-tab">
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
    </div>
</div>
<!-- /Attachment Modal -->

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



        $("#sortable").sortable({

            update: function (event, ui) {
                $(this).children().each(function (index) {

                    if ($(this).attr('data-position') != index + 1) {
                        $(this).attr('data-position', index + 1)
                    }
                });

            }
        });



    $("#settingsSaveButton").on('click', function () {
        var positionArray = {
        "_token": $("#csrfToken").val().trim()

        };

        $("#sortable").children().each(function (index) {
            var name = $(this).attr('data-name').trim()
            var position = $(this).attr('data-position').trim();
            var create = 0;
            var read = $(this).find('.read').val().trim();
            var update = 0;



            positionArray[name] = {
                position: position,
                create: create,
                read: read,
                update: update

            };

        // console.log(positionArray);
        });
    saveSettings(positionArray);

    });

    function saveSettings(positionArray) {
        var url = $("#homeRoute").val().trim() + "/settings/" + "{{ $settings->id }}";
        // console.log(url);
        $.ajax({
            url: url,
            data: positionArray,
            type: 'put',
            success: function (data) {
                location.reload(true);
                // console.log(data);
            },
            error: function (data) {
                console.log(data);
            }
        });
    }
        





        
    })
</script>


 
@endsection