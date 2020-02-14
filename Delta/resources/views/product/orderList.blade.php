@extends('layout.app')
@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">order List</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="dataTable1" width="100%" cellspacing="0">
                    <thead class="thead-dark">


                        <tr>
                            <th>#</th>
                            <th>order Id</th>
                            <th>customer</th>
                            <th>Total</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>order Id</th>
                            <th>customer</th>
                            <th>Total</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>

                    </tfoot>
                    <tbody>

                        <?php $i = 1; ?>
                        @foreach ($orders as $order )
                      
                        <tr class="data-row">
                            <td >{{$i++}}</td>
                            <td >{{$order->id}}</td>
                            <td >{{$order->customer->name}}</td>
                            <td >{{$order->total}}</td>

                            
                            <td >{{ $order->created_at->format('M d Y')}}</td>


                            <td class="align-middle">
                               <a href=" {{ route('order-receipt-show', ['id' => $order->id] ) }}"> <button type="button" class="btn btn-success" id="edit-item" > <i class="fa fa-eye" aria-hidden="false"> </i></button></a> 




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
<!-- /Attachment Modal -->



@endsection