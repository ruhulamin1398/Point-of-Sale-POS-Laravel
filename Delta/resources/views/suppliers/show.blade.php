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


<!-- Content Row -->
<div class="container-fluid p-0">

    <div class="row ">

        <!-- main body start -->
        <div class="col-xl-12 col-lg-12 col-md-12   ">


            <div class="card mb-4 shadow">


                <div class="card-header py-3 bg-abasas-dark text-light">
                    <nav class="navbar navbar-light">
                        <a class="navbar-brand">{{ __("translate.Supplier Details") }}</a>

                    </nav>
                </div>
                <div class="card-body">

                    <h1> {{ __("translate.Name") }} : {{$supplier->name}}</h1>
                    <b> {{ __("translate.Phone") }} : {{$supplier->phone}}</b><br>
                    <b> {{ __("translate.Company") }} : {{$supplier->company}}</b><br>

                </div>


            </div>






            @can('Purchase Read')
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="supplierTable" width="100%" cellspacing="0">
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



</div>

<script>
    $(document).ready(function(){
        $('#supplierTable').DataTable({   
                    dom: 'lBfrtip',
                    buttons: [
                        'copy', 'csv', 'excel' , 'pdf' , 'print'
                    ]
                });
    });
</script>



@endsection
