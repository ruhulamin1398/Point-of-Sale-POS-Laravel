$(document).ready(function () {

    console.log("page is ready");

    var user_id;
    var supplier_id;
    var supplier_previous_due=0;
    var due ;
    var purchaseTableData = {};
    var productDiscount = 0;
    var totalPaurchase = 0;
    var purchaseId= 0;
    // supplier Area Start 


    $('#purchasePageAddSupplierForm').hide();
    $("#purchasePageSupplierView").hide();
    $("#purchasePageSupplierPhoneFieldLength").hide();

    $("#purchasePageSupplierPhoneField").change(function () {

        var purchasePageSupplierPhoneFieldLength = $("#purchasePageSupplierPhoneField").val().trim().length;

        if (purchasePageSupplierPhoneFieldLength != 11) {

            $('#purchasePageAddSupplierForm').hide();
            $("#purchasePageSupplierView").hide();

            $("#purchasePageSupplierPhoneFieldLength").show();

        } else {
            $("#purchasePageSupplierPhoneFieldLength").hide();






            var link = $("#supplierCheckLink").val().trim() + "?phone=" + $("#purchasePageSupplierPhoneField").val();
            console.log(link);

            $.get(link, function (data, status) {
                if (data == 1) {


                    var link = $("#supplierViewLink").val().trim() + "?phone=" + $("#purchasePageSupplierPhoneField").val();
                    //     console.log(link);
                    $.get(link, function (data, status) {
                        supplier_id = data.id;
                        supplier_previous_due=data.due;
                        $("#purchasePageSupplierName").text(data.name);
                        $("#purchasePageSupplierPhone").text(data.phone);
                        $("#purchasePageSupplieCompany").text(data.company);
                        $("#purchasePageSupplierDue").html("Due : " + data.due);

                        $('#purchasePageAddSupplierForm').hide();
                        $("#purchasePageSupplierView").show();
                    });
                } else {
                    $('#purchasePageAddSupplierForm').show();
                    $("#purchasePageSupplierView").hide();
                }

            });
        }


    });


    $("#purchasePageAddSupplierButton").click(function () {
        var phoneNumber = $("#purchasePageSupplierPhoneField").val();


        $("#purchasePageAddSupplierFormPhone").val(phoneNumber);
        var frm = $('#purchasePageAddSupplierForm');
        $.ajax({
            type: frm.attr('method'),
            url: frm.attr('action'),
            data: frm.serialize(),
            success: function (data) {

                var link = $("#supplierViewLink").val().trim() + "?phone=" + $("#purchasePageSupplierPhoneField").val();

                console.log('1 was successful.');
                console.log("supplier link" + link);
                console.log(' 2 was successful.');

                $.get(link, function (data, status) {
                    supplier_previous_due=data.due;
                
                    supplier_id= data.id;
                    $("#purchasePageSupplierName").text(data.name);
                    $("#purchasePageSupplierPhone").text(data.phone);
                    $("#purchasePageSupplieCompany").text(data.company);
                    $("#purchasePageSupplierDue").html("Due : " + data.due);

                    $('#purchasePageAddSupplierForm').hide();
                    $("#purchasePageSupplierView").show();
                });

                console.log('121 Submission was successful.');
                $("#purchasePageAddSupplierError").hide();

                //  console.log(data);
            },
            error: function (data) {
                console.log('An error occurred.');
                $("#purchasePageAddSupplierError").html(data);
                console.log(data);
            },
        });


    });


    // supplier Area end 


    //;/ product area start 


    // $("body").on("click", "#purchaseProductTableEdit", function () {
    //    console.log("clicked");
    // var frm = $('#create-form');
    // $.ajax({
    //     type: frm.attr('method'),
    //     url: frm.attr('action'),
    //     data: frm.serialize(),
    //     success: function (data) {

    //         console.log('Submission was successful.');
    //         console.log(data);
    //     },
    //     error: function (data) {
    //         console.log('An error occurred.');
    //         console.log(data);
    //     },
    // });


    //  });




    $("#purchaseProductError").hide();

    $("#purchaseProductInputId").change(function () {

        var viewLink = $("#productViewLink").val().trim() + "?id=" + $("#purchaseProductInputId").val().trim();
        var checkLink = $("#productCheckLink").val().trim() + "?id=" + $("#purchaseProductInputId").val().trim();

        $.get(checkLink, function (data) {
            if (data == 1) {
                $(".purchaseProductCreateProduct").show();
                $("#purchaseProductError").hide();

                $.get(viewLink, function (data) {
                    //   console.log(data);
                    $("#purchaseProductInputName").val(data.name);
                });

                $("#purchaseProductInputPrice").val(0);
                $("#purchaseProductInputQuantity").val(0);
                $("#purchaseProductInputTotal").val(0);

                $("#purchaseProductInputPrice").prop("disabled", false);
                $("#purchaseProductInputQuantity").prop("disabled", false);
                $("#purchaseProductInputTotal").prop("disabled", false);

            } else {
                $(".purchaseProductCreateProduct").show();
                $("#purchaseProductError").show();

                $("#purchaseProductInputName").val('');
                $("#purchaseProductInputPrice").val(0);
                $("#purchaseProductInputQuantity").val(0);
                $("#purchaseProductInputTotal").val(0);

                $("#purchaseProductInputSubmit").attr("disabled", true);

                $("#purchaseProductInputPrice").prop("disabled", true);
                $("#purchaseProductInputQuantity").prop("disabled", true);
                $("#purchaseProductInputTotal").prop("disabled", true);

            }



            purchaseProductInputSubmitButton();

        });




        // var request = $.get(link);
        // request.success(function(data) {


        //     console.log(data);

        //     $("#purchaseProductInputName").val(data.name);

        // });
        // request.error(function(jqXHR, textStatus, errorThrown){
        //     console.log(jqXHR);
        //     console.log(textStatus);
        //     console.log(errorThrown);
        // });






    });

    $("#purchaseProductInputPrice").change(function () {


        var price = $("#purchaseProductInputPrice").val();
        var quantity = $("#purchaseProductInputQuantity").val();
        $("#purchaseProductInputTotal").val(price * quantity);



        purchaseProductInputSubmitButton();
    });

    $("#purchaseProductInputQuantity").change(function () {

        var price = $("#purchaseProductInputPrice").val();
        var quantity = $("#purchaseProductInputQuantity").val();
        $("#purchaseProductInputTotal").val(price * quantity);



        purchaseProductInputSubmitButton();

    });

    $("#purchaseProductInputTotal").change(function () {

        purchaseProductInputSubmitButton();


    });







    // Cart Area Start Here 




    function showTable() {

        totalPaurchase = 0;
        var totalPaurchaseRow = 0;

        totalPaurchase = parseInt(totalPaurchase);
        totalPaurchaseRow = parseInt(totalPaurchaseRow);

        productDiscount = totalPaurchaseRow - totalPaurchase;

        var html = '';
        var i = 0;
        jQuery.each(purchaseTableData, function (row) {

            totalPaurchase += parseInt(purchaseTableData[row].total.trim());
            totalPaurchaseRow += parseInt(purchaseTableData[row].quantity.trim()) * parseInt(purchaseTableData[row].price.trim())
            html += '<tr>'
            html += '<td>' + ++i + '</td>'
            html += '<td>' + purchaseTableData[row].id + '</td>'
            html += '<td>' + purchaseTableData[row].name + '</td>'
            html += '<td>' + purchaseTableData[row].price + '</td>'
            html += '<td>' + purchaseTableData[row].quantity + '</td>'
            html += '<td>' + purchaseTableData[row].total + '</td>'
            html += '<td>'
            html += '<button type="button" productId=' + purchaseTableData[row].id + ' id="purchaseProductTableEdit" class="btn btn-success"> <i class="fa fa-edit" aria-hidden="false"> </i></button>'
            html += ' <button type="button" id="purchaseProductTableDelete" productId=' + purchaseTableData[row].id + '  class="btn btn-danger" > <i class="fa fa-trash" aria-hidden="false"> </i></button>'

            html += '</td> </tr>';
            $("#purchaseProductTableTbody").html(html);
            $("#totalPrice").text(totalPaurchase);
            $("#totalDue").text(totalPaurchase);



            $("#totalPriceDiscount").text(totalPaurchaseRow - totalPaurchase);
            productDiscount = totalPaurchaseRow - totalPaurchase;
        });
    }


    // Submit button area 


    function purchaseProductInputSubmitButton() {
        var purchaseProductInputId = $("#purchaseProductInputId").val();
        var purchaseProductInputPrice = $("#purchaseProductInputPrice").val();
        var purchaseProductInputQuantity = $("#purchaseProductInputQuantity").val();
        var purchaseProductInputTotal = $("#purchaseProductInputTotal").val();

        purchaseProductInputId = parseInt(purchaseProductInputId);
        purchaseProductInputPrice = parseInt(purchaseProductInputPrice);
        purchaseProductInputQuantity = parseInt(purchaseProductInputQuantity);
        purchaseProductInputTotal = parseInt(purchaseProductInputTotal);

        console.log(purchaseProductInputId);
        console.log(purchaseProductInputPrice);
        console.log(purchaseProductInputQuantity);
        console.log(purchaseProductInputTotal);

        if (purchaseProductInputId > 0 && purchaseProductInputPrice > 0 && purchaseProductInputQuantity > 0 && purchaseProductInputTotal > 0) {

            $("#purchaseProductInputSubmit").attr("disabled", false);

        } else {
            $("#purchaseProductInputSubmit").attr("disabled", true);
        }

    }
    $('#purchaseProductInputSubmit').click(function () {
        var purchaseProductInputId = $("#purchaseProductInputId").val();
        var purchaseProductInputName = $("#purchaseProductInputName").val();
        var purchaseProductInputPrice = $("#purchaseProductInputPrice").val();
        var purchaseProductInputQuantity = $("#purchaseProductInputQuantity").val();
        var purchaseProductInputTotal = $("#purchaseProductInputTotal").val();

        purchaseTableData[purchaseProductInputId] = {
            id: purchaseProductInputId,
            name: purchaseProductInputName,
            price: purchaseProductInputPrice,
            quantity: purchaseProductInputQuantity,
            total: purchaseProductInputTotal,

        };
        console.log(purchaseTableData);
        showTable();

    });

    $("body").on("click", "#purchaseProductTableEdit", function () {
        $("#purchaseProductTableTbody").html("");
        var prooductId = $(this).attr('productId');
        //   alert(prooductId);

        $("#purchaseProductInputId").val(purchaseTableData[prooductId].id);
        $("#purchaseProductInputName").val(purchaseTableData[prooductId].name);
        $("#purchaseProductInputPrice").val(purchaseTableData[prooductId].price);
        $("#purchaseProductInputQuantity").val(purchaseTableData[prooductId].quantity);
        $("#purchaseProductInputTotal").val(purchaseTableData[prooductId].total);



        delete purchaseTableData[prooductId];
        showTable();
        purchaseProductInputSubmitButton();

    });

    $("body").on("click", "#purchaseProductTableDelete", function () {
        console.log("clicked");

        $("#purchaseProductTableTbody").html("");

        // $(this).addClass('edit-item-trigger-clicked');
        // console.log("class added ");
        // var el = $(".edit-item-trigger-clicked");
        // console.log("class selected ");
        // var prooductId= el.attr('productId');

        var prooductId = $(this).attr('productId');

        console.log("Clicked On " + prooductId);

        delete purchaseTableData[prooductId];
        showTable();
        showTable();

        purchaseProductInputSubmitButton();

    });


    // Cart Area End Here 
    // submit Area Start 



    $("#purchasePaymentField").change(function () {
       // console.log("paymnet input field");
       // var due = parseInt($("#totalPrice").text()) - parseInt($("#purchasePaymentField").val());
        //console.log("due " + due);
        $("#totalDue").text( supplier_previous_due + totalPaurchase  - parseInt($("#purchaseMoreDiscountField").val()) - parseInt($("#purchasePaymentField").val())   );

    });


    $("#purchaseMoreDiscountField").change(function () {

        // alert( totalPaurchase + "  "+productDiscount +" "+ parseInt($("#purchaseMoreDiscountField").val()) );
        var totalDiscount = productDiscount + parseInt($("#purchaseMoreDiscountField").val());

        // console.log("paymnet input field");
        //  var totalDiscount = parseInt($("#totalPriceDiscount").text()) + parseInt($("#purchaseMoreDiscountField").val());
        //  var totalDiscount = parseInt($("#purchaseMoreDiscountField").val()) + parseInt(totalPriceDiscount);


        $("#totalPriceDiscount").text(totalDiscount);

        ///var due = parseInt($("#totalPrice").text()) - parseInt($("#purchaseMoreDiscountField").val());

         $("#totalPrice").text(  totalPaurchase );
       // var due = parseInt($("#totalPrice").text()) - parseInt($("#purchasePaymentField").val());
        //    console.log("due " + due);
        $("#totalDue").text( supplier_previous_due +  totalPaurchase  - parseInt($("#purchaseMoreDiscountField").val()) - parseInt($("#purchasePaymentField").val())   );

    });

    $("#purchaseCompleteButton").click(function () {

        var cardLegth = 0;
        jQuery.each(purchaseTableData, function (row) {
            cardLegth++;
        });


        if (cardLegth < 1) {
            alert("Add Some Product Firest");
        } else if ($("#purchasePageSupplierPhoneField").val().trim().length != 11) {
            alert("Add a supplier");
        } else {


            due = $("#totalDue").text();
            var discount = $("#totalPriceDiscount").text();
            var total = $("#totalPrice").text();
            var pay = $("#purchasePaymentField").val();

            $("#purchaseSubmitFormUserId").val(user_id);
            $("#purchaseSubmitFormSupplierId").val(supplier_id);
            $("#purchaseSubmitFormPayment").val(pay);
            $("#purchaseSubmitFormDue").val(due);
            $("#purchaseSubmitFormPreDue").val(supplier_previous_due);
            $("#purchaseSubmitFormDiscount").val(discount);
            $("#purchaseSubmitFormTotal").val(total);
            console.log("user_id" + user_id);
            console.log("supplier_id" + supplier_id);
            console.log("due" + due);
            console.log("discount" + discount);



            var frm = $('#purchaseSubmitForm');
            var act = frm.attr('action');
            console.log("action " + act);
            $.ajax({
                type: frm.attr('method'),
                url: act,
                data: frm.serialize(),
                success: function (data) {
                    
                    
                    console.log(' purchaseSubmitForm Submission was successful. and id is ' + data);

                    var invoiceLink= $("#printInvoice").attr('href');
                    $("#printInvoice").attr('href',invoiceLink+data);


                    /////////////////////////////////// saving 

                    console.log("Row Start");
                    jQuery.each(purchaseTableData, function (row) {
                        
                     /// console.log(purchaseTableData);

                        $("#orderProductAddPurchaseId").val(data);
                        $("#orderProductAddProductId").val(purchaseTableData[row].id);
                        $("#orderProductAddPrice").val(purchaseTableData[row].price);
                        $("#orderProductAddQuantity").val(purchaseTableData[row].quantity);
                        $("#orderProductAddTotal").val(purchaseTableData[row].total);

                        var OPfrm = $('#orderProductAddForm');
                        var act = OPfrm.attr('action');
                        console.log("---------- action " + act);
                        $.ajax({
                            type: OPfrm.attr('method'),
                            url: act,
                            data: OPfrm.serialize(),
                            success: function (successData) {
                                console.log(' orderProductAddForm successful. and id is ' + successData + purchaseTableData[row].total);
                            },
                            error: function (data) {
                                alert("Failed create  order deatails ..... Try Again !!!!!!!!!!!")
                                console.log('An error occurred.');
                                console.log(data);
                            },
                        });
                    });




                    //////////////// saving end 


                },
                error: function (data) {
                    alert("Failed order ..... Try Again !!!!!!!!!!!")
                    console.log('An error occurred.');
                    console.log(data);
                },
            });



            $('#Print-modal').modal();
        }


        
        var link = $("#suppliersDue").val().trim() + "?id="+supplier_id+"&&"+"due=" + due;
        console.log("suppliersDue"+link);

        $.get(link, function (data, status) {
            console.log("successfully updated supplier data ");
        });
       
    });



    // submit Area End 




});
