

$(document).ready(function () {



    var purchaseTableData = {};


    function calIndivitualDiscount() {
        var discountType = $("#purchaseProductInputDiscountType").val().trim();
        var price = $("#purchaseProductInputPrice").val().trim();
        var quantity = $("#purchaseProductInputQuantity").val().trim();
        var discountValue = $("#purchaseProductInputdiscount").val().trim();
        if (discountType == 1) {
            discountValue = (price * quantity * discountValue * 0.01);
            $("#purchaseProductInputDiscountValue").val(discountValue);
            return discountValue;
        }

        else {
            $("#purchaseProductInputDiscountValue").val(discountValue);
            return discountValue;
        }
    }

    function calIndivitualTotal() {

        var price = $("#purchaseProductInputPrice").val().trim();
        var discount = calIndivitualDiscount();
        var quantity = $("#purchaseProductInputQuantity").val().trim();
        var total = (price * quantity) - discount;
        $("#purchaseProductInputTotal").val(total);
        if (total < 0)
            return 0;
        else
            return 1;


    }
    function setIndivitualInputFieldDefault() {

        $("#purchaseProductInputSubmit").attr("disabled", true);

        $("#purchaseProductInputId").val('');
        $("#purchaseProductInputName").val('');
        $("#purchaseProductInputPrice").val(0);
        $("#purchaseProductInputdiscount").val(0);
        $("#purchaseProductInputQuantity").val(1);
        $("#purchaseProductInputTotal").val(0);
    }





    $("#purchaseProductError").hide();
    $("#purchaseProductInputId").on('keyup', function () {

        $("#purchaseProductInputSubmit").attr("disabled", true);

        var product_id = $("#purchaseProductInputId").val().trim();

        var link = $("#homeRoute").val().trim() + "/api/get-product-by-id?id=" + product_id;

        $.get(link, function (product) {
            if (product == 0) {

                $("#purchaseProductError").show();
                setIndivitualInputFieldDefault();

                $("#purchaseProductInputSubmit").attr("disabled", true);
            }
            else {
                $("#purchaseProductError").hide();

                $("#purchaseProductInputName").val(product.name);
                $("#purchaseProductInputPrice").val(product.price_per_unit);
                $("#purchaseProductInputdiscount").val(0);
                $("#purchaseProductInputQuantity").val(1);
                $("#purchaseProductInputTotal").val(product.price_per_unit);

                $("#purchaseProductInputSubmit").attr("disabled", false);

            }

        });

    });





    $("#purchaseProductInputPrice").on('keyup', function () {

        data = calIndivitualTotal();
        if (data == 0) {
            $(this).val(0);
        }
        data = calIndivitualTotal();
    });
    $("#purchaseProductInputdiscount").on('keyup', function () {

        data = calIndivitualTotal();
        if (data == 0) {
            $(this).val(0);
        }
        data = calIndivitualTotal();
    });

    $("#purchaseProductInputQuantity").on('keyup', function () {

        data = calIndivitualTotal();
        if (data == 0) {
            $(this).val(1);
        }
        data = calIndivitualTotal();
    });




    $("#purchaseProductInputPrice").on('change', function () {

        calIndivitualTotal();
    });
    $("#purchaseProductInputdiscount").on('change', function () {

        calIndivitualTotal();
    });
    $("#purchaseProductInputQuantity").on('change', function () {

        calIndivitualTotal();
    });



    //                          indivisual submit button click area start 


    function printPurchaseTableData() {
        console.log('your current array is ');
        console.log(purchaseTableData);

        var html = '';
        $("#purchaseProductTableTbody").html(html);
        html = '';

        var i = 0;
        totalCost = 0;
        var productDiscountValue = 0;
        var productPurchaseTotal = 0;
        jQuery.each(purchaseTableData, function (row) {

            html += '<tr>'
            html += '<td>' + ++i + '</td>'
            html += '<td>' + purchaseTableData[row].id + '</td>'
            html += '<td>' + purchaseTableData[row].name + '</td>'
            html += '<td>' + purchaseTableData[row].price + '</td>'
            html += '<td>' + purchaseTableData[row].quantity + '</td>'
            html += '<td>' + purchaseTableData[row].discountValue + '</td>'
            html += '<td>' + purchaseTableData[row].total + '</td>'
            html += '<td>'

            html += '<button type="button" productId=' + purchaseTableData[row].id + ' id="purchaseProductTableEdit" class="btn btn-success"> <i class="fa fa-edit" aria-hidden="false"> </i></button>'
            html += ' <button type="button" id="purchaseProductTableDelete" productId=' + purchaseTableData[row].id + '  class="btn btn-danger" > <i class="fa fa-trash" aria-hidden="false"> </i></button>'


            html += '</td> </tr>';

            productDiscountValue += purchaseTableData[row].discountValue;
            productPurchaseTotal += purchaseTableData[row].total;

            $("#ProductDiscountTotal").text(productDiscountValue);
            $("#productPurchaseTotal").val(productPurchaseTotal);
     
        });
        $("#purchaseProductTableTbody").html(html);
        calculatePurchaseFinal();
    }



    function initializePurchaseTableData(id) {
        purchaseTableData[id] = {
            id: id,
            name: 'name',
            price: 0,
            quantity: 0,
            discountType: 0,
            discount: 0,
            discountValue: 0,
            total: 0,
        };
    }



    function AddNewProductOnPruchaseCart() {
        var id = parseInt($("#purchaseProductInputId").val().trim());
        var name = $("#purchaseProductInputName").val().trim();
        var price = $("#purchaseProductInputPrice").val().trim();
        var quantity = parseInt($("#purchaseProductInputQuantity").val().trim());
        var discountType = $("#purchaseProductInputDiscountType").val().trim();
        var discount = $("#purchaseProductInputdiscount").val().trim();
        var discountValue = $("#purchaseProductInputDiscountValue").val().trim();
        var total = $("#purchaseProductInputTotal").val().trim();





        if (typeof purchaseTableData[id] == 'undefined') {
            // console.log(id+ '   This index is not define yet ')
            initializePurchaseTableData(id)

        }

        purchaseTableData[id] = {
            id: id,
            name: name,
            price: price,
            quantity: parseInt(purchaseTableData[id].quantity) + parseInt(quantity),
            discountType: discountType,
            discount: discount,
            discountValue: parseInt(purchaseTableData[id].discountValue) + parseInt(discountValue),
            total: parseInt(purchaseTableData[id].total) + parseInt(total),
        };



        printPurchaseTableData();
        setIndivitualInputFieldDefault();
        $("#purchaseProductInputId").focus();
    }

    function updateProductOnPruchaseCart() {




        var id = parseInt($("#purchaseProductInputId").val().trim());
        var name = $("#purchaseProductInputName").val().trim();
        var price = $("#purchaseProductInputPrice").val().trim();
        var quantity = parseInt($("#purchaseProductInputQuantity").val().trim());
        var discountType = $("#purchaseProductInputDiscountType").val().trim();
        var discount = $("#purchaseProductInputdiscount").val().trim();
        var discountValue = $("#purchaseProductInputDiscountValue").val().trim();
        var total = $("#purchaseProductInputTotal").val().trim();






        purchaseTableData[id] = {
            id: id,
            name: name,
            price: price,
            quantity: parseInt(quantity),
            discountType: discountType,
            discount: discount,
            discountValue: parseInt(discountValue),
            total: parseInt(total),
        };



        printPurchaseTableData();
        setIndivitualInputFieldDefault();
        $("#purchaseProductInputId").focus();

    };


    $("#purchaseProductInputSubmit").on("click", function () {

        var submitButtonType = $("#purchaseProductInputSubmit").data("submit-type");
        var submitButtonProductId = $("#purchaseProductInputSubmit").data("item-id");
        var id = parseInt($("#purchaseProductInputId").val().trim());
        if (submitButtonType == 'update') {
            console.log("submitButtonType == 'update'");
            if (submitButtonProductId == id) {
                console.log('update method Called');
                updateProductOnPruchaseCart();
            }
            else {
                console.log('create method Called');
                AddNewProductOnPruchaseCart();
            }
        }
        else {
            console.log('create method Called');
            AddNewProductOnPruchaseCart();
        }


        $("#purchaseProductInputSubmit").data("submit-type", 'create');
        $("#purchaseProductInputSubmit").data("item-id", 0);

    });



    $("body").on("click", "#purchaseProductTableDelete", function () {
        var prooductId = $(this).attr('productId');
        console.log("Clicked On " + prooductId);
        delete purchaseTableData[prooductId];
        printPurchaseTableData();
    });


    $("body").on("click", "#purchaseProductTableEdit", function () {
        var prooductId = $(this).attr('productId');
        console.log("Clicked On update button " + prooductId);
        $("#purchaseProductInputSubmit").data("submit-type", 'update');
        $("#purchaseProductInputSubmit").data("item-id", prooductId);
        $("#purchaseProductInputSubmit").attr("disabled", false);


        var product = purchaseTableData[prooductId];

        $("#purchaseProductInputId").val(product.id);
        $("#purchaseProductInputName").val(product.name);
        $("#purchaseProductInputPrice").val(product.price);
        $("#purchaseProductInputdiscount").val(product.discount);
        $("#purchaseProductInputDiscountType").val(product.discountType);
        $("#purchaseProductInputDiscountValue").val(product.discountValue);
        $("#purchaseProductInputQuantity").val(product.quantity);
        $("#purchaseProductInputTotal").val(product.total);

        purchasePagePercentageInitialization(product.discountType);
        $("#purchaseProductError").hide();
        $("#purchaseProductInputSubmit").attr("disabled", false);

    });



// Final caculation start 
function calMoreDiscount() {
    var discountType = $("#productPurchaseMoreDiscountType").val().trim();
    var productPurchaseTotal = parseFloat ($("#productPurchaseTotal").val().trim() );
    var ProductDiscountTotal = parseFloat ($("#ProductDiscountTotal").text().trim() );
    var moreDiscountInput =  parseFloat ($("#moreDiscountInput").val().trim() );

    if (discountType == 1) {
       var  moreDiscountValue = (productPurchaseTotal *  moreDiscountInput * 0.01);
       var totalDiscount = moreDiscountValue + ProductDiscountTotal;
        $("#discountTotal").val( totalDiscount);
        $("#totalDiscountInText").text( parseInt(moreDiscountValue) +" + "+  parseInt(ProductDiscountTotal) )
        return totalDiscount;
    }

    else {
        var totalDiscount = moreDiscountInput + ProductDiscountTotal;

        $("#discountTotal").val( totalDiscount);
        $("#totalDiscountInText").text( parseInt(ProductDiscountTotal) +" + "+  parseInt(moreDiscountInput) )
        return totalDiscount;
    }
}
function calSubTotal(){

    var ProductDiscountTotal = parseFloat ($("#ProductDiscountTotal").text().trim() );
    var productPurchaseTotal = parseFloat ($("#productPurchaseTotal").val().trim() );
    var discountTotal = parseFloat($("#discountTotal").val());
    var subTotal = parseInt(productPurchaseTotal-discountTotal+ProductDiscountTotal);
    $("#purchaseSubtotal").text(subTotal);
    return subTotal;
}

    function calculatePurchaseFinal() {
        calMoreDiscount();
        calSubTotal();

    }
    $("#moreDiscountInput").on('keyup',function(){
 
        calculatePurchaseFinal();
        
        var subtotal = parseInt(calSubTotal());
        console.log('SubTotal '+subtotal);
        if(subtotal < 0 ){
            $(this).val(0);
            
        calculatePurchaseFinal();
        }
    });
    $("#moreDiscountInput").on('change',function(){
        calculatePurchaseFinal();
        
        var subtotal = parseInt(calSubTotal());
        console.log('SubTotal '+subtotal);
        if(subtotal <0 ){
            $(this).val(0);
            
        calculatePurchaseFinal();
        }
    
    });




    // discount Area Start Here 


    // product discount start
    $("#disCountSetting").on('click', function () {

        $("#discountModal").modal();
    });

    function purchasePagePercentageInitialization(percentageType) {


        if (percentageType == 1) {
            $("#percentageIcon").show();
            $("#purchaseModalDiscountTypePercentage").attr('checked', true);
        }
        else {
            $("#percentageIcon").hide();
            $("#purchaseModalDiscountTypeFixed").attr('checked', true);
        }
        
        $("#purchaseProductInputDiscountType").val(percentageType);
    }
    purchasePagePercentageInitialization(1);


    $(".purchasePagePercentageSelect").on('click', function () {


        var data = $(this).val().trim();
        $("#purchaseProductInputDiscountType").val(data);
        if (data == 1) {
            $("#percentageIcon").show();
        }
        else {
            $("#percentageIcon").hide();
        }
        calIndivitualTotal();

    });


    // more discount  start

    $("#purchasePageMoreDiscountSetting").on('click', function () {

        $("#moreDiscountModal").modal();
    });

        function purchasePageMorePercentageInitialization(percentageType) {


        if (percentageType == 1) {
            $("#moreDiscountPercentageIcon").show();
            $("#purchaseMoreModalDiscountTypePercentage").attr('checked', true);
        }
        else {
            $("#moreDiscountPercentageIcon").hide();
            $("#purchaseMoreModalDiscountTypeFixed").attr('checked', true);
        }
        $("#productPurchaseMoreDiscountType").val(percentageType);
    }
    purchasePageMorePercentageInitialization(1);


    $(".purchasePageMoreDiscountSelect").on('click', function () {

console.log('more discount Call')
        var data = $(this).val().trim();
        $("#productPurchaseMoreDiscountType").val(data);
        if (data == 1) {
            $("#moreDiscountPercentageIcon").show();
        }
        else {
            $("#moreDiscountPercentageIcon").hide();
        }

        calculatePurchaseFinal();

    });


// discount Area End 



});