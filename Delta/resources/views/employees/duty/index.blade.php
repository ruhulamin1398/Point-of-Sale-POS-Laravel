@extends('includes.app')


@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card mb-4 shadow">


        <div class="card-header py-3 bg-abasas-dark">

            <nav class="navbar navbar-dark">
                <a class="navbar-brand text-light"> Duty Lists </a>
                <div>
                   
                
                <form method="get">
                        
                        <div class="form-row align-items-center">
                       


                            <div class="col-auto">
                        
                            Select A Week
                            </div>
                            <div class="col-auto">
                                <input type="week" name="week"  class="form-control mb-2" id="inlineFormInput" required>
                            </div>
                      


                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary mt-3"  >সাবমিট</button>
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
                            <th scope="col"> Name</th>
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
                            <th scope="col"> Name</th>
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
                                    <div class="text-xs text-center"> {{ Carbon\Carbon::parse ($duty->first()['enter_time'])->format('H:i')}} - {{ Carbon\Carbon::parse ($duty->first()['exit_time'])->format('H:i')}} </div>

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


<script> 
$(document).ready(function(){

$('#dataTableDuty').DataTable();


});

</script>

@endsection