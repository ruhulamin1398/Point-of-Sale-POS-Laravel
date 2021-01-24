@extends('includes.app')
@section('content')


<!-- Content Row -->
<div class="container-fluid ">

    <div class="row ">

        <!-- main body start -->
        <div class="col-xl-8 col-lg-8 col-md-8   ">


            <div class="card mb-4 shadow">

                <div class="card-header py-3 bg-abasas-dark">
                    <nav class="navbar ">
                        Product Return
                    </nav>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('return-to-suppliers.store') }}">
                        @csrf
                        <div class="form-row align-items-center">


                            <div class="col-12 " style="position: relative;">
                                <span class="text-dark  pl-2 ">{{ __("translate.Search") }} </span>
                                <input type="text" name="product_id" id="returnProductInputId"
                                    class="form-control form-control-lg  mb-4 p-4 inputMinZero rounded-1 border-info"
                                    autocomplete="off" placeholder="Search by id or name or you can barcode" autofocus
                                    required>
                                <div id="productSuggession" class="list-group"
                                    style="position: absolute;   left:20px; z-index:9999; max-height: 200px;overflow:scroll; ">
                                </div>
                            </div>

                            <div class="col-12 col-md-6 p-2">
                                <span class="text-dark ">{{ __("translate.Product Name") }} </span>
                                <input type="text" name="name" id="returnProductName"
                                    class="form-control  " readonly required>
                            </div>
                            <div class="col-12 col-md-6 ">

                                <span class="text-dark "> {{ __("translate.Quantity") }}</span>
                                <input type="number" step="any" name="quantity" id="returnProductQuantity"
                                   class="form-control    inputMinZero"  required>
                            </div>
                            <div class="col-12 col-md-6 ">

                                <span class="text-dark "> {{ __("translate.Total Price") }} </span>
                                <input type="number" step="any" name="price" id="returnProductPrice" min="0" required
                                    class="form-control ">
                            </div>
                            <div class="col-12 col-md-6  ">

                                <span class="text-dark "> {{ __("translate.Comment") }} </span>
                                <input type="text" name="comment" id="returnProductComment" 
                                    class="form-control ">
                            </div>


                            <input type="text" name="return_product_supplier_id" id="return_product_supplier_id" 
                                    class="form-control " hidden>

                            <div class="col-12 col-md-6  pt-4 ">
                                <button type="submit" id="returnProductSubmit"
                                    class="btn bg-abasas-dark">{{ __('translate.Submit')  }}</button>
                            </div>

                        </div>

                    </form>
                </div>
            </div>










        </div>

        <!-- Left Sidebar Start -->
        <div class="col-xl-4 col-lg-4 col-md-4   ">

            <x-supplier-phone />

        </div>
        <!-- supplier area End  -->

        


    </div>
    



    <div class="card shadow mb-4">
        <div class="card-header py-3 bg-abasas-dark">
            <nav class="navbar navbar-light ">
                <a class="navbar-brand">Todays Returned Products</a>

            </nav>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="dataTable1" width="100%" cellspacing="0">
                    <thead class="bg-abasas-dark">


                        <tr>
                            <th>#</th>
                            <th>Reference</th>
                            <th>Supplier</th>
                            <th>Product Id</th>
                            <th>Product Id</th>
                            <th>Quantity </th>
                            <th>Total Price</th>
                            <th>Comment</th>
                        </tr>
                    </thead>
                    <tfoot class="bg-abasas-dark">
                        <tr>

                        <tr>
                            <th>#</th>
                            <th>Reference</th>
                            <th>Supplier</th>
                            <th>Product Id</th>
                            <th>Product Name</th>
                            <th>Quantity </th>
                            <th>Total Price</th>
                            <th>Comment</th>
                        </tr>
                        </tr>

                    </tfoot>
                    <tbody>
                        <?php $id = 1 ?>
                        @foreach ($returnProducsts as $returnProducst)

                        <tr class="data-row">
                            <td>{{$id++}}</td>
                        <td>{{$returnProducst->user->name}}</td>
                        <td>{{$returnProducst->supplier->name}}</td>
                        <td>{{$returnProducst->product_id}}</td>
                        <td>{{$returnProducst->products->name}}</td>
                        <td>{{$returnProducst->quantity / $returnProducst->products->unit->value}}</td>
                        <td>{{$returnProducst->price}}</td>

                        <td>{{$returnProducst->comment}}</td>
                        </tr>
                        @endforeach 
                    </tbody>
                </table>



            </div>
        </div>
    </div>

</div>


<!-- Content Row -->




<script>
$(document).ready(function(){

$(document).on('click','#returnProductSubmit',function(){
    
    var supplier_id = $('#supplier_input_id').val();
    $('#return_product_supplier_id').val(supplier_id);
})

$('#dataTable1').DataTable({   
    dom: 'lBfrtip',
    buttons: [
        'copy', 'csv', 'excel' , 'pdf' , 'print'
    ]
});





    //                               *****************************************************************************
    //                                           ##########  Search product suggession    #############
    //                               *******************************************************************************


    var databaseProducts  ;
    $(function () {
        var link = $("#homeRoute").val().trim() + "/api/all-products";
        console.log(link);
        $.get(link, function (data) {
            databaseProducts = data;
        });
    })
    $("#productSuggession").hide();


    $("#returnProductInputId").on('keyup', function () {
        $("#productSuggession").show();

        var searchField = $("#returnProductInputId").val();
        var expression = new RegExp(searchField, "i");
        if (searchField.length == 0) {
            $("#productSuggession").hide();
            return false;
        }
        $("#productSuggession").html("");

        var count = 0;
        $.each(databaseProducts, function (key, value) {


            if (value.name.search(expression) != -1 || value.id == searchField) {
                if (count == 50) {
                    return false;
                }
                count++;
                $('#productSuggession').append(
                    '<a herf="#" class="list-group-item list-group-item-action border-1 searchItem text-dark" data-item-id="' +
                    value.id + '">' + +value.id + ' | ' + value.name + ' | ' + value
                    .price_per_unit + ' </a>')
            }

        });
        if (count == 0) {
            $('#productSuggession').html(
                '<div class="list-group-item list-group-item-action border-1 text-dark"> Not found any Data </div>'
            )
        }



    });


$('body').click(function () {
        $("#productSuggession").hide();
        $("#productSuggession").html("");
    });

    $(document).on('click', '.searchItem', function () {
        var id = $(this).attr('data-item-id');
        $("#returnProductInputId").val(id);
        $("#returnProductName").val(databaseProducts[id].name);

        // alert(id);//this one needs to be triggered
        //purchaseProductInputOnInput()
        $("#productSuggession").hide();
        $("#productSuggession").html("");
    });



    $("#returnProductInputId").on('input', function () {
        var product_id = parseInt($(this).val().trim());
        console.log(databaseProducts);
        var product = databaseProducts[product_id];
        if (typeof product == 'undefined') {
            $('#returnProductName').val('');
        } else {
            $('#returnProductName').val(product.name);
        }
        // if($('#returnProductName').val().length==0 || parseFloat($('#returnProductName').val().trim()) <=0)
        //     alert('hi');
     });
     



});








</script>



@endsection
