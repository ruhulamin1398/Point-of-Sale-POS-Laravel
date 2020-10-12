{{-- 
@extends('includes.app')
@section('content')



<input type="text" name="" id="liveSearch" autocomplete="off" >
<ul class="list-group" id="result"> </ul>


<script>

$(document).ready(function(){
    $("#liveSearch").keyup(function(){
        
        var searchField= $("#liveSearch").val();
        var expression= new RegExp(searchField,"i");
        var link = "{{ route('getJson') }}" ;
        console.log(link)
        $.getJSON(link, function(data){
            $("#result").html("");
            console.log(data);
            $.each(data,function(key,value){
                console.log(value.id)
                console.log(expression)
               if(value.name.search(expression)!= -1 || value.id == searchField ){
              
                   $('#result').append('<li class="list-group-item"  >'+ value.id+' | '+value.name  +'</li>')
               }

               var html = '<ul> <li>aaaa</li> <li>bbbb</li></ul>';
               $("#liveSearch").html(html);
            });
        });

    });
});


</script>



@endsection

--}}


<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>jQuery UI Autocomplete - Default functionality</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    var availableTags = [
      "ActionScript",
      "AppleScript",
      "Asp",
      "BASIC",
      "C",
      "C++",
      "Clojure",
      "COBOL",
      "ColdFusion",
      "Erlang",
      "Fortran",
      "Groovy",
      "Haskell",
      "Java",
      "JavaScript",
      "Lisp",
      "Perl",
      "PHP",
      "Python",
      "Ruby",
      "Scala",
      "Scheme"
    ];
    $( "#tags" ).autocomplete({
      source: availableTags
    });
  } );
  </script>
</head>
<body>
 
<div class="ui-widget">
  <label for="tags">Tags: </label>
  <input id="tags">
</div>
 
 <div>
     Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequatur esse amet at nostrum aspernatur magni quidem hic atque neque deserunt molestias eos ducimus nemo consectetur, placeat ipsa accusamus tempora obcaecati sapiente quia maiores ab odio! Ducimus ab blanditiis magnam accusantium exercitationem, laboriosam veritatis itaque nulla, unde totam asperiores consequuntur placeat.
 </div>



 <input type="text" name="" id="search">
 <script>
$("#search").on('change',function(){
console.log($(this).val())
});


   $("#search").autocomplete({
     source: function(data,cb){

      $.getJSON("{{route('getJson')}}", function(data){
            $("#result").html("");
            console.log(data);
            var result;
            var res;
   
            var result;
            result= $.map(data,function(item){
              value = item.id+"|"+item.name;
             return{
               lebel:value,
               value:2
             }

            });
            cb(result);

          });

     }

   })
 </script>


<div class="bg-abasas-dark">
  static data
</div>

<input type="text" name="" id="staticInput">

<script>

$(function() {
    var arrLinks = [
        {
        key: 1,
        url: "http://google.com",
        label: 'google'},
    {
        key: 2,
        url: "http://yahoo.com",
        title: "Yahoo",
        label: 'yahoo'},
    {
        key: 2,
        url: "http://microsoft.com",
        label: 'microsoft'}
    ];
    $("input[name=url]").autocomplete({
        source: arrLinks
    }).data("autocomplete")._renderItem = function(ul, item) {
        return $("<li>").data("item.autocomplete", item).append("<a>" + item.url + "</a>").appendTo(ul);
    };
});
</script>






</body>
</html>