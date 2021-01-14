
@extends('includes.app')
@section('content')



<div class="container">
  <div class="row">
    <div class="col-md-8 offset-md-2 bg-abasas-dark p-4 mt-3 rounded">
      <h4 class="text-center"> Lorem ipsum dolor sit amet.</h4>
        <div style="position: relative;">
        <input type="text" name="" id="liveSearch" class="form-control form-control-lg rounded-0 border-info" autocomplete="off">
      
       <div id="result" class="list-group"   style="position: absolute;   left:20px;" > </div>

    </div>  
    </div>
   
  </div>
</div>


<script>

$(document).ready(function(){
  var link = "{{ route('getJson') }}" ;
  var data;
  $.getJSON(link, function(da){
data = da;
  })
  
    $("#liveSearch").on('keyup',function(){
        
        var searchField= $("#liveSearch").val();
        var expression= new RegExp(searchField,"i");
     
        console.log(link)
        // $.getJSON(link, function(data){
            $("#result").html("");
            console.log(data);
            var count=0;
            $.each(data,function(key,value){
                console.log(value.id)
                console.log(expression)
              
               if(value.name.search(expression)!= -1 || value.id == searchField ){
                            count ++;
                   $('#result').append('<a herf="#" class="list-group-item list-group-item-action border-1 searchItem text-dark" data-item-id="'+value.id+'">'+ + value.id+' | '+value.name +' | '+value.price_per_unit +' </a>')
               }
           
            });
            if(count==0){
                $('#result').html('<div class="list-group-item list-group-item-action border-1 text-dark"> Not found any Data </div>')
               }
               
        // });

    });
});






$('body').click(function() {
  $("#result").html("");
});

    $(document).on('click','.searchItem',function(){
      var id = $(this).attr('data-item-id');
      $("#liveSearch").val(id)
        // alert(id);//this one needs to be triggered
        $("#result").html("");
    });
    

</script>



@endsection


  