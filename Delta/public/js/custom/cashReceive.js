$(document).ready(function () {


    var customer_id;


    $("#cashReceiveCustomerPhoneFieldLength").hide();
    $("#cashReceiveCustomerPhoneFieldNotFound").hide();
    $("#cashReceiveCustomerView").hide();




    $("#cashReceiveCustomerPhoneField").change(function () {
        var link = $("#customerViewLink").val().trim() + "?phone=" + $("#cashReceiveCustomerPhoneField").val();
        console.log(link);

        var cashReceiveCustomerPhoneFieldLength = $("#cashReceiveCustomerPhoneField").val().trim().length;

        if (cashReceiveCustomerPhoneFieldLength != 11) {

            $("#cashReceiveCustomerView").hide();
            $("#cashReceiveCustomerPhoneFieldNotFound").hide();
            $("#cashReceiveCustomerPhoneFieldLength").show();
            $("#customerCashReceiveSubmit").attr("disabled", true);

        } else {
            $("#cashReceiveCustomerPhoneFieldLength").hide();
            $("#cashReceiveCustomerPhoneFieldNotFound").hide();
            var link = $("#customerCheckLink").val().trim() + "?phone=" + $("#cashReceiveCustomerPhoneField").val();
            console.log(link);

            $.get(link, function (data, status) {
                if (data == 1) {


                    var link = $("#customerViewLink").val().trim() + "?phone=" + $("#cashReceiveCustomerPhoneField").val();
                    console.log("chack-- " + link);
                    $.get(link, function (data, status) {
                        customer_id = data.id;
                        customer_previous_due = data.due;
                        $("#cashReceiveCustomerName").text(data.name);
                        $("#cashReceiveCustomerPhone").text(data.phone);
                        $("#cashReceiveCustomerCompany").text(data.company);
                        $("#cashReceiveCustomerDue").html("Due : " + data.due);

                        $("#cashReceiveCustomerView").show();

                        $("#CustomerCashcustomerId").val(data.id);
                        $("#CustomerCashcustomerPreviousDue").val(data.due);
                        
                        $("#customerCashReceiveSubmit").attr("disabled", false);
                    });
                } else {
                    $("#customerCashReceiveSubmit").attr("disabled", true);
                    $("#cashReceiveCustomerView").hide();
                    $("#cashReceiveCustomerPhoneFieldNotFound").show();
                    $("#cashReceiveCustomerPhoneFieldLength").hide();

                    $("#customerCashReceiveSubmit").attr("disabled", true);
                }

            });
        }

    });




});
