@extends('includes.app')


@section('content')



<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">

        <div class="card-header py-3  bg-abasas-dark ">
            <nav class="navbar navbar-dark">
                <a class="navbar-brand text-light"> Sell List ( {{ $month }} ) </a>

                <div>
                    <form method="get">
                        <div class="form-row align-items-center">
                            <div class="col-auto"> Select A Month </div>
                            <div class="col-auto"> <input type="month" name="month" class="form-control mb-2"
                                    id="inlineFormInput" required>
                            </div>
                            <div class="col-auto"> <button type="submit" class="btn btn-primary mt-3">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>

            </nav>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="orderTable" width="100%" cellspacing="0">
                    <thead class="bg-abasas-dark">


                        <tr>
                            <th>#</th>
                            <th> Sell No </th>
                            <th>Customer</th>
                            <th>Total</th>
                            <th>Time</th>
                            <th> Action</th>
                        </tr>
                    </thead>
                    <tfoot class="bg-abasas-dark">
                        <tr>
                            <th>#</th>
                            <th> Sell No </th>
                            <th>Customer</th>
                            <th>Total</th>
                            <th>Time</th>
                            <th> Action</th>
                        </tr>

                    </tfoot>
                    <tbody>

                        <?php $i = 1; ?>
                        @foreach ($orders as $order )

                        <tr class="data-row">
                            <td>{{$i++}}</td>
                            <td>{{$order->id}}</td>
                            <td>{{$order->customer->name}}</td>
                            <td>{{$order->total}}</td>


                            <td>{{ $order->created_at->format('d M,Y h:i:a')}}</td>


                            <td class="align-middle"> {{-- {{ route('order-receipt-show', ['id' => $order->id] ) }} --}}
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


<script>
    $(document).ready(function () {

        $('#orderTable').DataTable({
            dom: 'lBfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });

    })

</script>




@endsection
