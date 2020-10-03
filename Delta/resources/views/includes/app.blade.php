
@include('includes.formLink')







<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Abasas POS</title>

    <link rel="stylesheet" href="{{asset('css/fontawesome-free/css/all.min.css')}}" type="text/css">

    <link rel="stylesheet" href="{{asset('css/admin/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/admin/sb-admin-2.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/admin/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" src="{{asset('bootstrap-select/css/bootstrap-select.min.css')}}">
    <style>
        .border-dotted{
    border-style: dotted;
    border-width: 3px;
   }
   
.bg-abasas-dark {

    background-color: #2a3f5c;
    color: #fff;

}
    </style>



    <script src="{{asset('js/admin/jquery.min.js')}}"></script>
    <script src="{{asset('js/admin/bootstrapbundle.js')}}"></script>
    <script src="{{asset('js/admin/easing.min.js')}}"></script>
    <script src="{{asset('js/admin/sb-admin-2.min.js')}}"></script>
    <script src="{{asset('js/admin/Chart.min.js')}}"></script>
    <script src="{{asset('js/admin/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('js/admin/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('bootstrap-select/js/bootstrap-select.min.js')}}"></script>



    
    <script src="{{asset('js/abasas/app.js')}}"></script>
    


</head>

<body>



    <x-navbar>

    </x-navbar>



    <div class="row">

        <div class="col-2">
            <x-sidebar />
        </div>
        <div class="col-10">




            @yield('content')





        </div>





    </div>

    </div>
    <x-footer>

    </x-footer>







</body>

</html>