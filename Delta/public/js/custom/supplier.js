$(document).ready(function(){


    $(document).on('click', "#edit-supplier-button", function() {

      $(this).addClass('edit-item-trigger-clicked'); //useful for identifying which trigger was clicked and consequently grab data from the correct row and not the wrong one.
    
      var options = {
        'backdrop': 'static'
      };
      $('#supplier-edit-modal').modal(options)
    });
    
      // on modal show
      $('#supplier-edit-modal').on('show.bs.modal', function() {
        var el = $(".edit-item-trigger-clicked"); // See how its usefull right here? 
        var row = el.closest(".data-row");
        // get the data
        var id = el.val();
        var supplierName = row.children("#supplierName").text();
        var supplierPhone  = row.children("#supplierPhone").text();
        var supplierAddress = row.children("#supplierAddress").text();
        var supplierCompany = row.children("#supplierCompany").text();
        // fill the data in the input fields
        
        $("#customerEditId").val('0'+id);
        $("#SupplierEditId").val(id);
        $("#editModalSupplierName").val(supplierName);
        $("#editModalSupplierPhone").val(supplierPhone);
        $("#editModalSupplierAddress").val(supplierAddress);
        $("#editModalSupplierCompany").val(supplierCompany);
        
        
       
        

  

      // on modal hide
      $('#supplier-edit-modal').on('hide.bs.modal', function() {
        $('.edit-item-trigger-clicked').removeClass('edit-item-trigger-clicked')
        $("#edit-form").trigger("reset");
      });













  });
});