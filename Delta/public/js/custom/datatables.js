$(document).ready(function () {


  $("#btn3").click(function(){
    $.get("table/data", function(data, status){
      // alert("Data: " + data[0].role + "\nStatus: " + status + "hahahahhhahahhha");


                  var html='';
                  for (var i = 0; i < 20; i++) {
              data.forEach(function(row){
                  html += '<tr>'
                  html += '<td>' + row.id + '</td>'
                  html += '<td>' + row.role + '</td>'
                  html += '<td>' + row.id + '</td>'
                  html += '<td>' + row.role + '</td>'
                  html += '<td>' + row.role + '</td>'
                  html += '<td>'
                  html += '<button type="button" class="btn btn-xs btn-warning btnEdit" title="Edit Record" >Edit</button>'
                  html += '<button type="button" class="btn btn-xs btn-danger btnDelete" data-id="' + row.id + '" title="Delete Record">Delete</button>'
                  html += '</td> </tr>';
              });
            }
                $("#dataTable1 tbody").html(html);


    });
    
  });




    var ht =
        "<tr>" +

        " <td>" + " fdafaf" + " </td>" +
        " <td>" + "Shad Ddfgsdgdfgfdsggsdecker" +
        "</td>" + " <td>" + " fdafaf" + " </td>" +
        " <td>" + "Shad Ddfgsdgdfgfdsggsdecker" +
        "</td>" + " <td>" + " fdafaf" + " </td>" +
        "<td>" + "Shad Ddfgsdgdfgfdsggsdecker" + "</td>"
    "<td>" + "Shad Ddfgsdgdfgfdsggsdecker" + "</td>"

    +
    "</tr>";
    ht +=
        "<tr>" +

        " <td>" + " fdafaf" + " </td>" +
        " <td>" + "Shad Ddfgsdgdfgfdsggsdecker" +
        "</td>" + " <td>" + " fdafaf" + " </td>" +
        " <td>" + "Shad Ddfgsdgdfgfdsggsdecker" +
        "</td>" + " <td>" + " fdafaf" + " </td>" +
        "<td>" + "Shad Ddfgsdgdfgfdsggsdecker" + "</td>"
    "<td>" + "Shad Ddfgsdgdfgfdsggsdecker" + "</td>"

    +
    "</tr>";

    var ht2 =
        "<tr>" + " <td>" + " wdel" + " </td>" + " <td>" + "Shad Ddfgsdgdddddddddfgfdsggsdecker" + "</td>" + " <td>" + " fdafddddddddddddaf" + " </td>" + " <td>" + "Shad Ddfgsdgdfgfdsggsdecker" + "</td>" + " <td>" + " fdafaf" + " </td>" + " <td>" + "Shad Ddfgsdgdfgfdsggsdecker" + "</td>" + "</tr>"


    //  $("table tbody").html(ht);



    function cng() {
        $("#btn").click(function () {

            $("#table1tbody").html(ht2);

        });
    }
    cng();

    function cng2() {
        $("#btn2").click(function () {
            $("#table1tbody").html(ht);

        });
    }
    cng2();



    function fetchRecords() {

        $.ajax({
            url: '/data',
            type: 'get',
            dataType: 'json',
            success: function (response) {

                var len = 0;
                $('table tbody').empty(); // Empty <tbody>
                if (response['data'] != null) {

                    len = response['data'].length;
                }

                if (len > 0) {

                    for (var i = 0; i < len; i++) {
                        var id = response['data'][i].id;
                        var username = response['data'][i].role;
                        var name = response['data'][i].role;
                        var email = response['data'][i].role;

                        // var tr_str = "<tr>" +
                        //     "<td align='center'>" + (i+1) + "</td>" +
                        //     "<td align='center'>" + username + "</td>" +
                        //     "<td align='center'>" + name + "</td>" +
                        //     "<td align='center'>" + email + "</td>" +
                        // "</tr>";
                        var tr_str =
                            "<tr>" +

                            " <td>" + " fdafaf" + " </td>" +
                            " <td>" + "Shad 1" +
                            "</td>" + " <td>" + " 1" + " </td>" +
                            " <td>" + "Shad 1" +
                            "</td>" + " <td>" + " fdafaf" + " </td>" +
                            "<td>" + "Shad 1" + "</td>"
                        "<td>" + "Shad 1" + "</td>"

                        +
                        "</tr>";
                        $("table tbody").append(tr_str);
                    }
                } else if (response['data'] != null) {
                    var tr_str =
                        "<tr>" +

                        " <td>" + " fdafaf" + " </td>" +
                        " <td>" + "Shad 1" +
                        "</td>" + " <td>" + " 1" + " </td>" +
                        " <td>" + "Shad 1" +
                        "</td>" + " <td>" + " fdafaf" + " </td>" +
                        "<td>" + "Shad 1" + "</td>"
                    "<td>" + "Shad 1" + "</td>"

                    +
                    "</tr>";

                    $("table tbody").append(tr_str);
                } else {
                    var tr_str =
                        "<tr>" +

                        " <td>" + " fdafaf" + " </td>" +
                        " <td>" + "Shad 1" +
                        "</td>" + " <td>" + " 1" + " </td>" +
                        " <td>" + "Shad 1" +
                        "</td>" + " <td>" + " fdafaf" + " </td>" +
                        "<td>" + "Shad 1" + "</td>"
                    "<td>" + "Shad 1" + "</td>"

                    +
                    "</tr>";

                    $("table tbody").append(tr_str);
                }

            }
        });



    }

    // fetchRecords();


    // var adminUrl='';
    // function getRecords() {
    //   $.get(adminUrl+'table/data').success(function (data) {
    //           var html='';
    //           data.forEach(function(row){
    //               html += '<tr>'
    //               html += '<td>' + row.id + '</td>'
    //               html += '<td>' + row.role + '</td>'
    //               html += '<td>' + row.id + '</td>'
    //               html += '<td>' + row.role + '</td>'
    //               html += '<td>'
    //               html += '<button type="button" class="btn btn-xs btn-warning btnEdit" title="Edit Record" >Edit</button>'
    //               html += '<button type="button" class="btn btn-xs btn-danger btnDelete" data-id="' + row.id + '" title="Delete Record">Delete</button>'
    //               html += '</td> </tr>';
    //           });

    //       });
    //       $('table tbody').html(html);
    // }
    // getRecords();





    // $("#dataTable1 tbody").load('table.blade.php');







    /**
     * for showing edit item popup
     */
   
    $(document).on('click', "#edit-item", function() {


      $(this).addClass('edit-item-trigger-clicked'); //useful for identifying which trigger was clicked and consequently grab data from the correct row and not the wrong one.
  
      var options = {
        'backdrop': 'static'
      };
      $('#edit-modal').modal(options)
    });
  
    // on modal show
    $('#edit-modal').on('show.bs.modal', function() {
      var el = $(".edit-item-trigger-clicked"); // See how its usefull right here? 
      var row = el.closest(".data-row");
  
      // get the data
      var id = el.data('item-id');
      var name = row.children(".name").text();
      var description = row.children(".description").text();
  
      // fill the data in the input fields
      $("#modal-input-id").val(id);
      $("#modal-input-name").val(name);
      $("#modal-input-description").val(description);
  
    });
  
    // on modal hide
    $('#edit-modal').on('hide.bs.modal', function() {
      $('.edit-item-trigger-clicked').removeClass('edit-item-trigger-clicked')
      $("#edit-form").trigger("reset");
    })
  });
  
  

  



