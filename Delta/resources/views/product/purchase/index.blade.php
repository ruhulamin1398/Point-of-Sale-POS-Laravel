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



<!-- Begin Page Content -->
<div class="container-fluid p-0">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">

        <div class="card-header py-3  bg-abasas-dark ">
            <nav class="navbar navbar-dark">
                <a class="navbar-brand text-light">{{ __("translate.Purchase List") }}  ( {{ $month }} ) @can('Super Admin') <i class="fas fa-tools pl-2"
                    id="pageSetting" data-toggle="modal" data-target="#setting-modal"></i> @endcan  </a>

                <div>
                    <form method="get">
                        <div class="form-row align-items-center">
                            <div class="col-auto"> {{ __("translate.Select A Month") }}</div>
                            <div class="col-auto"> <input type="month" name="month" class="form-control mb-2"
                                    id="inlineFormInput" required>
                            </div>
                            <div class="col-auto"> <button type="submit" class="btn btn-primary mt-3">{{ __("translate.Submit") }}</button>
                            </div>
                        </div>
                    </form>
                </div>

            </nav>
        </div>
        
        @can('Purchase Read')
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="purchaseTable" width="100%" cellspacing="0">
                    <thead class="bg-abasas-dark">


                        <tr>
                            <th>#</th>
                            @foreach( $fieldList as $field)
                            @if($field['name'] ==  'total'   )
                                @if($field['read']==1 &&  $GLOBALS['CurrentUser']->can('Purchase Price'))
                                <th> {{ __('translate.'.$field['title'])  }}</th>
                                @endif
                            @else 
                                @if($field['read']==1)
                                <th> {{ __('translate.'.$field['title'])  }}</th>
                                @endif

                            @endif
                            @endforeach
                            @can('Purchase View')
                            <th> {{ __("translate.Action") }}</th>
                            @endcan
                        </tr>
                    </thead>
                    <tfoot class="bg-abasas-dark">
                        <tr>
                            <th>#</th>
                            @foreach( $fieldList as $field)
                            @if($field['name'] ==  'total'   )
                                @if($field['read']==1 &&  $GLOBALS['CurrentUser']->can('Purchase Price'))
                                <th> {{ __('translate.'.$field['title'])  }}</th>
                                @endif
                            @else 
                                @if($field['read']==1)
                                <th> {{ __('translate.'.$field['title'])  }}</th>
                                @endif

                            @endif
                            @endforeach
                            @can('Purchase View')
                            <th> {{ __("translate.Action") }}</th>
                            @endcan
                        </tr>

                    </tfoot>
                    @php
                           $itr= 1;
                    @endphp
                    <tbody>


                            

                        @foreach ($items as $item)
                        
                        @php
                        $item->abasas();
                        $itemId = $item->id;
                     
                        @endphp

                        <tr class="data-row">
                            <td class=" word-break "> {{ $itr++ }}</td>
                         @foreach( $fieldList as $field)


                         @if ( $field['name'] ==  'total'  )
                            @if($field['read']==1 && $GLOBALS['CurrentUser']->can('Purchase Price') )
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
                             @can('Purchase View')
                            <td class="align-middle"> 
                                
                                <a href=""><button type="button" class="btn btn-primary btn-sm" title="View Order" id="order-view-button" > <i class="fa fa-eye" aria-hidden="false"> </i></button></a>
                                

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
                        <input type="text" name="page_name" value="Purchase" required hidden>
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
                                    $permision_name = "Purchase Page";
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
                                    $permision_name = "Purchase Read";
        
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
                                    $permision_name = "Purchase View";
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
                                    $permision_name = "Purchase Price";
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
    $(document).ready(function () {

        $('#purchaseTable').DataTable({
            dom: 'lBfrtip',
            buttons: [
                 'csv', 'excel', 'pdf', 'print'
            ]
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
