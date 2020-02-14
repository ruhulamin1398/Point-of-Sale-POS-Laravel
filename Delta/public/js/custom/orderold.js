$(document).ready(function () {
    console.log("page Ready");


    var user_id;
    var customer_id;
    var OrderTableData = {};
    
    // customer Area Start 
    
    $('#orderPageAddCustomerForm').hide();
    $("#orderPageCustomerView").hide();
    
    $("#orderPageCustomerPhoneField").change(function () {
    
        var link = $("#customerCheckLink").val().trim() + "?phone=" + $("#orderPageCustomerPhoneField").val();
        console.log(link);
    
        $.get(link, function (data, status) {
            if (data == 1) {
    
    
                var link = $("#customerViewLink").val().trim() + "?phone=" + $("#orderPageCustomerPhoneField").val();
                //     console.log(link);
                $.get(link, function (data, status) {
                    customer_id = data.id;
    
                    $("#orderPageCustomerName").text(data.name);
                    $("#orderPageCustomerPhone").text(data.phone);
                    $("#orderPageSupplieCompany").text(data.company);
                    $("#orderPageCustomerDue").html("Due : " + data.due);
    
                    $('#orderPageAddCustomerForm').hide();
                    $("#orderPageCustomerView").show();
                });
            } else {
                $('#orderPageAddCustomerForm').show();
                $("#orderPageCustomerView").hide();
            }
    
        });
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
                //     console.log(link);
                $.get(link, function (data, status) {
    
                    $("#orderPageCustomerName").text(data.name);
                    $("#orderPageCustomerPhone").text(data.phone);
                    $("#orderPageCustomerCompany").text(data.company);
                    $("#orderPageCustomerDue").html("Due : " + data.due);
    
                    $('#orderPageAddCustomerForm').hide();
                    $("#orderPageCustomerView").show();
                });
    
                console.log('Submission was successful.');
                $("#orderPageAddCustomerError").hide();
    
            //    console.log(data);
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
    
    
    
    
    $("#orderProductErrorId").hide();
    
    $("#orderProductInputId").change(function () {
    
        var viewLink = $("#productViewLink").val().trim() + "?id=" + $("#orderProductInputId").val().trim();
        var checkLink = $("#productCheckLink").val().trim() + "?id=" + $("#orderProductInputId").val().trim();
    
        $.get(checkLink, function (data) {
            if (data == 1) {
                $(".orderProductCreateProduct").show();
                $("#orderProductErrorId").hide();
    
                $.get(viewLink, function (data) {
                   //   console.log(data);
                    $("#orderProductInputName").val(data.name);
                    
                $("#orderProductInputPrice").val(data.price);
                $("#orderProductInputQuantity").val(data.stock);
                });

    
                $("#orderProductInputTotal").val(0);
    
                $("#orderProductInputPrice").prop("disabled", false);
                $("#orderProductInputQuantity").prop("disabled", false);
                $("#orderProductInputTotal").prop("disabled", false);
    
            } else {
                $(".orderProductCreateProduct").show();
                $("#orderProductErrorId").show();
    
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
    
    
    
    
        // var request = $.get(link);
        // request.success(function(data) {
    
    
        //     console.log(data);
    
        //     $("#orderProductInputName").val(data.name);
    
        // });
        // request.error(function(jqXHR, textStatus, errorThrown){
        //     console.log(jqXHR);
        //     console.log(textStatus);
        //     console.log(errorThrown);
        // });
    
    
    
    
    
    
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
    
        var totalPaurchase = 0;
        var totalPaurchaseRow = 0;
    
        totalPaurchase = parseInt(totalPaurchase);
        totalPaurchaseRow = parseInt(totalPaurchaseRow);
    
        var html = '';
        var i = 0;
        jQuery.each(OrderTableData, function (row) {
    
            totalPaurchase += parseInt(OrderTableData[row].total.trim());
            totalPaurchaseRow += parseInt(OrderTableData[row].quantity.trim()) * parseInt(OrderTableData[row].price.trim())
            html += '<tr>'
            html += '<td>' + ++i + '</td>'
            html += '<td>' + OrderTableData[row].id + '</td>'
            html += '<td>' + OrderTableData[row].name + '</td>'
            html += '<td>' + OrderTableData[row].price + '</td>'
            html += '<td>' + OrderTableData[row].quantity + '</td>'
            html += '<td>' + OrderTableData[row].total + '</td>'
            html += '<td>'
            html += '<button type="button" productId=' + OrderTableData[row].id + ' id="orderProductTableEdit" class="btn btn-success"> <i class="fa fa-edit" aria-hidden="false"> </i></button>'
            html += ' <button type="button" id="orderProductTableDelete" productId=' + OrderTableData[row].id + '  class="btn btn-danger" > <i class="fa fa-trash" aria-hidden="false"> </i></button>'
    
            html += '</td> </tr>';
            $("#orderProductTableTbody").html(html);
            $("#totalPrice").text(totalPaurchase);
            $("#totalPriceDiscount").text(totalPaurchaseRow - totalPaurchase);
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
    
        OrderTableData[orderProductInputId] = {
            id: orderProductInputId,
            name: orderProductInputName,
            price: orderProductInputPrice,
            quantity: orderProductInputQuantity,
            total: orderProductInputTotal,
    
        };
        console.log(OrderTableData);
        showTable();
    
    });
    
    $("body").on("click", "#orderProductTableEdit", function () {
        $("#orderProductTableTbody").html("");
        var prooductId = $(this).attr('productId');
        //   alert(prooductId);
    
        $("#orderProductInputId").val(OrderTableData[prooductId].id);
        $("#orderProductInputName").val(OrderTableData[prooductId].name);
        $("#orderProductInputPrice").val(OrderTableData[prooductId].price);
        $("#orderProductInputQuantity").val(OrderTableData[prooductId].quantity);
        $("#orderProductInputTotal").val(OrderTableData[prooductId].total);
    
    
    
        delete OrderTableData[prooductId];
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
    
        delete OrderTableData[prooductId];
        showTable();
        showTable();
    
        orderProductInputSubmitButton();
    
    });
    
    
    // Cart Area End Here 
    // submit Area Start 
    
    
    
    $("#orderPaymentField").change(function () {
        console.log("paymnet input field");
        var due = parseInt($("#totalPrice").text()) - parseInt($("#orderPaymentField").val());
        console.log("due " + due);
        $("#totalDue").text(due);
    });
    
    
    $("#orderMoreDiscountField").change(function () {
        console.log("paymnet input field");
        var totalDiscount = parseInt($("#totalPriceDiscount").text()) + parseInt($("#orderMoreDiscountField").val());
        $("#totalPriceDiscount").text(totalDiscount);

        var due = parseInt($("#totalPrice").text()) - parseInt($("#orderMoreDiscountField").val());
     
        $("#totalPrice").text(due);

        
        var due = parseInt($("#totalPrice").text()) - parseInt($("#orderPaymentField").val());
        console.log("due " + due);
        $("#totalDue").text(due);

    });
    
    $("#orderCompleteButton").click(function () {
            var due = $("#totalDue").text();
            var discount = $("#totalPriceDiscount").text();
            var total = $("#totalPrice").text();
            var pay = $("#orderPaymentField").val();
    
            $("#orderSubmitFormUserId").val(user_id);
            $("#orderSubmitFormCustomerId").val(customer_id);
            $("#orderSubmitFormPayment").val(pay);
            $("#orderSubmitFormDue").val(due);
            $("#orderSubmitFormDiscount").val(discount);
            $("#orderSubmitFormTotal").val(total);
            console.log("user_id" + user_id);
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
    
    
    
                    /////////////////////////////////// saving 
    
                     console.log("Row Start");
                    jQuery.each(OrderTableData, function (row) {
    
                        $("#orderProductAddOrderId").val(data);
                        $("#orderProductAddProductId").val(OrderTableData[row].id);
                        $("#orderProductAddPrice").val(OrderTableData[row].price);
                        $("#orderProductAddQuantity").val(OrderTableData[row].quantity);
                        $("#orderProductAddTotal").val(OrderTableData[row].total);
    
    
    
    
    
    
                        var OPfrm = $('#orderProductAddForm');
                        var act = OPfrm.attr('action');
                        console.log("action " + act);
                        $.ajax({
                            type: OPfrm.attr('method'),
                            url: act,
                            data: OPfrm.serialize(),
                            success: function (successData) {
                                console.log(' orderProductAddForm successful. and id is ' + successData+OrderTableData[row].total);
    
    
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
    
    
    });
    // sybmit Area End 
    
    
    
    
    });
    
