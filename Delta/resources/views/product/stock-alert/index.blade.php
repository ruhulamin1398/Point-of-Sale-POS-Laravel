@extends('includes.app')


@php
 $dataArray['items'] = $dataArray['items'];
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
                    {{ __("translate.Low Stock Product List") }}   @can('Super Admin') <i class="fas fa-tools pl-2"
                    id="pageSetting" data-toggle="modal" data-target="#setting-modal"></i> @endcan  </span>
            </nav>
        </div>



        
        @can('Stock Alert Read')
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
        
                            @if( $GLOBALS['CurrentUser']->can('Stock Alert Delete')   )
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




                            @if( $GLOBALS['CurrentUser']->can('Stock Alert Delete')   )
                            <th>{{ __("translate.Action") }}</th>
                            @endif
                        </tr>

                    </tfoot>
                      <tbody>

                        @foreach ($items as $temp_item)
                        
                        @php
                        $item = $temp_item->product;
                        $item->abasas();
                        $itemId = $temp_item->id;
                        @endphp
                        @if($item->stock_alert >= $item->stock)
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

                        @elseif( $field['name'] ==  'schedule'  )
                        <td class="  word-break  {{$field['database_name']}}  "> 
                            <div class="form-check">
                                <input class="form-check-input scheduled-checkbox" type="checkbox" value="" data-item-id={{ $itemId }} data-item-quantity={{ $temp_item->product_count }} @if($temp_item->status == 'scheduled') checked @endif >
                                
                                <span> ( {{ $temp_item->product_count }} )</span>
                               
                              </div>
                        
                        </td>

                         @else 
                            @if($field['read']==1)
                                @php
                                $name= $field['name'];
                                @endphp
                                <td class="  word-break  {{$field['database_name']}} "> {{ $item->$name}}</td>
                            @endif
                             
                         @endif

                        

                         @endforeach


 
                         @if( $GLOBALS['CurrentUser']->can('Stock Alert Delete')   )
                            <td class="align-middle"> 
                                @can('Product Delete')
                                <form method="POST" action="{{ route('stock-alerts.destroy',  $itemId )}} " id="delete-form-{{ $itemId }}" style="display:none; ">
                                    {{csrf_field() }}
                                    {{ method_field("delete") }}
                                </form>
                               




                                <button title="Hide Product" class="btn btn-danger  btn-sm" onclick="if(confirm('are you sure to Hide this')){
				document.getElementById('delete-form-{{ $itemId }}').submit();
			}
			else{
				event.preventDefault();
			}
			" class="btn btn-danger btn-sm btn-raised">
                                    <i class="fas fa-minus-circle"></i>

                                    </i>
                                </button>
                                @endcan

                            </td>
                            @endif  

                        </tr>
                        @endif
                        @endforeach 

                    </tbody> 
                </table>



            </div>
        </div>
        @endcan



    </div>



</div>







 <!-- Attachment Modal -->
 <div class="modal fade" id="data-edit-modal" tabindex="-1" role="dialog" aria-labelledby="edit-modal-label"
     aria-hidden="true">
     <div class="modal-dialog modal-lg" role="document">
         <div class="modal-content">
             <div class="modal-header bg-abasas-dark">
                 <h5 class="modal-title " id="edit-modal-label ">
                     {{ __('translate.'.$componentDetails['editTitle'])}} </h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                         aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body" id="attachment-body-content">
                 <form id="data-edit-form" class="form-horizontal" method="POST" action="">
                     @csrf
                     @method('put')

                        <div class="form-group ">
                            <label class="col-form-label" for="modal-update-quantity">{{__('translate.Quantity')}} </label>
                            <input type="number" step="any" name="product_count" class="form-control" value="0" id="modal-update-quantity" required>
                        </div>
                                                
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="status" name="status" checked>
                            <label class="form-check-label" for="status">Schedule</label>
                        </div>




                        <div class="form-group">

                            <input type="submit" id="submit-button" value=" {{__('translate.Submit')}}"
                                class="form-control btn btn-success">
                        </div>





                     </div>




                 </form>
             </div>

         </div>
     </div>
 </div>
 <!-- /Attachment Modal -->








 

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
                        <input type="text" name="page_name" value="Stock Alert" required hidden>
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
                                    $permision_name = "Stock Alert Page";
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
                                    $permision_name = "Stock Alert Read";
        
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
                                    $permision_name = "Stock Alert Edit";
        
                                    @endphp
        
                                    <tr class="data-row">
                                        <td class="iteration">{{ __('translate.Schedule Access') }} </td>
        
        
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
                                    $permision_name = "Stock Alert Delete";
        
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

        var item ;
        $(document).on('click', ".scheduled-checkbox", function () {


            $(this).addClass(
                'edit-item-trigger-clicked'
            ); 

            var options = {
                'backdrop': 'static'
            };
            $('#data-edit-modal').modal(options)
        });
        
         // on modal hide
         $('#data-edit-modal').on('hide.bs.modal', function () {
             $('.edit-item-trigger-clicked').removeClass('edit-item-trigger-clicked')
             $("#edit-form").trigger("reset");
         });
         

         $('#productTable').DataTable({
             dom: 'lBfrtip',
             buttons: [
                 'csv', 'excel', 'pdf', 'print'
             ]
         });


         
         // on modal show
         $('#data-edit-modal').on('show.bs.modal', function () {

            var el = $(".edit-item-trigger-clicked"); // See how its usefull right here? 
    

            // get the data
            var itemId = el.data('item-id');
            var quantity = el.data('item-quantity');
            $('#modal-update-quantity').val(quantity);
         

            var home = "{{route('home')}}";
            var action = home.trim() + '/stock-alerts/' + itemId;

            $("#data-edit-form").attr('action', action);
            

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





    });


 </script>


@endsection

