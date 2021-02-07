
@extends('includes.app')

@php
$allitems= $dataArray['items'];
 $dataArray['items'] = $dataArray['items']->sortByDesc('id');
 $settings= $dataArray['settings'];
 $settings2 = $dataArray['categorySettings'];;
 $category_settings= $settings2->setting; 
 $fieldList=$settings->setting[0]['fieldList'];
 $routes=$settings->setting[0]['routes'];
 $componentDetails=$settings->setting[0]['componentDetails'];
 $items= $dataArray['items'];
 $page_name = $dataArray['page_name'];
 $GLOBALS['CurrentUser']= auth()->user();  
 $role_id = $GLOBALS['CurrentUser']->roles[0]['id'];
 $allRole = array(" ", "Super Admin", "Admin" , "Manager" , "Analyser" , "Staff");
 $role_name = $allRole[$role_id];


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

                        @foreach ($items as $temp_items)
                        @if( !isset($category_settings[$temp_items->id][$role_name]) || $category_settings[$temp_items->id][$role_name]== 1)

                        @foreach ($temp_items->products as $item )
                        
                        
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
                        @endif 
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
            <div class="modal-header bg-abasas-dark">

                <h5 class="modal-title " id="setting-modal-label "> {{ __('translate.Categorized Products')  }}
                </h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="text-light"
                        aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="attachment-body-content">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered"  width="100%"
                        cellspacing="0">
                        <thead class="bg-abasas-dark">

                            <tr>

                                <th>{{ __('translate.Category') }} </th>

                                @for ($i=1 ; $i<5 ; $i++) <th>{{ $roles[$i]->name }}</th>
                                    @endfor
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            @foreach ($allitems as $item)

                            @if (isset($category_settings[$item->id]))
                                
                           
                            <tr class="data-row" categoryId="{{ $item->id }}">
                                <td class="word-break"  >{{ $item->name }}</td>
                                <td class="word-break ">
                                    <div class="form-check ">
                                      <input type="checkbox" class="form-check-input admin"   @if($category_settings[$item->id]['Admin']== 1) checked @endif >
                                    </div>
                                 </td>
                                <td class="word-break">
                                    <div class="form-check ">
                                      <input type="checkbox" class="form-check-input manager"  @if($category_settings[$item->id]['Manager']== 1) checked @endif >
                                    </div>
                                 </td>
                                <td class="word-break">
                                    <div class="form-check ">
                                      <input type="checkbox" class="form-check-input analyser"  @if($category_settings[$item->id]['Analyser']== 1) checked @endif>
                                    </div>
                                 </td>
                                <td class="word-break">
                                    <div class="form-check ">
                                      <input type="checkbox" class="form-check-input staff"   @if($category_settings[$item->id]['Staff']== 1) checked @endif>
                                    </div>
                                 </td>
                            </tr>
                            @else 
                            <tr class="data-row"  categoryId="{{ $item->id }}">
                                <td class="word-break" >{{ $item->name }}  </td>
                                <td class="word-break ">
                                    <div class="form-check ">
                                      <input type="checkbox" class="form-check-input admin"   checked>
                                    </div>
                                 </td>
                                <td class="word-break">
                                    <div class="form-check ">
                                      <input type="checkbox" class="form-check-input manager"   checked >
                                    </div>
                                 </td>
                                <td class="word-break">
                                    <div class="form-check ">
                                      <input type="checkbox" class="form-check-input analyser"   checked >
                                    </div>
                                 </td>
                                <td class="word-break">
                                    <div class="form-check ">
                                      <input type="checkbox" class="form-check-input staff"   checked >
                                    </div>
                                 </td>
                            </tr>

                            @endif
                            @endforeach


                        </tbody>


                    </table>

                </div>


            </div>
            
            <div class="modal-footer">
                <div class="btn bg-abasas-dark btn-block " id="settingsSaveButton"> {{ __('translate.Save')  }}
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






        $(document).on('click','#settingsSaveButton',function(){


            var SettingArray = {
             "_token": $("#csrfToken").val().trim()

            };
            $("#tableBody").children().each(function (index) {
                var id =  $(this).attr('categoryId').trim();
                var Admin = $(this).find('.admin').is(":checked") ? 1 : 0;
                var Manager = $(this).find('.manager').is(":checked") ? 1 : 0;
                var Analyser = $(this).find('.analyser').is(":checked") ? 1 : 0;
                var Staff = $(this).find('.staff').is(":checked") ? 1 : 0;



                SettingArray[id] = {

                    Admin: Admin,
                    Manager: Manager,
                    Analyser: Analyser,
                    Staff: Staff

                };

             });
             
             saveSettings(SettingArray) ;



        });
        
     function saveSettings(SettingArray) {
         var url = $("#homeRoute").val().trim() + "/settings/" + "{{ $settings2->id }}";
         // console.log(url);
         $.ajax({
             url: url,
             data: SettingArray,
             type: 'put',
             success: function (data) {
                 location.reload(true);
                 console.log(data);
             },
             error: function (data) {
                 alert('Failed');
             }
         });
     }



        
    })
</script>


 
@endsection