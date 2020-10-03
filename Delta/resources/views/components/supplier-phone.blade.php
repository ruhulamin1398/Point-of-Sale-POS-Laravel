
    <div class="card border-light bg-abasas-dark  text-center w-100 p-2"  >
        <h3 class="text-white">Supplier</h3>

        <div class="card-body">
            <div class="row no-gutters ">


                <form method="GET" id="supplierForm">
                    @csrf
                    <div class="form-row ">
                        <div class="col-auto">
                            <form method="post">



                                <div class=" col-auto ">
                                    <label class="text-light w-100" for="supplierPhoneField">Supplier Number</label>
                                    <input type="text" name="phone" id="supplierPhoneField" class="form-control mb-2 " >
                                </div>
                                <div class=" text-light font-weight-bold " id="supplierPhoneArea"></div>
                                <input type="number" name="supplier_id" id='supplier_input_id' value="1"  hidden>
                            </form>
                        </div>
                    </div>
                </form>
                <!-- </div> -->



                <form method="POST" action="{{route('SupplierStore')}}" id="supplierPhoneAreaForm">
                    @csrf
                    <div class="form-row ">
                        <div class="col-auto">
                            <input type="number" name="name" placeholder="name" id="SupplierPhoneComponantInputName" class="form-control mb-2">
                        </div>
                        <div class="col-auto">
                            <input type="text" id="supplierPhoneFieldForm" name="phone" class="form-control mb-2" hidden>
                        </div>
                        <div class="col-auto">
                            <input type="text" name="address" placeholder="address" id="SupplierPhoneComponantInputAddress" class="form-control mb-2">
                        </div>
                        <div class="col-auto">
                            <input type="text" name="company" placeholder="company" id="SupplierPhoneComponantInputCompany" class="form-control mb-2">
                        </div>
                        <div class="col-auto">
                            <button type="button" id="addsupplierButton" class="btn btn-primary mt-3">সম্পন্ন</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>


        </div>

     




<script>
    $(document).ready(function() {

        function viewSupplierData(supplier) {
            console.log(supplier);
            console.log('supplier');

            $("#supplierPhoneAreaForm").hide();
            $("#supplier_input_id").val(supplier.id);

            html = "";
            html += '<div class="text-center text-light">' + supplier.name + '</div>';

            html += '<div class="text-center text-light">' + supplier.company + '</div>';
            html += '<div class="text-center text-light">Due : <span class="text-danger">' + supplier.due + '</span></div>';
            $("#supplierPhoneArea").html(html);




        }

        $("#supplierPhoneAreaForm").hide();

        
        $("#supplierPhoneField").on('keyup', function() {
            $("#supplier_input_id").val(1);


            var supplierPhoneFieldLength = $("#supplierPhoneField").val().trim().length;

            if (supplierPhoneFieldLength != 11) {
                var text = ' <div class="bg-danger text-light "> Please Enter a Valid phone number </div>';
                $("#supplierPhoneArea").html(text);
                $("#supplierPhoneAreaForm").hide();


            } else {
                $("#supplierPhoneAreaForm").hide();
                $("#supplierPhoneArea").html('');

                var link = "{{route('home')}}/api/supplier-check?phone=" + $("#supplierPhoneField").val().trim();
                console.log(link);

                $.get(link, function(supplier, status) {
                    if (supplier == 0) {


                        $("#supplierPhoneAreaForm").show();
                        $("#SupplierPhoneComponantInputName").val("");
                        $("#SupplierPhoneComponantInputAddress").val("");
                        $("#SupplierPhoneComponantInputCompany").val("");
                        $("#supplierPhoneFieldForm").val($("#supplierPhoneField").val().trim());
                    } else {

                        viewSupplierData(supplier);

                    }


                });
            }


        });

        $("#addsupplierButton").on('click', function() {


            var OPfrm = $('#supplierPhoneAreaForm');
            var act = OPfrm.attr('action');
            console.log("---------- action " + act);
            $.ajax({
                type: OPfrm.attr('method'),
                url: act,
                data: OPfrm.serialize(),
                success: function(supplier){

                    viewSupplierData(supplier);
                }
                  ,
                error: function(data) {
                    alert("Failed order ..... Try Again !!!!!!!!!!!")
                    console.log('An error occurred.');
                    console.log(data);
                },
            });

        });





    });
</script>