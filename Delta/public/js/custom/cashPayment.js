$(document).ready(function () {


    var supplier_id;


    $("#paymenmtSupplierPhoneFieldLength").hide();
    $("#paymenmtSupplierPhoneFieldNotFound").hide();
    $("#paymenmtSupplierView").hide();




    $("#paymenmtSupplierPhoneField").change(function () {
        var link = $("#supplierViewLink").val().trim() + "?phone=" + $("#paymenmtSupplierPhoneField").val();
        console.log(link);

        var paymenmtSupplierPhoneFieldLength = $("#paymenmtSupplierPhoneField").val().trim().length;

        if (paymenmtSupplierPhoneFieldLength != 11) {

            $("#paymenmtSupplierView").hide();
            $("#paymenmtSupplierPhoneFieldNotFound").hide();
            $("#paymenmtSupplierPhoneFieldLength").show();
            $("#supplierCashReceiveSubmit").attr("disabled", true);

        } else {
            $("#paymenmtSupplierPhoneFieldLength").hide();
            $("#paymenmtSupplierPhoneFieldNotFound").hide();
            var link = $("#supplierCheckLink").val().trim() + "?phone=" + $("#paymenmtSupplierPhoneField").val();
            console.log(link);

            $.get(link, function (data, status) {
                if (data == 1) {


                    var link = $("#supplierViewLink").val().trim() + "?phone=" + $("#paymenmtSupplierPhoneField").val();
                    console.log("chack-- " + link);
                    $.get(link, function (data, status) {
                        supplier_id = data.id;
                        supplier_previous_due = data.due;
                        $("#paymenmtSupplierName").text(data.name);
                        $("#paymenmtSupplierPhone").text(data.phone);
                        $("#paymenmtSupplierCompany").text(data.company);
                        $("#paymenmtSupplierDue").html("Due : " + data.due);

                        $("#paymenmtSupplierView").show();

                        $("#SupplierCashsupplierId").val(data.id);
                        $("#SupplierCashsupplierPreviousDue").val(data.due);
                        
                        $("#supplierCashReceiveSubmit").attr("disabled", false);
                    });
                } else {
                    $("#supplierCashReceiveSubmit").attr("disabled", true);
                    $("#paymenmtSupplierView").hide();
                    $("#paymenmtSupplierPhoneFieldNotFound").show();
                    $("#paymenmtSupplierPhoneFieldLength").hide();

                    $("#supplierCashReceiveSubmit").attr("disabled", true);
                }

            });
        }

    });




});
