
$(document).ready(function () {        

    $("#printPdf").click(function() {

        $("#page-top").printThis({
            importCSS: true
        });
    });

});
