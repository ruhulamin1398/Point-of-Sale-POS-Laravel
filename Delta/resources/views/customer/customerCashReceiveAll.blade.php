@extends('layout.app')
@section('content')





<!-- Begin Page Content -->
<div class="container-fluid">




    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 bg-dark text-light">
            <nav class="navbar navbar-light">
                <a class="navbar-brand">Customer Cash Receive list</a>
               
            </nav>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="dataTable1" width="100%" cellspacing="0">
                    <thead class="thead-dark">


                        <tr>
                            <th>Payment Id</th>
                            <th>Customer</th>
                            <th>Ref</th>
                           
                            <th>Pre_due</th>
                            <th>Amount</th>
                            
                        </tr>
                    </thead>
                    <tfoot class="thead-dark">
                    <tr>
                            <th>Payment Id</th>
                            <th>Customer</th>
                            <th>Ref</th>
                           
                            <th>Pre_due</th>
                            <th>Amount</th>
                            
                        </tr>

                    </tfoot>
                    <tbody>
                        <?php $id = 1 ?>
                        @foreach ($customerCashReceives as $customerCashReceive)
                        <?php $id = $customerCashReceive->id; ?>
                        <tr class="data-row">
                            <td class="iteration">{{$id}}</td>
                            <td id="">{{$customerCashReceive->customer->name}}</td>
                            <td id="">{{"Foyej Ahmed"}}</td>                           
                            <td id="">{{$customerCashReceive->pre_due}}</td>
                            <td id="viewProductTypeId">{{$customerCashReceive->amount}}</td>





                        </tr>
                        @endforeach

                    </tbody>
                </table>



            </div>
        </div>
    </div>

</div>






</div>
<!-- /Create new product-->





</div>
<!-- /edit  product-->




@endsection