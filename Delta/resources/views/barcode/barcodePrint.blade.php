
<div>

<button type="button" id="printPdf" style="color: royalblue;  background-color:black;  ">print </button>
<a href="{{route("barcode")}}"><button type="button" " style="color: royalblue;  background-color:black;  ">Go Back </button> </a>
</div>

<div id="page-top" >  

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

<body  >



    <div  class="container-fluid " id="printdata">
      
        <div class="row">

 


@for($i=0 ; $i< $amount ; $i++)
 
        <?php if( $i % 4 ==0  ){ ?>
        <div style="float:left;  padding-top:12px; padding-bottom:15px;" >
        <?php
                
                echo '<img width="120%" src="data:image/png;base64,' . DNS1D::getBarcodePNG($id, "C39") . '"    />'.'<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$id   ;
                ?>
                    </div> 

        <?php }else { ?>

        <div style="float:left;  padding-left:80px; padding-top:12px; padding-bottom:15px; "  >
        <?php
                
                echo '<img width="120%" src="data:image/png;base64,' . DNS1D::getBarcodePNG($id, "C39") . '"    />'.'<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$id   ;
                ?>
                    </div> 
        <?php } ?>
    
@endfor



        </div>
                    
    </div>




    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('file/jquery/jquery.min.js')}}"></script>


    <script src="{{asset('file/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <script src="{{asset('js/printThis.js')}}"></script>

    <script src="{{asset('js/custom/print.js')}}"></script>







</body>

</html>




</div>





