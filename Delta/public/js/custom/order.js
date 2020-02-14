$(document).ready(function () {

    console.log("page is ready");

    var user_id=100;
    var customer_id;
    var customer_previous_due=0;
    var due ;
    var orderTableData = {};
    var productDiscount = 0;
    var totalPaurchase = 0;
    var orderId= 0;
    // customer Area Start 


    $('#orderPageAddCustomerForm').hide();
    $("#orderPageCustomerView").hide();
    $("#orderPageCustomerPhoneFieldLength").hide();

    $("#orderPageCustomerPhoneField").change(function () {

        var orderPageCustomerPhoneFieldLength = $("#orderPageCustomerPhoneField").val().trim().length;

        if (orderPageCustomerPhoneFieldLength != 11) {

            $('#orderPageAddCustomerForm').hide();
            $("#orderPageCustomerView").hide();
            $("#orderPageCustomerPhoneFieldLength").show();

        } else {
            $("#orderPageCustomerPhoneFieldLength").hide();






            var link = $("#customerCheckLink").val().trim() + "?phone=" + $("#orderPageCustomerPhoneField").val();
            console.log(link);

            $.get(link, function (data, status) {
                if (data == 1) {


                    var link = $("#customerViewLink").val().trim() + "?phone=" + $("#orderPageCustomerPhoneField").val();
                         console.log("chack-- "+ link);
                    $.get(link, function (data, status) {
                        customer_id = data.id;
                        customer_previous_due=data.due;
                        $("#orderPageCustomerName").text(data.name);
                        $("#orderPageCustomerPhone").text(data.phone);
                        $("#orderPageCustomerCompany").text(data.company);
                        $("#orderPageCustomerDue").html("Due : " + data.due);

                        $('#orderPageAddCustomerForm').hide();
                        $("#orderPageCustomerView").show();
                    });
                } else {
                    $('#orderPageAddCustomerForm').show();
                    $("#orderPageCustomerView").hide();
                }

            });
        }


    });


    $("#orderPageAddCustomerButton").click(function () {
        var phoneNumber = $("#orderPageCustomerPhoneField").val();


        $("#orderPageAddCustomerFormPhone").val(phoneNumber);
        var frm = $('#orderPageAddCustomerForm');
        $.ajax({
            type: frm.attr('method'),
            url: frm.attr('action'),
            data: frm.serialize(),
            success: function (data) {

                var link = $("#customerViewLink").val().trim() + "?phone=" + $("#orderPageCustomerPhoneField").val();

                console.log('1 was successful.');
                console.log("customer link" + link);
                console.log(' 2 was successful.');

                $.get(link, function (data, status) {
                    customer_previous_due=data.due;
                
                    customer_id= data.id;
                    $("#orderPageCustomerName").text(data.name);
                    $("#orderPageCustomerPhone").text(data.phone);
                    $("#orderPageSupplieCompany").text(data.company);
                    $("#orderPageCustomerDue").html("Due : " + data.due);

                    $('#orderPageAddCustomerForm').hide();
                    $("#orderPageCustomerView").show();
                });

                console.log('121 Submission was successful.');
                $("#orderPageAddCustomerError").hide();

                //  console.log(data);
            },
            error: function (data) {
                console.log('An error occurred.');
                $("#orderPageAddCustomerError").html(data);
                console.log(data);
            },
        });


    });


    // customer Area end 


    //;/ product area start 


    // $("body").on("click", "#orderProductTableEdit", function () {
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




    $("#orderProductError").hide();

    $("#orderProductInputId").change(function () {

        var viewLink = $("#productViewLink").val().trim() + "?id=" + $("#orderProductInputId").val().trim();
        var checkLink = $("#productCheckLink").val().trim() + "?id=" + $("#orderProductInputId").val().trim();

        $.get(checkLink, function (data) {
            if (data == 1) {
                $(".orderProductCreateProduct").show();
                $("#orderProductError").hide();

                $.get(viewLink, function (data) {
                    //   console.log(data);
                    $("#orderProductInputName").val(data.name);
                    $("#orderProductInputPrice").val(data.price_per_unit);
                });

                $("#orderProductInputQuantity").val();
                $("#orderProductInputTotal").val(0);

                $("#orderProductInputPrice").prop("disabled", false);
                $("#orderProductInputQuantity").prop("disabled", false);
                $("#orderProductInputTotal").prop("disabled", false);

            } else {
                $(".orderProductCreateProduct").show();
                $("#orderProductError").show();

                $("#orderProductInputName").val('');
                $("#orderProductInputPrice").val(0);
                $("#orderProductInputQuantity").val(0);
                $("#orderProductInputTotal").val(0);

                $("#orderProductInputSubmit").attr("disabled", true);

                $("#orderProductInputPrice").prop("disabled", true);
                $("#orderProductInputQuantity").prop("disabled", true);
                $("#orderProductInputTotal").prop("disabled", true);

            }



            orderProductInputSubmitButton();

        });








    });

    $("#orderProductInputPrice").change(function () {


        var price = $("#orderProductInputPrice").val();
        var quantity = $("#orderProductInputQuantity").val();
        $("#orderProductInputTotal").val(price * quantity);



        orderProductInputSubmitButton();
    });

    $("#orderProductInputQuantity").change(function () {

        var price = $("#orderProductInputPrice").val();
        var quantity = $("#orderProductInputQuantity").val();
        $("#orderProductInputTotal").val(price * quantity);



        orderProductInputSubmitButton();

    });

    $("#orderProductInputTotal").change(function () {

        orderProductInputSubmitButton();


    });







    // Cart Area Start Here 




    function showTable() {

        totalPaurchase = 0;
        var totalPaurchaseRow = 0;

        totalPaurchase = parseFloat(totalPaurchase);
        totalPaurchaseRow = parseFloat(totalPaurchaseRow);

        productDiscount = totalPaurchaseRow - totalPaurchase;

        var html = '';
        var i = 0;
        jQuery.each(orderTableData, function (row) {

            totalPaurchase += parseFloat(orderTableData[row].total.trim());
            totalPaurchaseRow += parseFloat(orderTableData[row].quantity.trim()) * parseFloat(orderTableData[row].price.trim())
            html += '<tr>'
            html += '<td>' + ++i + '</td>'
            html += '<td>' + orderTableData[row].id + '</td>'
            html += '<td>' + orderTableData[row].name + '</td>'
            html += '<td>' + orderTableData[row].price_per_unit + '</td>'
            html += '<td>' + orderTableData[row].quantity + '</td>'
            html += '<td>' + orderTableData[row].total + '</td>'
            html += '<td>'
            html += '<button type="button" productId=' + orderTableData[row].id + ' id="orderProductTableEdit" class="btn btn-success"> <i class="fa fa-edit" aria-hidden="false"> </i></button>'
            html += ' <button type="button" id="orderProductTableDelete" productId=' + orderTableData[row].id + '  class="btn btn-danger" > <i class="fa fa-trash" aria-hidden="false"> </i></button>'

            html += '</td> </tr>';
            $("#orderProductTableTbody").html(html);
            $("#totalPrice").text(totalPaurchase);
            $("#totalDue").text(totalPaurchase);



            $("#totalPriceDiscount").text(totalPaurchaseRow - totalPaurchase);
            productDiscount = totalPaurchaseRow - totalPaurchase;
        });
    }


    // Submit button area 


    function orderProductInputSubmitButton() {
        var orderProductInputId = $("#orderProductInputId").val();
        var orderProductInputPrice = $("#orderProductInputPrice").val();
        var orderProductInputQuantity = $("#orderProductInputQuantity").val();
        var orderProductInputTotal = $("#orderProductInputTotal").val();

        orderProductInputId = parseInt(orderProductInputId);
        orderProductInputPrice = parseInt(orderProductInputPrice);
        orderProductInputQuantity = parseInt(orderProductInputQuantity);
        orderProductInputTotal = parseInt(orderProductInputTotal);

        console.log(orderProductInputId);
        console.log(orderProductInputPrice);
        console.log(orderProductInputQuantity);
        console.log(orderProductInputTotal);

        if (orderProductInputId > 0 && orderProductInputPrice > 0 && orderProductInputQuantity > 0 && orderProductInputTotal > 0) {

            $("#orderProductInputSubmit").attr("disabled", false);

        } else {
            $("#orderProductInputSubmit").attr("disabled", true);
        }

    }
    $('#orderProductInputSubmit').click(function () {
        var orderProductInputId = $("#orderProductInputId").val();
        var orderProductInputName = $("#orderProductInputName").val();
        var orderProductInputPrice = $("#orderProductInputPrice").val();
        var orderProductInputQuantity = $("#orderProductInputQuantity").val();
        var orderProductInputTotal = $("#orderProductInputTotal").val();

        orderTableData[orderProductInputId] = {
            id: orderProductInputId,
            name: orderProductInputName,
            price: orderProductInputPrice,
            quantity: orderProductInputQuantity,
            total: orderProductInputTotal,

        };
        console.log(orderTableData);
        showTable();

    });

    $("body").on("click", "#orderProductTableEdit", function () {
        $("#orderProductTableTbody").html("");
        var prooductId = $(this).attr('productId');
        //   alert(prooductId);

        $("#orderProductInputId").val(orderTableData[prooductId].id);
        $("#orderProductInputName").val(orderTableData[prooductId].name);
        $("#orderProductInputPrice").val(orderTableData[prooductId].price);
        $("#orderProductInputQuantity").val(orderTableData[prooductId].quantity);
        $("#orderProductInputTotal").val(orderTableData[prooductId].total);



        delete orderTableData[prooductId];
        showTable();
        orderProductInputSubmitButton();

    });

    $("body").on("click", "#orderProductTableDelete", function () {
        console.log("clicked");

        $("#orderProductTableTbody").html("");

        // $(this).addClass('edit-item-trigger-clicked');
        // console.log("class added ");
        // var el = $(".edit-item-trigger-clicked");
        // console.log("class selected ");
        // var prooductId= el.attr('productId');

        var prooductId = $(this).attr('productId');

        console.log("Clicked On " + prooductId);

        delete orderTableData[prooductId];
        showTable();
        showTable();

        orderProductInputSubmitButton();

    });


    // Cart Area End Here 
    // submit Area Start 



    $("#orderPaymentField").change(function () {
       // console.log("paymnet input field");
       // var due = parseInt($("#totalPrice").text()) - parseInt($("#orderPaymentField").val());
        //console.log("due " + due);
        $("#totalDue").text( customer_previous_due + totalPaurchase  - parseInt($("#orderMoreDiscountField").val()) - parseInt($("#orderPaymentField").val())   );

    });


    $("#orderMoreDiscountField").change(function () {

        // alert( totalPaurchase + "  "+productDiscount +" "+ parseInt($("#orderMoreDiscountField").val()) );
        var totalDiscount = productDiscount + parseInt($("#orderMoreDiscountField").val());

        // console.log("paymnet input field");
        //  var totalDiscount = parseInt($("#totalPriceDiscount").text()) + parseInt($("#orderMoreDiscountField").val());
        //  var totalDiscount = parseInt($("#orderMoreDiscountField").val()) + parseInt(totalPriceDiscount);


        $("#totalPriceDiscount").text(totalDiscount);

        ///var due = parseInt($("#totalPrice").text()) - parseInt($("#orderMoreDiscountField").val());

         $("#totalPrice").text(  totalPaurchase );
       // var due = parseInt($("#totalPrice").text()) - parseInt($("#orderPaymentField").val());
        //    console.log("due " + due);
        $("#totalDue").text( customer_previous_due +  totalPaurchase  - parseInt($("#orderMoreDiscountField").val()) - parseInt($("#orderPaymentField").val())   );

    });

    $("#orderCompleteButton").click(function () {

        var cardLegth = 0;
        jQuery.each(orderTableData, function (row) {
            cardLegth++;
        });


        if (cardLegth < 1) {
            alert("Add Some Product Firest");
        } else if ($("#orderPageCustomerPhoneField").val().trim().length != 11) {
            alert("Add a customer");
        } else {


            due = $("#totalDue").text();
            var discount = $("#totalPriceDiscount").text();
            var total = $("#totalPrice").text();
            var pay = $("#orderPaymentField").val();

            $("#orderSubmitFormUserId").val(user_id);
            $("#orderSubmitFormCustomerId").val(customer_id);
            $("#orderSubmitFormPayment").val(pay);
            $("#orderSubmitFormDue").val(due);
            $("#orderSubmitFormPreDue").val(customer_previous_due);
            $("#orderSubmitFormDiscount").val(discount);
            $("#orderSubmitFormTotal").val(total);
            console.log("user_id---" + user_id);
            console.log("customer_id" + customer_id);
            console.log("due" + due);
            console.log("discount" + discount);



            var frm = $('#orderSubmitForm');
            var act = frm.attr('action');
            console.log("action " + act);
            $.ajax({
                type: frm.attr('method'),
                url: act,
                data: frm.serialize(),
                success: function (data) {
                    
                    
                    console.log(' orderSubmitForm Submission was successful. and id is ' + data);

                    var invoiceLink= $("#printInvoice").attr('href');
                    $("#printInvoice").attr('href',invoiceLink+data);


                    /////////////////////////////////// saving 

                    console.log("Row Start");
                    jQuery.each(orderTableData, function (row) {
                        
                     /// console.log(orderTableData);

                        $("#orderProductAddOrderId").val(data);
                        $("#orderProductAddProductId").val(orderTableData[row].id);
                        $("#orderProductAddPrice").val(orderTableData[row].price);
                        $("#orderProductAddQuantity").val(orderTableData[row].quantity);
                        $("#orderProductAddTotal").val(orderTableData[row].total);

                        var OPfrm = $('#orderProductAddForm');
                        var act = OPfrm.attr('action');
                        console.log("---------- action " + act);
                        $.ajax({
                            type: OPfrm.attr('method'),
                            url: act,
                            data: OPfrm.serialize(),
                            success: function (successData) {
                               /// console.log(' orderProductAddForm successful. and id is ' + successData + orderTableData[row].total);
                            },
                            error: function (data) {
                                alert("Failed order ..... Try Again !!!!!!!!!!!")
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


        
        var link = $("#customersDue").val().trim() + "?id="+customer_id+"&&"+"due=" + due;
        console.log("customersDue-----------"+link);

        $.get(link, function (data, status) {
            console.log("successfully updated customer data ");
        });
       
    });



    // submit Area End 




});
