@extends('layout.app')
@section('content')





<!-- Begin Page Content -->
<div class="container-fluid">




    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <nav class="navbar navbar-light bg-light">
                <a class="navbar-brand">Product list</a>
               
            </nav>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="dataTable1" width="100%" cellspacing="0">
                    <thead class="thead-dark">


                        <tr>
                            <th>Product Id</th>
                            <th>Name</th>
                            <th>Weight</th>
                            <th>Sell</th>
                            <th>Stock</th>
                            <th>Cost</th>
                            <th>Limit</th>
                            <th>Expire</th>
                        </tr>
                    </thead>
                    <tfoot class="thead-dark">
                        <tr>

                            <th>Product Id</th>
                            <th>Name</th>
                            <th>Weight</th>
                            <th>Sell</th>
                            <th>Stock</th>
                            <th>Cost</th>
                            <th>Limit</th>
                            <th>Expire</th>

                        </tr>

                    </tfoot>
                    <tbody>
                        <?php $id = 1 ?>
                        @foreach ($products as $product)
                        <?php $id = $product->id; ?>
                        <tr class="data-row">
                            <td class="iteration">{{$id}}</td>
                            <td id="viewName">{{$product->name}}</td>
                            <td id="viewCategoryId">{{$product->weight}}</td>
                            @if( $product->type ==2)
                            <td id="viewSell">{{$product->price_per_unit}}</td>
                            @else
                            
                            <td id="viewSell">{{$product->sell}}</td>
                            @endif

                            <td id="viewProductTypeId">{{$product->stock}}</td>
                            <td id="viewCost">{{$product->cost}}</td>
                            <td id="viewLowLimit">{{$product->low_limit}}</td>
                            <td id="viewexpiredate">{{$product->expire_date}}</td>





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