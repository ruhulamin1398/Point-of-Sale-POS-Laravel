@extends('includes.app')


@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card mb-4 shadow">


        <div class="card-header py-3 bg-abasas-dark">

            <nav class="navbar navbar-dark">
                <a class="navbar-brand text-light"> {{ __('translate.Monthly Duties') }}@can('Super Admin') <i class="fas fa-tools pl-2"
                    id="pageSetting" data-toggle="modal" data-target="#setting-modal"></i> @endcan </a>
                <div>
                   
                
                <form method="get">
                        
                        <div class="form-row align-items-center">
                       


                            <div class="col-auto">
                        
                                {{ __('translate.Select A Month') }} 
                            </div>
                            <div class="col-auto">
                                <input type="month" name="month"  class="form-control mb-2" id="monthFormInput" required>
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
                <table class="table table-striped table-bordered" id="dataTableDutyMonthly" width="100%" cellspacing="0">
                    <thead class="bg-abasas-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">{{ __('translate.Employee Name') }}</th>
                            <th scope="col">{{ __('translate.Month') }} </th>
                            <th scope="col">{{ __('translate.Present') }}</th>
                            <th scope="col">{{ __('translate.Absent') }}</th>


                        </tr>
                    </thead>
                    <tfoot class="bg-abasas-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">{{ __('translate.Employee Name') }}</th>
                            <th scope="col">{{ __('translate.Month') }} </th>
                            <th scope="col">{{ __('translate.Present') }}</th>
                            <th scope="col">{{ __('translate.Absent') }}</th>


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
                <input type="text" name="page_name" value="Duty Monthly" required hidden>
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
                            $permision_name = "Duty Monthly Page";
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