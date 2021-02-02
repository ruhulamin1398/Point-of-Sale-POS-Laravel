
@include('includes.formLink')






<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{  session('shop_name') }}</title>

    <link rel="stylesheet" href="{{asset('css/fontawesome-free/css/all.min.css')}}" type="text/css">

    <link rel="stylesheet" href="{{asset('css/admin/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/admin/sb-admin-2.min.css')}}">
    {{-- <link rel="stylesheet" href="{{asset('css/admin/dataTables.bootstrap4.min.css')}}"> --}}
    <link rel="stylesheet" href="{{asset('css/admin/datatables.min.css')}}">
    <link rel="stylesheet" src="{{asset('bootstrap-select/css/bootstrap-select.min.css')}}">
    
    <link rel="stylesheet" href="{{asset('css/admin/jquery-ui.min.css')}}">
    <style>
        .border-dotted{
            border-style: dotted;
            border-width: 3px;
        }
        .dataTables_wrapper .dt-buttons {
            float:left;  
            text-align:center;
            margin-left: 20px;
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
    {{-- <script src="{{asset('js/admin/jquery.dataTables.min.js')}}"></script> --}}
    <script src="{{asset('js/admin/dataTables.min.js')}}"></script>
    {{-- <script src="{{asset('js/admin/dataTables.bootstrap4.min.js')}}"></script> --}}
    <script src="{{asset('bootstrap-select/js/bootstrap-select.min.js')}}"></script>

   

    
    <script src="{{asset('js/abasas/app.js')}}"></script>
    
  <script src="{{asset('js/admin/jquery-ui.js')}}"></script>
</head>

<body id="page-top">


        <!-- Page Wrapper -->
        <div id="wrapper">
    
    
            <x-sidebar />
       
    
        
    
            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">
    
                <!-- Main Content -->
                <div id="content">
    
                    
                    <x-navbar/>
    
                    <!-- Begin Page Content -->
                    <div class="container-fluid">
    
                        @yield('content')
    
                </div>
                <!-- End of Main Content -->
    
                <!-- Footer -->
                <x-footer>

                </x-footer>
                <!-- End of Footer -->
    
            </div>
            <!-- End of Content Wrapper -->
    
        </div>
        <!-- End of Page Wrapper -->
        </div>
        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>
    
    
    
      
    
    
    
    </body>


</html>