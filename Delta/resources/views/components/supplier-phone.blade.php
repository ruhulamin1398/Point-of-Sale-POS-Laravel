<div class="card border-light bg-abasas-dark  text-center w-100 p-2">
    <h3 class="text-white"> {{ __('translate.Supplier') }} <button type="button" id="NewSupplierButton" class="btn btn-success btn-sm"><i class="fas fa-plus"></i></button></h3>

    <div class="card-body">
        <div class="row no-gutters ">


            <form method="GET" id="supplierForm" style="margin: 0 auto;">
                @csrf
               



                    <span class="text-light  pl-2"> {{ __('translate.Search') }}</span>
                    <div class="col-auto " style="position: relative;">
                        
                        <input type="text" name="" id="supplierSearchField" class="form-control form-control-lg  mb-1 p-4 inputMinZero rounded-1 border-info"
                            autocomplete="off"  >
                            
                        <div id="supplierSuggession" class="list-group" id="show-supplier-list" style="position: absolute;   left:20px; z-index:9999; max-height: 200px;overflow:scroll; "> </div>
                    </div>



                    <div class="col-auto text-light font-weight-bold " id="supplierPhoneArea"></div>
                    <input type="number" name="supplier_id" id='supplier_input_id' value="1" hidden>


             
            </form>
            



            <form method="POST" action="{{ route('SupplierStore') }}" id="supplierPhoneAreaForm" style="margin: 0 auto; display: none">
                @csrf

                    <div class="col-auto">
                        <input type="text" name="name" placeholder="{{ __('translate.Name') }}" id="SupplierPhoneComponantInputName"
                            class="form-control mb-2">
                        <p class="text-danger"style="display: none;" id="SupplierPhoneComponantInputNameWarrning"> {{ __('translate.Enter Name') }}</p>
                    </div>
                    <div class="col-auto">
                        <input type="text" id="SupplierPhoneComponantInputphone" name="phone" class="form-control mb-2" placeholder="{{ __('translate.Phone') }}">
                        <p class="text-danger" style="display: none;" id="SupplierPhoneComponantInputPhoneWarrning"> {{ __('translate.Enter Phone') }}</p>
                    </div>
                    <div class="col-auto">
                        <input type="text" name="address" placeholder="{{ __('translate.Address') }}" id="SupplierPhoneComponantInputAddress"
                            class="form-control mb-2">
                    </div>
                    <div class="col-auto">
                        <input type="text" name="company" placeholder="{{ __('translate.Company') }}" id="SupplierPhoneComponantInputCompany"
                            class="form-control mb-2">
                    </div>
                    <div class="col-auto">
                        <button type="button" id="addsupplierButton" class="btn btn-primary mt-3"> {{ __('translate.Completed') }}</button>
                    </div>
                
            </form>
        </div>
    </div>


</div>






<script>
    $(document).ready(function () {

        function viewSupplierData(supplier) {
            console.log(supplier);
            console.log('supplier');

            $("#supplierPhoneAreaForm").hide();
           // $("#supplier_input_id").val(supplier.id); //no need

            html = "";
             html += '<div class="text-center text-light" id="supplierPhone" > {{ __('translate.Phone') }}: ' + supplier.phone + '</div>';

            html += '<div class="text-center text-light"  id="supplierCompany"  >{{ __('translate.Company') }}: ' + supplier.company +
                '</div>';
            html += '<div class="text-center text-light">{{ __('translate.Due') }} : <span class="text-danger" id="supplierDue">' +
                supplier.due + '</span></div>';
            $("#supplierPhoneArea").html(html);
            $("#supplierPhoneArea").show();


            ///////////////////////// ********************** ///////////////
            //                         this is the property of purchase create page
            $("#purchasePreviousDue").text(supplier.due);
            $("#totalDue").text(0);
            var finalTotal = parseInt($("#finalTotal").text().trim()) + parseInt(supplier.due);
            $("#finalTotal").text(finalTotal);
            $("#PayAmount").val(finalTotal);
            $("#changeAmount").html('');



            ///////////////////////************************* *///////////
        }

        


        function supplierFunction(id) {
            var link = "{{ route('home') }}/api/supplier-find?id=" +id;
            console.log(link);

            $.get(link, function (supplier, status) {
                viewSupplierData(supplier);
            });

            
        }


    //                               *****************************************************************************
    //                                           ##########  Add Supplier Section    #############
    //                               *******************************************************************************

        $(document).on('click','#NewSupplierButton',function(){
            $("#supplierPhoneAreaForm").show();
        });
        $("#addsupplierButton").on('click', function () {
            $('#SupplierPhoneComponantInputNameWarrning').hide()
            $('#SupplierPhoneComponantInputPhoneWarrning').hide()

            // if($('#SupplierPhoneComponantInputName').val() == ''){
            //     $('#SupplierPhoneComponantInputNameWarrning').show();
            //     return ;
            // }
            if($('#SupplierPhoneComponantInputphone').val() == ''){
                $('#SupplierPhoneComponantInputPhoneWarrning').show();
                return ;
            }
            var OPfrm = $('#supplierPhoneAreaForm');
            var act = OPfrm.attr('action');            console.log("---------- action " + act);
         
            $.ajax({
                type: OPfrm.attr('method'),
                url: act,
                data: OPfrm.serialize(),
                success: function (supplier) {
                    $("#supplier_id").val(supplier.id);
                    $("#supplierSearchField").val(supplier.name);
                    viewSupplierData(supplier);
                },
                error: function (data) {
                    alert("Failed to add supplier ..... Try Again !!!!!!!!!!!")
                    console.log('An error occurred.');
                    console.log(data);
                },
            });

        });


    //                               *****************************************************************************
    //                                           ##########  Search Supplier suggession    #############
    //                               *******************************************************************************

    var databaseSupplier = @json($suppliers);
    
    $("#supplierSuggession").hide();
    $("#supplierSearchField").on('keyup', function () {
        $("#supplierSuggession").show();
        $("#supplierPhoneAreaForm").hide();
        $("#supplierPhoneArea").hide();
       

        var searchField = $("#supplierSearchField").val();
        var expression = new RegExp(searchField, "i");
        if (searchField.length == 0) {
            return false;
        }
        $("#supplierSuggession").html("");

        var count = 0;
        $.each(databaseSupplier, function (key, value) {


            if (value.name.search(expression) != -1 ||value.phone.search(expression) != -1) {
                if (count == 50) {
                    return false;
                }
                count++;
                $('#supplierSuggession').append(
                    '<a herf="#" class="list-group-item list-group-item-action border-1 searchSupplier text-dark" data-item-id="' +
                    value.id + '"data-item-name="' + value.name + '">' + value.name + ' | ' + value.phone + ' </a>')
            }

        });
        if (count == 0) {
            $('#supplierSuggession').html(
                '<div class="list-group-item list-group-item-action border-1 text-danger"> No Supplier found on Data </div>'
            )
        }



    });

    
    $('body').click(function () {
        $("#supplierSuggession").hide();
        $("#supplierSuggession").html("");
    });

    $(document).on('click', '.searchSupplier', function () {
        var id = $(this).attr('data-item-id');
        var name = $(this).attr('data-item-name');
        $("#supplier_input_id").val(id)
        $("#supplierSearchField").val(name)
        
        $("#supplierSuggession").hide();
        $("#supplierSuggession").html("");
        supplierFunction(id);
    });



    });

</script>
