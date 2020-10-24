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
                        <a class="navbar-brand">Supplier Details</a>

                    </nav>
                </div>
                <div class="card-body">

                    <h1> Name : {{$supplier->name}}</h1>
                    <b> Phone : {{$supplier->phone}}</b><br>
                    <b> Company : {{$supplier->company}}</b><br>

                </div>


            </div>






            <div class="card shadow mb-4">
                <div class="card-header py-3 bg-abasas-dark text-light">
                    <nav class="navbar navbar-light">
                      <a class="navbar-brand"> Product Supply List ( {{ $month }} ) </a>    {{--  {{ $month }} --}}
                        <div>
                            <form method="get">
                                <div class="form-row align-items-center">
                                    <div class="col-auto">
                                        Select A Month
                                    </div>
                                    <div class="col-auto">
                                        <input type="month" name="month" class="form-control mb-2" id="inlineFormInput"
                                            required>
                                    </div>
                                    <div class="col-auto">
                                        <button type="submit" class="btn btn-primary mt-3">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </nav>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="dataTablePurchase" width="100%" cellspacing="0">
                            <thead class="bg-abasas-dark">


                                <tr>
                                    <th>#</th>
                                    <th>Purchase ID</th>
                                    <th>Reference</th>
                                    <th>Total</th>
                                    <th>Discount</th>
                                    <th>Paid Amount</th>
                                    <th>Due</th>
                                    <th>Time</th>
                                    <th> Action</th>
                                </tr>
                            </thead>
                            <tfoot class="bg-abasas-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Purchase ID</th>
                                    <th>Reference</th>
                                    <th>Total</th>
                                    <th>Discount</th>
                                    <th>Paid Amount</th>
                                    <th>Due</th>
                                    <th>Time</th>
                                    <th> Action</th>
                                </tr>

                            </tfoot>
                            <tbody>

                                <?php $i = 1; ?>
                                @foreach ($purchases as $purchase )

                                <tr class="data-row">
                                    <td>{{$i++}}</td>
                                    <td>{{$purchase->id}}</td>
                                    <td>{{$purchase->user->employee->name }}</td>
                                    <td>{{$purchase->total}}</td>
                                    <td>{{$purchase->discount}}</td>
                                    <td>{{$purchase->paid_amount}}</td>
                                    <td>{{$purchase->due}}</td>


                                    <td>{{ $purchase->created_at->format('M-d-Y h:m:a')}}</td>


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
        $('#dataTablePurchase').DataTable({   
                    dom: 'lBfrtip',
                    buttons: [
                        'copy', 'csv', 'excel' , 'pdf' , 'print'
                    ]
                });
    });
</script>



@endsection
