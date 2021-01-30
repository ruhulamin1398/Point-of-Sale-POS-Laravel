<div class="card border-light bg-abasas-dark  text-center w-100 p-2">
    <h3 class="text-white">{{ __('translate.Customer') }}  <button type="button" id="NewCustomerButton" class="btn btn-success btn-sm"><i class="fas fa-plus"></i></button></h3>

    <div class="card-body">
        <div class="row no-gutters ">


            <form method="GET" id="customerForm" style="margin: 0 auto;">
                @csrf
               



                    <span class="text-light  pl-2">  {{ __('translate.Search') }}</span>
                    <div class="col-auto " style="position: relative;">
                        
                        <input type="text" name="" id="customerSearchField" class="form-control form-control-lg  mb-1 p-4 inputMinZero rounded-1 border-info"
                            autocomplete="off"  >
                            
                        <div id="customerSuggession" class="list-group" id="show-customer-list" style="position: absolute;   left:20px; z-index:9999; max-height: 200px;overflow:scroll; "> </div>
                    </div>



                    <div class="col-auto text-light font-weight-bold " id="customerPhoneArea"></div>
                    <input type="number" name="customer_id" id='customer_input_id' value="1" hidden>


             
            </form>
            



            <form method="POST" action="{{ route('CustomerStore') }}" id="customerPhoneAreaForm" style="margin: 0 auto; display: none">
                @csrf

                    <div class="col-auto">
                        <input type="text" name="name" placeholder="{{ __('translate.Name') }}" id="CustomerPhoneComponantInputName"
                            class="form-control mb-2">
                        <p class="text-danger"style="display: none;" id="CustomerPhoneComponantInputNameWarrning">{{ __('translate.Enter Name') }}</p>
                    </div>
                    <div class="col-auto">
                        <input type="text" id="CustomerPhoneComponantInputphone" name="phone" class="form-control mb-2" placeholder="{{ __('translate.Phone') }}">
                        <p class="text-danger" style="display: none;" id="CustomerPhoneComponantInputPhoneWarrning"> {{ __('translate.Enter Phone') }}</p>
                    </div>
                    <div class="col-auto">
                        <input type="text" name="address" placeholder="{{ __('translate.Address') }}" id="CustomerPhoneComponantInputAddress"
                            class="form-control mb-2">
                    </div>
                    <div class="col-auto">
                        <input type="text" name="company" placeholder="{{ __('translate.Company') }}" id="CustomerPhoneComponantInputCompany"
                            class="form-control mb-2">
                    </div>
                    <div class="col-auto">
                        <button type="button" id="addcustomerButton" class="btn btn-primary mt-3">{{ __('translate.Completed') }}</button>
                    </div>
                
            </form>
        </div>
    </div>


</div>






<script>
    $(document).ready(function () {

        function viewCustomerData(customer) {
            console.log(customer);
            console.log('customer');

            $("#customerPhoneAreaForm").hide();
           // $("#customer_input_id").val(customer.id); //no need

            html = "";
             html += '<div class="text-center text-light" id="customerPhone" > {{ __('translate.Phone') }}: ' + customer.phone + '</div>';

            html += '<div class="text-center text-light"  id="customerCompany"  >{{ __('translate.Company') }} : ' + customer.company +
                '</div>';
            html += '<div class="text-center text-light">{{ __('translate.Due') }} : <span class="text-danger" id="customerDue">' +
                customer.due + '</span></div>';
            $("#customerPhoneArea").html(html);
            $("#customerPhoneArea").show();


            ///////////////////////// ********************** ///////////////
            //                         this is the property of purchase create page
            $("#purchasePreviousDue").text(customer.due);
            $("#totalDue").text(0);
            var finalTotal = parseInt($("#finalTotal").text().trim()) + parseInt(customer.due);
            $("#finalTotal").text(finalTotal);
            $("#PayAmount").val(finalTotal);
            $("#changeAmount").html('');



            ///////////////////////************************* *///////////
        }

        


        function customerFunction(id) {
            var link = "{{ route('home') }}/api/customer-find?id=" +id;
            console.log(link);

            $.get(link, function (customer, status) {
                viewCustomerData(customer);
            });

            
        }


    //                               *****************************************************************************
    //                                           ##########  Add Customer Section    #############
    //                               *******************************************************************************

        $(document).on('click','#NewCustomerButton',function(){
            $("#customerPhoneAreaForm").show();
        });
        $("#addcustomerButton").on('click', function () {
            $('#CustomerPhoneComponantInputNameWarrning').hide()
            $('#CustomerPhoneComponantInputPhoneWarrning').hide()

            // if($('#CustomerPhoneComponantInputName').val() == ''){
            //     $('#CustomerPhoneComponantInputNameWarrning').show();
            //     return ;
            // }
            if($('#CustomerPhoneComponantInputphone').val() == ''){
                $('#CustomerPhoneComponantInputPhoneWarrning').show();
                return ;
            }
            var OPfrm = $('#customerPhoneAreaForm');
            var act = OPfrm.attr('action');            console.log("---------- action " + act);
         
            $.ajax({
                type: OPfrm.attr('method'),
                url: act,
                data: OPfrm.serialize(),
                success: function (customer) {
                    $("#customer_id").val(customer.id);
                    $("#customerSearchField").val(customer.name);
                    viewCustomerData(customer);
                },
                error: function (data) {
                    alert("Failed to add customer ..... Try Again !!!!!!!!!!!")
                    console.log('An error occurred.');
                    console.log(data);
                },
            });

        });


    //                               *****************************************************************************
    //                                           ##########  Search Customer suggession    #############
    //                               *******************************************************************************

    var databaseCustomer = @json($customers);
    
    $("#customerSuggession").hide();
    $("#customerSearchField").on('keyup', function () {
        $("#customerSuggession").show();
        $("#customerPhoneAreaForm").hide();
        $("#customerPhoneArea").hide();
       

        var searchField = $("#customerSearchField").val();
        var expression = new RegExp(searchField, "i");
        if (searchField.length == 0) {
            return false;
        }
        $("#customerSuggession").html("");

        var count = 0;
        $.each(databaseCustomer, function (key, value) {


            if (value.name.search(expression) != -1 ||value.phone.search(expression) != -1) {
                if (count == 50) {
                    return false;
                }
                count++;
                $('#customerSuggession').append(
                    '<a herf="#" class="list-group-item list-group-item-action border-1 searchCustomer text-dark" data-item-id="' +
                    value.id + '"data-item-name="' + value.name + '">' + value.name + ' | ' + value.phone + ' </a>')
            }

        });
        if (count == 0) {
            $('#customerSuggession').html(
                '<div class="list-group-item list-group-item-action border-1 text-danger"> No Customer found on Data </div>'
            )
        }



    });

    
    $('body').click(function () {
        $("#customerSuggession").hide();
        $("#customerSuggession").html("");
    });

    $(document).on('click', '.searchCustomer', function () {
        var id = $(this).attr('data-item-id');
        var name = $(this).attr('data-item-name');
        $("#customer_input_id").val(id)
        $("#customerSearchField").val(name)
        
        $("#customerSuggession").hide();
        $("#customerSuggession").html("");
        customerFunction(id);
    });



    });

</script>
