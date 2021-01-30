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
<div class="container-fluid">
    <div class="card mb-4 shadow">


        <div class="card-header py-3 bg-abasas-dark">
            <nav class="navbar navbar-dark ">
                <a class="navbar-brand">{{ __('translate.Add Duty') }} @can('Super Admin') <i class="fas fa-tools pl-2"
                    id="pageSetting" data-toggle="modal" data-target="#setting-modal"></i> @endcan </a>

            </nav>
        </div>
        <div class="card-body">



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


                        <input type="date" name="date" id="date" class="form-control" min='0' placeholder="date"
                            required>

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


                        <input type="datetime-local" name="enter_time" id="enterTime" class="form-control" min='0'
                            placeholder="Enter Time">

                    </div>

                    <div class="form-group col-md-4 col-sm-12  p-2" id="divExitTime">
                        <label for="exit_time">{{ __('translate.Exit Time') }}</label>


                        <input type="datetime-local" name="exit_time" id="exitTime" class="form-control" min='0'
                            placeholder="Exit Time">

                    </div>

                    <div class="form-group col-md-4 col-sm-12  p-2">
                        <label for="comment">{{ __('translate.Comment') }}</label>


                        <input type="text" name="comment" id="comment" class="form-control" min='0'
                            placeholder="comment">

                    </div>









                </div>
                <button type="submit" id="inputDutyButton" class="btn bg-abasas-dark">{{ __('translate.Submit') }} </button>

            </form>




    <div class="card-header py-3 bg-abasas-dark">
        <nav class="navbar  ">

            <div class="navbar-brand">{{ __('translate.Employee Duty (Today)') }}  </div>



        </nav>
    </div>




    <div class="table-responsive">
        <table class="table table-striped table-bordered" id="dataTableDuty" width="100%" cellspacing="0">
            <thead class="bg-abasas-dark">
                <tr>
                    <th>#</th>
                    <th> {{ __('translate.Name') }}</th>
                    <th> {{ __('translate.Duty Status') }}</th>
                    <th> {{ __('translate.Enter Time') }}</th>
                    <th> {{ __('translate.Exit Time') }}</th>
                    {{-- <th> Action</th> --}}
                </tr>
            </thead>
            <tfoot class="bg-abasas-dark">
                <tr>
                    <th>#</th>
                    <th> {{ __('translate.Name') }}</th>
                    <th> {{ __('translate.Duty Status') }}</th>
                    <th> {{ __('translate.Enter Time') }}</th>
                    <th> {{ __('translate.Exit Time') }}</th>
                    {{-- <th> Action</th> --}}
                </tr>
            </tfoot>

            <tbody>
                @php
                $i=1;
                @endphp
                @foreach($todayEmployeeDuties as $todayEmployeeDuty)
                <tr>
                    <td scope="col">{{$i++}}</td>
                    <td scope="col">{{$todayEmployeeDuty->employee->name}}</td>
                    <td scope="col">{{$todayEmployeeDuty->dutyStatus->name}}</td>
                    <td scope="col">{{ $todayEmployeeDuty->enter_time }}</td>
                    <td scope="col">{{ $todayEmployeeDuty->exit_time }}</td>
                    {{-- <td scope="col"><button type="button" editId={{$todayEmployeeDuty->id }} id="dutyEdit"
                    class="btn btn-success"> <i class="fa   fa-edit" aria-hidden="false"> </i></button></td> --}}



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
                <input type="text" name="page_name" value="Duty Create" required hidden>
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
                            $permision_name = "Duty Create Page";
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
    $(document).ready(function () {

        $('body').on('click', '#dutyEdit', function () {
            var id = $('#dutyEdit').attr('editId');
            $tr = $(this).closest('tr');
            var data = $tr.children('td').map(function () {
                return $(this).text();
            });
            console.log(data);
        });
        $('#dataTableDuty').DataTable({   
                    dom: 'lBfrtip',
                    buttons: [
                        'copy', 'csv', 'excel' , 'pdf' , 'print'
                    ]
                });
        $('#dutyStatusId').on('input', function () {
            if ($(this).val() == 1) {
                $('#divEnterTime').show();
                $('#divExitTime').show();
            } else {
                $('#divEnterTime').hide();
                $('#divExitTime').hide();
            }
        });

    });

</script>


@endsection
