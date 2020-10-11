
@php
 $a = json_decode( json_decode(  $category->setting,true),true);
echo "<pre>";
print_r($a);
echo "</pre>";
@endphp

<script>

var b=    {
    "name":"John",
    "age":30,
    "cars": {
    "car1":"Ford",
    "car2":"BMW",
    "car3":"Fiat"
    }
  };
a =  @json( json_decode (( $category->setting),true)) ;
console.log(JSON.parse(a))
console.log(b)

</script>