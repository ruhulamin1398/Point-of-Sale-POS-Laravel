
@extends('includes.app')


@section('content')



<!-- Begin Page Content -->
<div>
    <div class="card mb-4 shadow">

        <div class="card-header py-3  bg-abasas-dark ">
            <nav class="navbar navbar-dark">
                <a class="navbar-brand text-light"> {{ __('translate.Print Barcode')  }}</a>
            </nav>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('bar-codes.store') }}">
                @csrf
                <div class="form-row align-items-center" id="barcodePrint">
                  
                


                    

                    <div class="col-12 pl-4 pr-4" style="position: relative;">
                        <span class="text-dark  pl-2 "> {{ __('translate.Search')  }}</span>
                        <input type="text" name="product_id" id="barcodeInputId" class="form-control form-control-lg  mb-4 p-4 inputMinZero rounded-1 border-info"
                            autocomplete="off" placeholder="Search by id or name or you can barcode" autofocus required>
                        <div id="productSuggession" class="list-group"   style="position: absolute;   left:20px; z-index:9999; max-height: 200px;overflow:scroll; "> </div>
                    </div>

                    <div class="col-auto p-4">
                        <span class="text-dark  pl-2"> {{ __('translate.Product Name')  }}</span>
                        <input type="text" name="name" id="barcodeName" size="30" value=""
                            class="form-control  mb-2" readonly required>
                    </div>
                    <div class="col-auto p-4">

                        <span class="text-dark pl-1"> {{ __('translate.Quantity')  }}</span>
                        <input type="number" step="any" name="quantity" id="barcodequantity" size="6"  min="1"
                            class="form-control  mb-2  inputMinZero" required>
                    </div>

                    <div class="col-auto p-4">
                        <button type="submit" id="barcodeSubmit" class="btn bg-abasas-dark mt-3" >{{ __('translate.Submit')  }} </button>
                    </div>
                   

                </div>

            </form>
        </div>
    </div>
</div>




<script>
    $(document).ready(function(){

    //                               *****************************************************************************
    //                                           ##########  Search product suggession    #############
    //                               *******************************************************************************


    var databaseProducts;

$(function () {


    var link = $("#homeRoute").val().trim() + "/api/all-products";
    console.log(link);

    $.get(link, function (data) {
        databaseProducts = data;

    });

})

    $("#productSuggession").hide();

$("#barcodeInputId").on('keyup', function () {
    $("#productSuggession").show();

    var searchField = $("#barcodeInputId").val();
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
        $("#barcodeInputId").val(id)
        $("#barcodeName").val(databaseProducts[id].name)
        // alert(id);//this one needs to be triggered
        purchaseProductInputOnInput()
        $("#productSuggession").hide();
        $("#productSuggession").html("");
    });



    $("#barcodeInputId").on('input', function () {
        var product_id = parseInt($(this).val().trim());
        console.log(databaseProducts);
       
        var product = databaseProducts[product_id];
        console.log(product);
        if (typeof product == 'undefined') {
            $('#barcodeName').val('');
        } else {
            $('#barcodeName').val(product.name);
        }
        // if($('#barcodeName').val().length==0 || parseFloat($('#barcodeName').val().trim()) <=0)
        //     alert('hi');
     });
     


    });
</script>




 
@endsection