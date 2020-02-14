<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Foyej Seed Company </title>

    <link href="{{asset('css/sb-admin-2.min.css')}}" rel="stylesheet">

</head>

<body id="page-top">



    <div class="container-fluid pt-4 mt-4" id="printdata">
        <div class="row pl-4 ml-4 mb-1">
            <div class="h5">Format CODE_39</div>
        </div>
        <div class="row pl-4 ml-4 mb-4">
            <div class="h5">Type TEXT</div>
        </div>
        <div class="row">


        @for($i=1 ; $i< 61 ; $i++)
 
        <div class="col-md-3 p-2">
                
            
                <?php
                $data=880+$i;
                echo '<img width="80%" src="data:image/png;base64,' . DNS1D::getBarcodePNG($data, "C39") . '"    />'.'<br>'.$data;
                ?>
            

                    </div>
@endfor

                    
    </div>


<button type="button" id="printPdf" style="color: royalblue;  background-color:black;  ">print </button>

    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('file/jquery/jquery.min.js')}}"></script>


    <script src="{{asset('file/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <script src="{{asset('js/printThis.js')}}"></script>








    <script>
        $("#printPdf").click(function() {

            $("#page-top").printThis({
                importCSS: true
            });
        });
    </script>


</body>

</html>










