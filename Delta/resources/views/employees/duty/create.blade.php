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
            <nav class="navbar navbar-dark ">
                <a class="navbar-brand">{{ __('translate.Add Duty') }} @can('Super Admin') <i class="fas fa-tools pl-2" id="pageSetting" data-toggle="modal" data-target="#setting-modal"></i> @endcan </a>

            </nav>
        </div>
      
        <div class="card-body">


{{--
            <form method="POST" id="product-create-form" action="{{ route('employee_duties.store') }}">
                @csrf

                <div class="row">
                    <div class="form-group col-md-4 col-sm-12  p-2">
                        <label for="catagory_id">{{ __('translate.Select Employee Name') }}</label>
                        <select class="form-control form-control" value="" name="employee_id" id="employeeId" required>
                            <option value="" selected disabled> Select an Employee</option>
                            @foreach ($employees as $employee)
                            <option value="{{$employee->id}}"> {{$employee->name}}</option>

                            @endforeach
                        </select>
                    </div>



                    <div class="form-group col-md-4 col-sm-12  p-2">
                        <label for="date">{{ __('translate.Date') }}</label>


                        <input type="date" name="date" id="date" class="form-control" min='0' placeholder="date" required>

                    </div>

                    <div class="form-group col-md-4 col-sm-12  p-2">
                        <label for="catagory_id">{{ __('translate.Select Duty Status') }}</label>
                        <select class="form-control form-control" name="duty_status_id" id="dutyStatusId" required>
                            @foreach ($dutyStatuses as $dutyStatus)
                            @if($loop->first)
                            <option value="{{$dutyStatus->id}}" selected="selected"> {{$dutyStatus->name}}</option>
                            @else
                            <option value="{{$dutyStatus->id}}"> {{$dutyStatus->name}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>



                    <div class="form-group col-md-4 col-sm-12  p-2" id="divEnterTime">

                        <label for="enter_time">{{ __('translate.Enter Time') }}</label>


                        <input type="datetime-local" name="enter_time" id="enterTime" class="form-control" min='0' placeholder="Enter Time">

                    </div>

                    <div class="form-group col-md-4 col-sm-12  p-2" id="divExitTime">
                        <label for="exit_time">{{ __('translate.Exit Time') }}</label>


                        <input type="datetime-local" name="exit_time" id="exitTime" class="form-control" min='0' placeholder="Exit Time">

                    </div>

                    <div class="form-group col-md-4 col-sm-12  p-2">
                        <label for="comment">{{ __('translate.Comment') }}</label>


                        <input type="text" name="comment" id="comment" class="form-control" min='0' placeholder="comment">

                    </div>









                </div>
                <button type="submit" id="inputDutyButton" class="btn bg-abasas-dark">{{ __('translate.Submit') }} </button>

            </form>

--}}


            <div class="card-header py-3 bg-abasas-dark">
                <nav class="navbar  ">

                    <div class="navbar-brand">{{ __('translate.Employee Duty (Today)') }} </div>



                </nav>
            </div>




            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="dataTableDuty" width="100%" cellspacing="0">
                    <thead class="bg-abasas-dark">
                        <tr>
                            <th>{{ __('translate.Id') }}</th>
                            <th> {{ __('translate.Name') }}</th>
                       {{--    <th> {{ __('translate.Enter Time') }}</th> --}} 
                       {{--    <th> {{ __('translate.Exit Time') }}</th> --}} 
                            <th> {{ __('translate.Duty Status') }}</th>
                            <th> {{ __('translate.Daily Salary') }}</th>
                            <th> {{ __('translate.Extra') }}( TK )</th>
                            <th> {{ __('translate.Action') }}</th>
                        </tr>
                    </thead>
                    <tfoot class="bg-abasas-dark">
                        <tr>
                            <th>{{ __('translate.Id') }}</th>
                            <th> {{ __('translate.Name') }}</th>
                       {{--    <th> {{ __('translate.Enter Time') }}</th> --}} 
                       {{--    <th> {{ __('translate.Exit Time') }}</th> --}} 
                            <th> {{ __('translate.Duty Status') }}</th>
                            <th> {{ __('translate.Daily Salary') }}</th>
                            <th> {{ __('translate.Extra') }}( TK )</th>
                            <th> {{ __('translate.Action') }}</th>

                        </tr>
                    </tfoot>

                    <tbody>
                        @php
                        $i=1;
                        @endphp
                        @foreach($todayEmployeeDuties as $todayEmployeeDuty)
                        <tr>
                            <form action="{{route('employee_duties.update',$todayEmployeeDuty->id)}}">
                                <td scope="col">{{$todayEmployeeDuty->employee->id}}</td>
                                <td scope="col">{{$todayEmployeeDuty->employee->name}}</td>
                                {{--    <td scope="col">{{ $todayEmployeeDuty->enter_time }}</td> --}} 
                                {{--     <td scope="col">{{ $todayEmployeeDuty->exit_time }}</td>--}} 

                                <td scope="col">
                                    <div class="form-group col-md-12 col-sm-12  p-2">

                                        <select class="form-control form-control" value="{{$todayEmployeeDuty->duty_status_id}}" name="duty_status_id" id="dutyStatusId{{$todayEmployeeDuty->id}}" required>
                                            @foreach ($dutyStatuses as $dutyStatus)
                                            @if($todayEmployeeDuty->duty_status_id == $dutyStatus->id)
                                            <option value="{{$dutyStatus->id}}" selected="selected"> {{$dutyStatus->name}}</option>
                                            @else
                                            <option value="{{$dutyStatus->id}}"> {{$dutyStatus->name}}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </td>
                                <td>
                                {{ $todayEmployeeDuty->daily_salary }}
                                </td>
                                <td> 
                                        
                                     <input type="text"   class="form-control" id="daily_salary_extra{{$todayEmployeeDuty->id}}"    value="{{ $todayEmployeeDuty->daily_salary_extra }}" >
                                     
                                </td>

                                <td scope="col"><button type="button" onclick="updateDutyData({{$todayEmployeeDuty->id}},'{{$todayEmployeeDuty->date}}','{{$todayEmployeeDuty->employee->id}}')" class="btn btn-success"> {{ __('translate.Update') }} </button></td>



                        </tr>
                        </form>
                        @endforeach

                    </tbody>
                </table>



            </div>

        </div> 
         
    </div>




</div>

 



@can('Super Admin')

<!-- Attachment Modal -->
<div class="modal fade" id="setting-modal" tabindex="-1" role="dialog" aria-labelledby="setting-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-abasas-dark">

                <nav class="navbar navbar-light  ">
                    <a class="navbar-brand">{{__('translate.Permission')}}</a>

                </nav>

                <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>

            </div>
            <form action="{{ route('rolepermissionstore') }}" method="post">
                @csrf
                <input type="text" name="page_name" value="Duty Create" required hidden>
                <div class="modal-body">



                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" width="100%" cellspacing="0">
                            <thead class="bg-abasas-dark">

                                <tr>

                                    <th>{{ __('translate.Permission') }} </th>

                                    @for ($i=1 ; $i<5 ; $i++) <th>{{ $roles[$i]->name }}</th>
                                        @endfor
                                </tr>
                            </thead>


                            <tbody>


                                @php
                                $permision_name = "Duty Create Page";
                                @endphp

                                <tr class="data-row">
                                    <td class="iteration">{{ __('translate.Page Access') }}</td>
                                    @for ($i=1 ; $i<5 ; $i++) <td class="word-break name justify-content-center">
                                        <label class="checkbox-inline"><input type="checkbox" name="page{{ $i }}" @if($roles[$i]->hasPermissionTo($permision_name)) checked
                                            @endif></label>
                                        </td>
                                        @endfor

                                </tr>

                            </tbody>



                        </table>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn bg-abasas-dark btn-block form-control  ">{{ __('translate.Save')  }}</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endcan



<script>
    $(document).ready(function() {

      
        $('#dataTableDuty').DataTable({
            dom: 'lBfrtip',
            buttons: [
                'csv', 'excel', 'pdf', 'print'
            ]
        });
        $('#dutyStatusId').on('input', function() {
            if ($(this).val() == 1) {
                $('#divEnterTime').show();
                $('#divExitTime').show();
            } else {
                $('#divEnterTime').hide();
                $('#divExitTime').hide();
            }
        });

    });


   function updateDutyData(id,date,employee_id){
//  alert(date);
    var duty_status_id = $('#dutyStatusId'+id).val().trim();
    var daily_salary_extra = $('#daily_salary_extra'+id).val().trim();
 
   
    var action="{{route('employee_duties.index')}}"+"/"+id;
    var token= "{{csrf_token()}}";
    // alert(action);
 
$.ajax({
            type: 'post',
            url: action,
            data:{
                "_token":token,
                "_method":"PUT",
                "duty_status_id":duty_status_id,
                "daily_salary_extra":daily_salary_extra,
                "date" :date,
                "employee_id" : employee_id
                
                
            },
            success: function (data) {
                
                $('#pageloader').hide();
                 location.reload(true);
                // console.log('data');
                console.log(data);

                // viewSupplierData(supplier);
            },
            error: function (data) {
                
                $('#pageloader').hide();
                alert("Failed order ..... Try Again !!!!!!!!!!!")
                console.log('An error occurred.');
                console.log(data);
            },
        });


}
 

</script>


@endsection