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
                <a class="navbar-brand">{{ __('translate.Add Duty') }}</a>

            </nav>
        </div>
        <div class="card-body">



            <form method="POST" id="product-create-form" action="{{ route('employee_duties.store') }}">
                @csrf

                <div class="row">
                    <div class="form-group col-md-4 col-sm-12  p-2">
                        <label for="catagory_id">{{ __('translate.Select Employee Nam') }}e</label>
                        <select class="form-control form-control" value="" name="employee_id" id="employeeId" required>
                            @foreach ($employees as $employee)
                            @if($loop->first)
                            <option value="{{$employee->id}}" selected="selected"> {{$employee->name}}</option>
                            @else
                            <option value="{{$employee->id}}"> {{$employee->name}}</option>
                            @endif
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

            <div class="navbar-brand">{{ __('translate.Employee Duty') }} ({{ __('translate.Today') }}) </div>



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
