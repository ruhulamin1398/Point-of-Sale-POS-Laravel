@extends('includes.app')
@section('content')


<!-- Content Row -->
<div class="container-fluid ">

    <div class="row ">

        <!-- main body start -->
        <div class="col-xl-12 col-lg-12 col-md-12   ">


            <div class="card mb-4 shadow">


                <div class="card-header py-3 bg-abasas-dark text-light">
                    <nav class="navbar navbar-light">
                        <a class="navbar-brand">{{ __('translate.Customer Details') }}</a>

                    </nav>
                </div>
                <div class="card-body">

                    <h1> {{ __('translate.Name') }} : {{$customer->name}}</h1>
                    <b> {{ __('translate.Phone') }} : {{$customer->phone}}</b><br>
                    <b>{{ __('translate.Address') }} : {{$customer->address}}</b><br>

                </div>


            </div>






            <div class="card shadow mb-4">
                <div class="card-header py-3 bg-abasas-dark text-light">
                    <nav class="navbar navbar-light">
                      <a class="navbar-brand"> {{ __('translate.Customer Buy List') }} ( {{ $month }} ) </a>    {{--  {{ $month }} --}}
                        <div>
                            <form method="get">
                                <div class="form-row align-items-center">
                                    <div class="col-auto">
                                        {{ __('translate.Select A Month') }}
                                    </div>
                                    <div class="col-auto">
                                        <input type="month" name="month" class="form-control mb-2" id="inlineFormInput"
                                            required>
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
                        <table class="table table-striped table-bordered" id="dataTableOrder" width="100%" cellspacing="0">
                            <thead class="bg-abasas-dark">


                                <tr>
                                    <th>#</th>
                                    <th>{{ __('translate.Order ID') }}</th>
                                    <th>{{ __('translate.Reference') }}</th>
                                    <th>{{ __('translate.Total') }}</th>
                                    <th>{{ __('translate.Discount') }}</th>
                                    <th>{{ __('translate.Paid Amount') }}</th>
                                    <th>{{ __('translate.Due') }}</th>
                                    <th>{{ __('translate.Time') }}</th>
                                    <th> {{ __('translate.Action') }}</th>
                                </tr>
                            </thead>
                            <tfoot class="bg-abasas-dark">
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('translate.Order ID') }}</th>
                                    <th>{{ __('translate.Reference') }}</th>
                                    <th>{{ __('translate.Total') }}</th>
                                    <th>{{ __('translate.Discount') }}</th>
                                    <th>{{ __('translate.Paid Amount') }}</th>
                                    <th>{{ __('translate.Due') }}</th>
                                    <th>{{ __('translate.Time') }}</th>
                                    <th> {{ __('translate.Action') }}</th>
                                </tr>

                            </tfoot>
                            <tbody>

                                <?php $i = 1; ?>
                                @foreach ($orders as $order )

                                <tr class="data-row">
                                    <td>{{$i++}}</td>
                                    <td>{{$order->id}}</td>
                                    <td>{{$order->user->employee->name }}</td>
                                    <td>{{$order->total}}</td>
                                    <td>{{$order->discount}}</td>
                                    <td>{{$order->paid_amount}}</td>
                                    <td>{{$order->due}}</td>


                                    <td>{{ $order->created_at->format('M-d-Y h:m:a')}}</td>


                                    <td class="align-middle">
                                        <a href="#"> <button type="button" class="btn btn-success" id="edit-item"> <i
                                                    class="fa fa-eye" aria-hidden="false"> </i></button></a>




                                    </td>

                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>




    </div>



</div>

<script>
    $(document).ready(function(){
        $('#dataTableOrder').DataTable({   
                    dom: 'lBfrtip',
                    buttons: [
                        'copy', 'csv', 'excel' , 'pdf' , 'print'
                    ]
                });
    });
</script>



@endsection
