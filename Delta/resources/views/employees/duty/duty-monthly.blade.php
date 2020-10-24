@extends('includes.app')


@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card mb-4 shadow">


        <div class="card-header py-3 bg-abasas-dark">

            <nav class="navbar navbar-dark">
                <a class="navbar-brand text-light"> Monthly Duties</a>
                <div>
                   
                
                <form method="get">
                        
                        <div class="form-row align-items-center">
                       


                            <div class="col-auto">
                        
                            Select A Month
                            </div>
                            <div class="col-auto">
                                <input type="month" name="month"  class="form-control mb-2" id="monthFormInput" required>
                            </div>
                      


                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary mt-3"  >Submit</button>
                            </div>


                        </div>

                    </form>








                </div>
            </nav>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="dataTableDutyMonthly" width="100%" cellspacing="0">
                    <thead class="bg-abasas-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Employee Name</th>
                            <th scope="col">Month </th>
                            <th scope="col"> Present</th>
                            <th scope="col"> Absent</th>


                        </tr>
                    </thead>
                    <tfoot class="bg-abasas-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Employee Name</th>
                            <th scope="col">Month</th>
                            <th scope="col"> Present</th>
                            <th scope="col"> Absent</th>


                        </tr>
                    </tfoot>

                    <tbody>
                        @php
                        $i=1;
                        @endphp
                        @foreach($monthlyDuties as $monthlyDuty)
                        <tr>
                            <th scope="row">{{$i++}}</th>
                            <th scope="row">{{$monthlyDuty->employee->name}}</th>
                            <th scope="row">{{$monthlyDuty->month}}</th>
                            <th scope="row">{{$monthlyDuty->present}}</th>
                            <th scope="row">{{$monthlyDuty->absent}}</th>


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

$('#dataTableDutyMonthly').DataTable({   
                    dom: 'lBfrtip',
                    buttons: [
                        'copy', 'csv', 'excel' , 'pdf' , 'print'
                    ]
                });


});

</script>

@endsection