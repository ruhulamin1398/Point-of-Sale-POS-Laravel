
<div>

    <button type="button" id="printPdf" style="color: white;  background-color:green;  ">Print </button>
    <a href="{{route("bar-codes.index")}}"><button type="button"  style="color: white;  background-color:red;  ">Cancel </button> </a>
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
    
        <link rel="stylesheet" href="{{asset('css/admin/sb-admin-2.min.css')}}">
        <script src="{{asset('js/admin/jquery.min.js')}}"></script>
        <script src="{{asset('js/admin/bootstrapbundle.js')}}"></script>
        <script src="{{asset('js/admin/easing.min.js')}}"></script>
        <script src="{{asset('js/admin/sb-admin-2.min.js')}}"></script>
        <script src="{{asset('js/admin/printThis.js')}}"></script>
        <script src="{{asset('bootstrap-select/js/bootstrap-select.min.js')}}"></script>
        <script src="{{asset('js/abasas/app.js')}}"></script>
    
        
    
    </head>
    
    <body  >
    
    
    
        <div  class="container-fluid " id="printdata">
          
            <div class="row">
    
     
    
            @for($i=0 ; $i< $amount ; $i++)
                 <!--Today order  Card Example -->
       
                 <div class="col-3 mb-4 text-center vtopCard">
              <div class="card  m-0 p-0 border border-dark">
               
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col ">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1   " style="font-size: 130%;"  >{{$product->name}}</div>
                      <?php
                         echo '<img width="82%" src="data:image/png;base64,' . DNS1D::getBarcodePNG($product->id , "C39") . '"    />';
                         ?>
    
                         @php 
                         $price = $product->price_per_unit * $product->unit->value ;
                         @endphp
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1" style="font-size: 100%;" >{{$product->id}}</div>
                      @if ($print_price == 1)
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1" style="font-size: 115%;"> Price(+ {{$product->tax}}% vat) :@if($product->tax_type_id ==2) {{ $price }} @else  {{ $price + $price * $product->tax /100  }} @endif </div>
                          
                      @endif
                      
                    
                    </div>
    
                  </div>
                </div>
              </div>
            </div>
    
    
                   
                 @endfor    
    
    
    
            </div>
                        
        </div>
    
    <script>
        
$(document).ready(function () {        

$("#printPdf").click(function() {

    $("#page-top").printThis({
        importCSS: true
    });
});

});

    </script>
    
        <!-- Bootstrap core JavaScript-->    

    
    
    
    
    
    
    </body>
    
    </html>
    
    
    
    
    
    </div>
    
    
    
    
    
    