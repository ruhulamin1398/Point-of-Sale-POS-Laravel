@extends('includes.app')


@section('content')




@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ __('translate.'.$error) }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session()->has('success'))
<div class="alert alert-success">
    @if(is_array(session('success')))
        <ul>
            @foreach (session('success') as $message)
                <li>{{ __('translate.'.$message) }}</li>
            @endforeach
        </ul>
    @else
        {{ session('success') }}
    @endif
</div>
@endif
<!-- Begin Page Content -->
<div class="container-fluid  p-0">
    <div class="card mb-4 shadow">


        <div class="card-header py-3 bg-abasas-dark">

            <nav class="navbar navbar-dark">
                <a class="navbar-brand text-light">{{ __('translate.Weekly Duties') }} @can('Super Admin') <i class="fas fa-tools pl-2"
                    id="pageSetting" data-toggle="modal" data-target="#setting-modal"></i> @endcan
</a>
                <div>
                   
                
                <form method="get">
                        
                        <div class="form-row align-items-center">
                       


                            <div class="col-auto">
                        
                                {{ __('translate.Select A Week') }}
                            </div>
                            <div class="col-auto">
                                <input type="week" name="week"  class="form-control mb-2" id="inlineFormInput" required>
                            </div>
                      


                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary mt-3"  >{{ __('translate.Submit') }}</button>
                            </div>


                        </div>

                    </form>








                </div>
            </nav>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="dataTableDuty" width="100%" cellspacing="0">
                    <thead class="bg-abasas-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col"> {{ __('translate.Name') }}</th>
                            @foreach($weekDaysArray as $day)

                            <th scope="col">
                                <div class="text-sm  text-center "> {{$day}} </div>
                                <div class="text-xs text-center"> {{ Carbon\Carbon::parse ($day)->format('D')}} </div>
                            </th>
                            @endforeach


                        </tr>
                    </thead>
                    <tfoot class="bg-abasas-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col"> {{ __('translate.Name') }}</th>
                            @foreach($weekDaysArray as $day)

                            <th scope="col">
                                <div class="text-sm   text-center "> {{$day}} </div>
                                <div class="text-xs text-center"> {{ Carbon\Carbon::parse ($day)->format('D')}} </div>
                            </th>
                            @endforeach


                        </tr>
                    </tfoot>

                    <tbody>
                        @php
                        $i=1;
                        @endphp
                        @foreach($weeklyEmployeesDutyData as $employeeDuties)
                        <tr>
                            <th scope="row">{{$i++}}</th>
                            <th scope="row">{{$employees[$i-2]->name}}</th>
                            @foreach($employeeDuties as $duty)
                            <td>
                                @php
                                $status = $duty->first()['duty_status_id'];
                                @endphp
                                @if($status != 0 )
                                <div class=" text-center font-weight-bold " title=" Fixed Duty : {{$duty->first()['fixed_duty_hour']}}   @if($status == 1 )|  Worked hour : {{$duty->first()['worked_hour']}} @endif         "> {{$duty->first()['duty_status_name']}}

                                    @if($status == 1 )
                                    <div class="text-xs text-center"> @if( ! is_null( $duty->first()['enter_time'] )) {{ Carbon\Carbon::parse ($duty->first()['enter_time'])->format('H:i')}} @endif -@if( ! is_null( $duty->first()['exit_time'] )) {{ Carbon\Carbon::parse ($duty->first()['exit_time'])->format('H:i')}} @endif </div>

                                    @endif

                                </div>
                                @endif

                            </td>
                            @endforeach


                        </tr>
                        @endforeach

                    </tbody>
                </table>



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
                <input type="text" name="page_name" value="Duty Weekly" required hidden>
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
                            $permision_name = "Duty Weekly Page";
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

$('#dataTableDuty').DataTable({
    dom: 'lBfrtip',
    buttons: [
        'csv', 'excel' , 'pdf' , 'print'
    ]
});


});

</script>

@endsection