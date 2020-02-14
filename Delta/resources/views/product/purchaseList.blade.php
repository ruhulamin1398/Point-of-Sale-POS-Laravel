@extends('layout.app')
@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Purchase List</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="dataTable1" width="100%" cellspacing="0">
                    <thead class="thead-dark">


                        <tr>
                            <th>#</th>
                            <th>Purchase Id</th>
                            <th>Supplier</th>
                            <th>Total</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Purchase Id</th>
                            <th>Supplier</th>
                            <th>Total</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>

                    </tfoot>
                    <tbody>

                        <?php $i = 1; ?>
                        @foreach ($purchases as $purchase )
                      
                        <tr class="data-row">
                            <td >{{$i++}}</td>
                            <td >{{$purchase->id}}</td>
                            <td >{{$purchase->supplier->name}}</td>
                            <td >{{$purchase->total}}</td>

                            
                            <td >{{ $purchase->created_at->format('M d Y')}}</td>


                            <td class="align-middle">
                               <a href=" {{ route('purchases-receipt-show', ['id' => $purchase->id] ) }}"> <button type="button" class="btn btn-success" id="edit-item" > <i class="fa fa-eye" aria-hidden="false"> </i></button></a> 




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