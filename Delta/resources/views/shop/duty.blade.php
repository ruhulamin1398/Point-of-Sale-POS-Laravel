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



    <div class="collapse show" id="createNewForm" action="http://127.0.0.1:8000/categories">
        <div class="card mb-4 shadow">

            <div class="card-header py-3  bg-abasas-dark ">
                <nav class="navbar navbar-dark">
                    <a class="navbar-brand text-light"> {{ __('translate.Today') }} ( {{Carbon\Carbon::now()->format('D M Y')}} )</a>
                </nav>
            </div>
            <div class="card-body">
               
 
            <form action="{{route('duties.update', $today->id)}}" method="post">
                @csrf
                @method('PUT')

                <input type="text" name="page_name" value="Duty" required hidden>
                <div class="modal-body row">

                    <input type="text" name="id" id="idEdit" hidden>

                    <div class="form-group col-6  ">
                        <label for="status" class="text-center font-weight-bold"> </label>
                        <select class="form-control" name="status_id" id="statusEditSElect" required>
                            @foreach($statues as $status) 

                           @if($today->status_id == $status->id )
                           
                           <option selected="selected" value="{{$status->id}}"> {{$status->name}}</option>
                           @else
                           
                           <option  value="{{$status->id}}"> {{$status->name}}</option>
                           @endif
                            @endforeach

                        </select>
                    </div>
                    <div class="form-group col-6  ">
                    <button type="submit" class="btn bg-abasas-dark btn-block form-control  ">{{ __('translate.Update')  }}</button>
                    </div>
                </div>

             
            </form>

        
            </div>
        </div>
    </div>



    <div class="card mb-4 shadow">


        <div class="card-header py-3 bg-abasas-dark">

            <nav class="navbar navbar-dark">
                <a class="navbar-brand text-light">{{ __('translate.Duties') }} @can('Super Admin') <i class="fas fa-tools pl-2" id="pageSetting" data-toggle="modal" data-target="#setting-modal"></i> @endcan
                </a>
                <div>


                    <form method="get">

                        <div class="form-row align-items-center">



                            <div class="col-auto">

                                {{ __('translate.Select A Month') }}
                            </div>
                            <div class="col-auto">
                                <input type="month" name="month" value="{{$month->format('Y-m')}}" class="form-control mb-2" id="inlineFormInput" required>
                            </div>



                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary mt-3">{{ __('translate.Submit') }}</button>
                            </div>


                        </div>

                    </form>








                </div>
            </nav>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="dataTableDutyShop" width="100%" cellspacing="0">
                    <thead class="bg-abasas-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col"> {{ __('translate.Date') }}</th>
                            <th scope="col"> {{ __('translate.Status') }}</th>
                            <th scope="col"> {{ __('translate.Action') }}</th>



                        </tr>
                    </thead>
                    <tfoot class="bg-abasas-dark">
                        <tr>

                            <th scope="col">#</th>
                            <th scope="col"> {{ __('translate.Date') }}</th>
                            <th scope="col"> {{ __('translate.Status') }}</th>
                            <th scope="col"> {{ __('translate.Action') }}</th>




                        </tr>
                    </tfoot>

                    <tbody>
                        @php
                        $i=1;
                        @endphp
                        @foreach($dataArray['items'] as $item)
                        <tr>
                            <th scope="row">{{$i++}}</th>

                            @php
                            $day = Carbon\Carbon::createFromFormat('Y-m-d', $item->day);
                            @endphp
                            <th scope="row">{{$day->format(' d-M (D) ')}}</th>
                            <td scope="row">{{$item->status->name}}</td>
                            <td scope="row">
                                <button title="Edit" type="button" class=" btn btn-success btn-sm" onclick="statusEdit({{$item->id}}, {{$item->status_id}}, '{{$item->day}}')">
                               <i class="fa fa-edit" aria-hidden="false"> </i>
                                </button>
                            </td>



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
                <input type="text" name="page_name" value="Duty Weekly" required hidden>
                <div class="modal-body">



                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" width="100%" cellspacing="0">
                            <thead class="bg-abasas-dark">

                                <tr>

                                    <th>{{ __('translate.Permission') }} </th>

                                    @for ($i=1 ; $i<5 ; $i++) <th> {{ $roles[$i]->name }}</th>
                                        @endfor
                                </tr>
                            </thead>


                            <tbody>


                                @php
                                $permision_name = "Duty Weekly Page";
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






<div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="setting-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-abasas-dark">

                <nav class="navbar navbar-light  ">
                    <a class="navbar-brand">{{__('translate.Status')}}</a>

                </nav>

                <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>

            </div>
            <form action=" " id="dutiesUpdateForm" method="post">
                @csrf
                @method('PUT')

                <input type="text" name="page_name" value="Duty" required hidden>
                <div class="modal-body">

                    <input type="text" name="id" id="idEdit" hidden>

                    <div class="form-group col-12  ">
                        <label for="status" class="text-center font-weight-bold"> {{__('translate.Status')}}</label>
                        <select class="form-control" name="status_id" id="statusEditSelect" required>
                            <!-- @foreach($statues as $status)
                            <option selected value="{{$status->id}}"> {{$status->name}}</option>
                            @endforeach -->

                        </select>
                    </div>
                    <div class="form-group col-12  ">
                        <label for="status" class="text-center  text-danger small" > {{__("translate.If you change this all of your employee duty status will be change. i cann't be undone  to cinfirm this,Please enter ")}} ' <span id="todayConfirmDayText"> </span> ' </label>
                      
                        <input type="text" id="editConfirmDate" name="day" class="form-control mb-2"  required>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="submit" id="statusUpdateBtn"class="btn bg-abasas-dark btn-block form-control  ">{{ __('translate.Update')  }}</button>
                </div>
            </form>
        </div>
    </div>
</div>



<script>
$("#statusUpdateBtn").attr('disabled','disabled');
// $("#statusUpdateBtn").hide()

$("#editConfirmDate").keyup(function(){
    var enteredValue= $("#editConfirmDate").val().trim();
    var orginalValue=  $("#todayConfirmDayText").text().trim();
    if(enteredValue == orginalValue){
        console.log(enteredValue + 'same'+ orginalValue )
        $("#statusUpdateBtn").removeAttr('disabled');
    }
    else{
        console.log(enteredValue + 'not same'+ orginalValue )
        $("#statusUpdateBtn").attr('disabled','disabled');
    }
});
    function statusEdit(id, statusId,day) {
  
        var action = "http://127.0.0.1:8000/duties/" + id;
        $("#idEdit").val(statusId);
        $("#dutiesUpdateForm").attr('action', action );

        $("#todayConfirmDayText").text(day);

        var statusList = @json($statues);
        console.log(statusList);

        var html = "";
        $.each(statusList, function(i) {
            console.log(statusList[i].id + " , " + statusId);
            if (statusList[i].id == statusId) {

                html += `   <option selected="selected" value="` + statusList[i].id + `">` + statusList[i].name + `</option>   `;
            } else {

                html += `   <option  value="` + statusList[i].id + `">` + statusList[i].name + `</option>   `;
            }
        });
        
        $("#statusEditSelect").html(html);
        console.log(html)


        $("#edit-modal").modal();
    }

    $(document).ready(function() {




        $('#dataTableDutyShop').DataTable({
            dom: 'lBfrtip',
            buttons: [
                'csv', 'excel', 'pdf', 'print'
            ],
            "pageLength": 40,
            "lengthChange": false,
        });


    });
</script>

@endsection