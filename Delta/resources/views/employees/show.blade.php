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
                        <a class="navbar-brand">{{ __("translate.Employee Details") }}</a>

                    </nav>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <h1> {{ __("translate.Name") }} : {{$employee->name}}</h1>
                            <b> {{ __("translate.Phone") }} : {{$employee->phone}}</b><br>
                            <b> {{ __("translate.Designation") }} : {{$employee->designation->name}}</b><br>
                            <b> {{ __("translate.Address") }} : {{$employee->address}}</b><br>
                        </div>
                        @can('Employee Graph')
                        <div class="col-12 col-md-6">
                            <x-pie-chart :dataArray="$employeeGraph" id="employeeGraph" />
                            
                        </div>
                        @endcan
                    </div>

                </div>


            </div>






            <div class="card shadow mb-4">
                <div class="card-header py-3 bg-abasas-dark text-light">
                    <nav class="navbar navbar-light">
                      <a class="navbar-brand"> {{ __("translate.Employee Sell List") }} ( {{ $month }} ) </a>    {{--  {{ $month }} --}}
                        <div>
                            <form method="get">
                                <div class="form-row align-items-center">
                                    <div class="col-auto">
                                        {{ __("translate.Select A Month") }}
                                    </div>
                                    <div class="col-auto">
                                        <input type="month" name="month" class="form-control mb-2" id="inlineFormInput"
                                            required>
                                    </div>
                                    <div class="col-auto">
                                        <button type="submit" class="btn btn-primary mt-3">{{ __("translate.Submit") }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </nav>
                </div>
                
        @can('Order Read')
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="employeeTable" width="100%" cellspacing="0">
                    <thead class="bg-abasas-dark">


                        <tr>
                            <th>#</th>
                            @foreach( $fieldList as $field)
                            @if($field['name'] ==  'total'   )
                                @if($field['read']==1 &&  $GLOBALS['CurrentUser']->can('Order Price'))
                                <th> {{ __('translate.'.$field['title'])  }}</th>
                                @endif
                            @else 
                                @if($field['read']==1)
                                <th> {{ __('translate.'.$field['title'])  }}</th>
                                @endif

                            @endif
                            @endforeach
                            @can('Order View')
                            <th> {{ __("translate.Action") }}</th>
                            @endcan
                        </tr>
                    </thead>
                    <tfoot class="bg-abasas-dark">
                        <tr>
                            <th>#</th>
                            @foreach( $fieldList as $field)
                            @if($field['name'] ==  'total'   )
                                @if($field['read']==1 &&  $GLOBALS['CurrentUser']->can('Order Price'))
                                <th> {{ __('translate.'.$field['title'])  }}</th>
                                @endif
                            @else 
                                @if($field['read']==1)
                                <th> {{ __('translate.'.$field['title'])  }}</th>
                                @endif

                            @endif
                            @endforeach
                            @can('Order View')
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
                            @if($field['read']==1 && $GLOBALS['CurrentUser']->can('Order Price') )
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
                             @can('Order View')
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



</div>

<script>
    $(document).ready(function(){
        $('#employeeTable').DataTable({   
                    dom: 'lBfrtip',
                    buttons: [
                        'copy', 'csv', 'excel' , 'pdf' , 'print'
                    ]
                });
    });
</script>



@endsection
