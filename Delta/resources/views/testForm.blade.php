
@extends('includes.app')
@section('content')



<div class="container">
  <div class="row">
    <div class="col-md-8 offset-md-2 bg-abasas-dark p-4 mt-3 rounded">
      <h4 class="text-center"> Lorem ipsum dolor sit amet.</h4>
        <div style="position: relative;">
        <input type="text" name="" id="liveSearch" class="form-control form-control-lg rounded-0 border-info" autocomplete="off">
        <li class="nav-item dropdown open">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" active aria-haspopup="true" aria-expanded="true"  >
          Dropdown
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown" show>
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
        <!-- <div id="result" class="list-group" id="show-list" style="position: absolute;   left:20px;" >
        <a href="#" class="list-group-item list-group-item-action border-1" >List 222222 </a>
        <a href="#" class="list-group-item list-group-item-action border-1" class="z-index:-1 pointer-events: all " >List 333333333333 </a>
        <a href="#" class="list-group-item list-group-item-action border-1" style="pointer-events: none">Listeeeeeeeeeeee </a> -->
       

      </div>

       
    <div class="col-12">
      Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quaerat, ullam? Consequuntur quod error provident illum nulla. Porro minus similique quidem iure minima tempore debitis! Minima perferendis illo repellat voluptatum quo debitis necessitatibus quos cumque maiores dolores incidunt ut, quibusdam officiis? Sequi doloremque, autem impedit est id suscipit delectus inventore placeat! Magnam, vero. Voluptatibus ad unde aliquam doloribus iure temporibus labore atque debitis id minima, quae minus dolorum dicta recusandae distinctio consectetur, officia ea nesciunt maiores quam dolorem molestiae. Soluta quidem corporis modi sit delectus? Magni ab molestiae explicabo soluta ad deserunt officia consectetur ipsam sint nihil asperiores, voluptates aliquid sequi dignissimos ratione quisquam officiis nesciunt exercitationem debitis. Possimus ratione nemo eveniet obcaecati. Consectetur deserunt velit, hic harum ab fuga quia sit nisi iste corporis vero quis maxime voluptatum soluta ratione praesentium exercitationem. Et,
    </div>
        </div>

  
    </div>

   
  </div>
</div>

<div class="col-lg-3">
  loem40    kldfkjsadhfsa dklsf jhsdahfks h ,j k jhj
       <div class="bs-component">
          <ul class="nav nav-pills nav-stacked">
            <li class="dropdown open">
              <a id="ModelFilter" class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="true">
                Dropdown <span class="caret"></span>
              </a>
              <ul class="dropdown-menu " area-expanded="true" >
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li class="divider"></li>
                <li><a href="#">Separated link</a></li>
              </ul>
            </li>
          </ul>
       </div>
    </div>

<script>

$(document).ready(function(){
    $("#liveSearch").on('keyup',function(){
        
        var searchField= $("#liveSearch").val();
        var expression= new RegExp(searchField,"i");
        var link = "{{ route('getJson') }}" ;
        console.log(link)
        $.getJSON(link, function(data){
            $("#result").html("");
            console.log(data);
            var count=0;
            $.each(data,function(key,value){
                console.log(value.id)
                console.log(expression)
              
               if(value.name.search(expression)!= -1 || value.id == searchField ){
                            count ++;
                   $('#result').append('<a herf="#" class="list-group-item list-group-item-action border-1 searchItem" data-item-id="'+value.id+'">'+ + value.id+' | '+value.name +' | '+value.price_per_unit +' </a>')
               }
               if(count==0){
                $('#result').html('<div class="list-group-item list-group-item-action border-1"> Not found any Data </div>')
               }
               
            });
        });

    });
});


function itemSearch(){
  alert('111111111111111111111111111');
}
$(document.elementFromPoint).on('click','a',function(){
  alert('fdsa');
})


$(function(){
    $('.element.first').on('click',function(){
        alert('first clicked');//this one needs to be triggered
    });
     $('.element.second').on('click',function(){
        alert('second clicked');
    });
});
</script>


<style>
* {
  box-sizing: border-box;
}

body {
  font: 16px Arial;  
}

/*the container must be positioned relative:*/
.autocomplete {
  position: relative;
  display: inline-block;
}

input {
  border: 1px solid transparent;
  background-color: #f1f1f1;
  padding: 10px;
  font-size: 16px;
}

input[type=text] {
  background-color: #f1f1f1;
  width: 100%;
}

input[type=submit] {
  background-color: DodgerBlue;
  color: #fff;
  cursor: pointer;
}

.autocomplete-items {
  position: absolute;
  border: 1px solid #d4d4d4;
  border-bottom: none;
  border-top: none;
  z-index: 99;
  /*position the autocomplete items to be the same width as the container:*/
  top: 100%;
  left: 0;
  right: 0;
}

.autocomplete-items div {
  padding: 10px;
  cursor: pointer;
  background-color: #fff; 
  border-bottom: 1px solid #d4d4d4; 
}

/*when hovering an item:*/
.autocomplete-items div:hover {
  background-color: #e9e9e9; 
}

/*when navigating through the items using the arrow keys:*/
.autocomplete-active {
  background-color: DodgerBlue !important; 
  color: #ffffff; 
}
</style>


<h2>Autocomplete</h2>

<p>Start typing:</p>

<!--Make sure the form has the autocomplete function switched off:-->
<form autocomplete="off" action="/action_page.php">
  <div class="autocomplete" style="width:300px;">
    <input id="myInput" type="text" name="myCountry" placeholder="Country">
  </div>
  <input type="submit">
</form>
loored nfmdsb fmsadb fsdaaf sajhdfdsjkfkdsaj fksajdkf dsakfj kdsaj fdsafk dsakfj dslhflsadhj fsad;h fdsfjldshj;f sakfdj dsklfjkdslj fklsadjfkldshfjkshdfjkh dsjk fhjkldshf sa fsajdhfjk dsyruiew roewqi osdjfk cuoier cqwo cj
<script>
function autocomplete(inp, arr) {
  /*the autocomplete function takes two arguments,
  the text field element and an array of possible autocompleted values:*/
  var currentFocus;
  /*execute a function when someone writes in the text field:*/
  inp.addEventListener("input", function(e) {
      var a, b, i, val = this.value;
      /*close any already open lists of autocompleted values*/
      closeAllLists();
      if (!val) { return false;}
      currentFocus = -1;
      /*create a DIV element that will contain the items (values):*/
      a = document.createElement("DIV");
      a.setAttribute("id", this.id + "autocomplete-list");
      a.setAttribute("class", "autocomplete-items");
      /*append the DIV element as a child of the autocomplete container:*/
      this.parentNode.appendChild(a);
      /*for each item in the array...*/
      for (i = 0; i < arr.length; i++) {
        /*check if the item starts with the same letters as the text field value:*/
        if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
          /*create a DIV element for each matching element:*/
          b = document.createElement("DIV");
          /*make the matching letters bold:*/
          b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "1222222222222222222222222222222222222222222222222222222221 </strong>";
          b.innerHTML += arr[i].substr(val.length);
          /*insert a input field that will hold the current array item's value:*/
          b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
          /*execute a function when someone clicks on the item value (DIV element):*/
          b.addEventListener("click", function(e) {
              /*insert the value for the autocomplete text field:*/
              inp.value = this.getElementsByTagName("input")[0].value;
              /*close the list of autocompleted values,
              (or any other open lists of autocompleted values:*/
              closeAllLists();
          });
          a.appendChild(b);
        }
      }
  });
  /*execute a function presses a key on the keyboard:*/
  inp.addEventListener("keydown", function(e) {
      var x = document.getElementById(this.id + "autocomplete-list");
      if (x) x = x.getElementsByTagName("div");
      if (e.keyCode == 40) {
        /*If the arrow DOWN key is pressed,
        increase the currentFocus variable:*/
        currentFocus++;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 38) { //up
        /*If the arrow UP key is pressed,
        decrease the currentFocus variable:*/
        currentFocus--;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 13) {
        /*If the ENTER key is pressed, prevent the form from being submitted,*/
        e.preventDefault();
        if (currentFocus > -1) {
          /*and simulate a click on the "active" item:*/
          if (x) x[currentFocus].click();
        }
      }
  });
  function addActive(x) {
    /*a function to classify an item as "active":*/
    if (!x) return false;
    /*start by removing the "active" class on all items:*/
    removeActive(x);
    if (currentFocus >= x.length) currentFocus = 0;
    if (currentFocus < 0) currentFocus = (x.length - 1);
    /*add class "autocomplete-active":*/
    x[currentFocus].classList.add("autocomplete-active");
  }
  function removeActive(x) {
    /*a function to remove the "active" class from all autocomplete items:*/
    for (var i = 0; i < x.length; i++) {
      x[i].classList.remove("autocomplete-active");
    }
  }
  function closeAllLists(elmnt) {
    /*close all autocomplete lists in the document,
    except the one passed as an argument:*/
    var x = document.getElementsByClassName("autocomplete-items");
    for (var i = 0; i < x.length; i++) {
      if (elmnt != x[i] && elmnt != inp) {
        x[i].parentNode.removeChild(x[i]);
      }
    }
  }
  /*execute a function when someone clicks in the document:*/
  document.addEventListener("click", function (e) {
      closeAllLists(e.target);
  });
}

/*An array containing all the country names in the world:*/
var countries = ["Afghanistan","Albania","Algeria","Andorra","Angola","Anguilla","Antigua & Barbuda","Argentina","Armenia","Aruba","Australia","Austria","Azerbaijan","Bahamas","Bahrain","Bangladesh","Barbados","Belarus","Belgium","Belize","Benin","Bermuda","Bhutan","Bolivia","Bosnia & Herzegovina","Botswana","Brazil","British Virgin Islands","Brunei","Bulgaria","Burkina Faso","Burundi","Cambodia","Cameroon","Canada","Cape Verde","Cayman Islands","Central Arfrican Republic","Chad","Chile","China","Colombia","Congo","Cook Islands","Costa Rica","Cote D Ivoire","Croatia","Cuba","Curacao","Cyprus","Czech Republic","Denmark","Djibouti","Dominica","Dominican Republic","Ecuador","Egypt","El Salvador","Equatorial Guinea","Eritrea","Estonia","Ethiopia","Falkland Islands","Faroe Islands","Fiji","Finland","France","French Polynesia","French West Indies","Gabon","Gambia","Georgia","Germany","Ghana","Gibraltar","Greece","Greenland","Grenada","Guam","Guatemala","Guernsey","Guinea","Guinea Bissau","Guyana","Haiti","Honduras","Hong Kong","Hungary","Iceland","India","Indonesia","Iran","Iraq","Ireland","Isle of Man","Israel","Italy","Jamaica","Japan","Jersey","Jordan","Kazakhstan","Kenya","Kiribati","Kosovo","Kuwait","Kyrgyzstan","Laos","Latvia","Lebanon","Lesotho","Liberia","Libya","Liechtenstein","Lithuania","Luxembourg","Macau","Macedonia","Madagascar","Malawi","Malaysia","Maldives","Mali","Malta","Marshall Islands","Mauritania","Mauritius","Mexico","Micronesia","Moldova","Monaco","Mongolia","Montenegro","Montserrat","Morocco","Mozambique","Myanmar","Namibia","Nauro","Nepal","Netherlands","Netherlands Antilles","New Caledonia","New Zealand","Nicaragua","Niger","Nigeria","North Korea","Norway","Oman","Pakistan","Palau","Palestine","Panama","Papua New Guinea","Paraguay","Peru","Philippines","Poland","Portugal","Puerto Rico","Qatar","Reunion","Romania","Russia","Rwanda","Saint Pierre & Miquelon","Samoa","San Marino","Sao Tome and Principe","Saudi Arabia","Senegal","Serbia","Seychelles","Sierra Leone","Singapore","Slovakia","Slovenia","Solomon Islands","Somalia","South Africa","South Korea","South Sudan","Spain","Sri Lanka","St Kitts & Nevis","St Lucia","St Vincent","Sudan","Suriname","Swaziland","Sweden","Switzerland","Syria","Taiwan","Tajikistan","Tanzania","Thailand","Timor L'Este","Togo","Tonga","Trinidad & Tobago","Tunisia","Turkey","Turkmenistan","Turks & Caicos","Tuvalu","Uganda","Ukraine","United Arab Emirates","United Kingdom","United States of America","Uruguay","Uzbekistan","Vanuatu","Vatican City","Venezuela","Vietnam","Virgin Islands (US)","Yemen","Zambia","Zimbabwe"];

/*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/
autocomplete(document.getElementById("myInput"), countries);
</script>



@endsection






{{--  
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




 <div class="parent"></div>


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

<input type="text" name="url" />
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


--}}

{{--
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>jQuery UI Autocomplete - Default functionality</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <!-- <script src="https://code.jquery.com/jquery-1.4.4.js"></script> -->
  
  <script src="{{asset('js/admin/jquery.min.js')}}"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  
  
</head>
<body>

 




<input type="text" name="url" />
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
        return $('<li class="autoSearch">').data("item.autocomplete", item).append("<a>" + item.url + "</a>").appendTo(ul);
    };
});

$(document).on("click",function(){
  alert($($this))
})
</script>

</body>
</html>
--}}

{{--
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
    .parent{
      background-color: 099;
      height: 25vh;
      width: 30vw;
    }
    .chield{
      background-color: 990;
    }
  </style>
</head>
<body>
  

<div class="parent">
<p>lorem </p>
<div class="child"></div>
<p>Lorem, ipsum.</p>
</div>

</body>
</html>--}}