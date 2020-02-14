$(document).ready(function () {



    function create() {
        $("#create-button").click(function () {

            $('#create-modal').modal('show');
        });
    }
    create();




    $(document).on('click', "#edit-product-button", function () {


        $(this).addClass('edit-item-trigger-clicked'); //useful for identifying which trigger was clicked and consequently grab data from the correct row and not the wrong one.

        var options = {
            'backdrop': 'static'
        };
        $('#edit-product-modal').modal(options)
    });

    // on modal show
    $('#edit-product-modal').on('show.bs.modal', function () {
        var el = $(".edit-item-trigger-clicked"); // See how its usefull right here? 
        var row = el.closest(".data-row");

        // get the data
        var id = el.val();
        // var viewName = row.children("#viewName").text();
        // var viewCategoryId = row.children("#viewCategoryId").text();
        // var viewProductTypeId = row.children("#viewProductTypeId").text();
        // var viewWeight = row.children("#viewWeight").text();
        // var viewPrice = row.children("#viewPrice").text();
        // var viewCost = row.children("#viewCost").text();
        // var viewLowLimit = row.children("#viewLowLimit").text();

        // fill the data in the input fields



        $.get($("#productViewLink").val().trim() + "?id=" + id, function (product, status) {
            console.log(product);
       

            $("#editProductId").val(id);
            $("#editProductId2").val(id);
            $("#editProductName").val(product.name);
    
            var catagoryhtml = '';



        $.get($("#productCategoryLink").val().trim(), function (categories, status) {

            console.log(categories);
            categories.forEach(function (category, item) {
                //   alert(viewCategoryId+'   '+i.name);
                if (product.category_id == category.id) {
                    catagoryhtml += '   <option  selected="selected"  value="  ' + category.id + ' ">  ' + category.name + '    </option>';
                } else {
                    catagoryhtml += '   <option value="  ' + category.id + ' "> ' + category.name + '</option>';
                }

                // catagoryhtml += '   <option value="23"> addasfs </option>  <option value="33"> addaddddddddddsfs </option>  <option value="4"> adddddddddddasfs </option>'

                //catagoryhtml+='   <option value="5 "> name2</option>';
                ///alert("Data: " + item.id + "Data: " + item.name + "\nStatus: " + status);


            });

            // alert(catagoryhtml);

            $("#editProductCatagoryId").html(catagoryhtml);
        });




        var product_types_html = "";

        $.get($("#productTypeLink").val().trim(), function (prodyctTypes, status) {

          prodyctTypes.forEach(function (type, item) {

                //   alert(viewCategoryId+'   '+i.name);
                if (product.product_type_id == type.id) {
                    product_types_html += '   <option  selected="selected"  value="  ' + type.id + ' ">  ' + type.name + '    </option>';
                } else {
                    product_types_html += '   <option value="  ' + type.id + ' "> ' + type.name + '</option>';
                }



            });
            // alert(catagoryhtml);

            $("#editProductTypeId").html(product_types_html);
        });





        $("#editProductWeight").val(product.weight);
        $("#editProductPrice").val(product.price);
        $("#editProductCost").val(product.cost);
        $("#editLowLimit").val(product.low_limit);

    });

    // on modal hide
    $('#edit-product-modal').on('hide.bs.modal', function () {
        $('.edit-item-trigger-clicked').removeClass('edit-item-trigger-clicked')
        $("#edit-form").trigger("reset");
    })









  });



});
