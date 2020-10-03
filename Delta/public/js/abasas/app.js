$(document).ready(function(){


    
    $(".inputMinZero").on('change',function(){

        var data=  $(this).val().trim();
       
         if(data.length<1){
             $(this).val(0);
         }
         if(data<0){
            $(this).val(0);
        }
     });

    
     $(".inputMinOne").on('change',function(){

        var data=  $(this).val().trim();
       
        if(data.length<1){
            $(this).val(1);
        }
        if(data<1){
            $(this).val(1);
        }
     });
  



});