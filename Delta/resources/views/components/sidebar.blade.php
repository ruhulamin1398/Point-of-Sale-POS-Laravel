<!-- Sidebar -->
<ul class="navbar-nav    sidebar sidebar-dark accordion bg-abasas-dark " id="accordionSidebar">

    <!-- Divider -->






    <!-- Nav Item - Dashboard -->
    <li class="nav-item active ">
        <a class="nav-link p-3 " href="">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>{{__('translate.Home')}}</span></a>
    </li>
    <hr class="sidebar-divider m-1 p-0 ">
    <!-- Product Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed  p-3 " href="#" data-toggle="collapse" data-target="#collapseProducts" aria-expanded="true" aria-controls="collapseProducts">
            <i class="fas fa-fw fa-cog  "></i>
            <span>{{__('translate.Product')}}</span>
        </a>
        <div id="collapseProducts" class="collapse" aria-labelledby="headingProducts" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">



                <a class="collapse-item" href="#">{{__('translate.All Products')}}</a>
                <a class="collapse-item" href="#">{{__('translate.Add New')}}</a>
                <a class="collapse-item" href="#">{{__('translate.Category')}}</a>
                <a class="collapse-item" href="#">{{__('translate.Analysis')}}</a>
                <a class="collapse-item" href="#">{{__('translate.Return Product')}}</a>
                <a class="collapse-item" href="#">{{__('translate.Low Stock Products')}}</a>
            </div>
        </div>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider m-1 p-0 ">

    <!--sell -->

    <li class="nav-item">
        <a class="nav-link collapsed  p-3 " href="#" data-toggle="collapse" data-target="#collapseSell" aria-expanded="true" aria-controls="collapseSell">
            <i class="fas fa-fw fa-cog"></i>
            <span>পণ্য বিক্রয়</span>
        </a>
        <div id="collapseSell" class="collapse" aria-labelledby="headingSell" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">

                <a class="collapse-item" href="#">{{__('translate.Sell')}} </a></a>
                <a class="collapse-item" href="#">{{__('translate.Sell List')}} </a>

            </div>
        </div>
    </li>


    <!--sell -->
    <!-- Divider -->

    <hr class="sidebar-divider m-1 p-0 ">

    <!--purchase -->
    <li class="nav-item">
        <a class="nav-link collapsed  p-3 " href="#" data-toggle="collapse" data-target="#collapsePurchase" aria-expanded="true" aria-controls="collapsePurchase">
            <i class="fas fa-fw fa-cog"></i>
            <span>পণ্য ক্রয়</span>
        </a>
        <div id="collapsePurchase" class="collapse" aria-labelledby="headingPurchase" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">

                <a class="collapse-item" href="#">{{__('translate.Buy')}} </a>
                <a class="collapse-item" href="#">{{__('translate.Perchase List')}}  </a>

            </div>
        </div>
    </li>


    <!--purchase -->

    <!-- ///////////////////////////////////////////////////////////////////////////////////// -->


    <hr class="sidebar-divider m-1 p-0 ">
    <!-- Nav Item - Dashboard -->
    <li class="nav-item  ">
        <a class="nav-link p-3 " href="#">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>{{__('translate.Customer')}}</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider m-1 p-0 ">

    <!--supplier  Collapse Menu -->
    <li class="nav-item  ">
        <a class="nav-link p-3 " href="#">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span> {{__('translate.Supplier')}}</span></a>
    </li>



    <!-- Divider -->
    <hr class="sidebar-divider m-1 p-0 ">

    <!--Category  Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed  p-3 " href="#" data-toggle="collapse" data-target="#collapseStaff" aria-expanded="true" aria-controls="collapseStaff">
            <i class="fas fa-fw fa-cog"></i>
            <span> {{__('translate.Employee')}} </span>
        </a>
        <div id="collapseStaff" class="collapse" aria-labelledby="headingStaff" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="#"> {{__('translate.All Employee')}}</a>
                <a class="collapse-item" href="#">{{__('translate.Salary')}}</a>

            </div>
        </div>
    </li>


    <!-- Divider -->
    <hr class="sidebar-divider m-1 p-0 ">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item  ">
        <a class="nav-link p-3 " href="#">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>{{__('translate.Code Print')}}</span></a>
    </li>

    <!-- ///////////////////////////////////////////////////////////////////////////////////// -->



    <hr class="sidebar-divider m-1 p-0 ">

    <!-- Nav Item - Dashboard -->

    <li class="nav-item">
        <a class="nav-link collapsed  p-3 " href="#" data-toggle="collapse" data-target="#collapseExpenses" aria-expanded="true" aria-controls="collapseExpenses">
            <i class="fas fa-fw fa-cog"></i>
            <span>{{__('translate.Expense')}} </span>
        </a>
        <div id="collapseExpenses" class="collapse" aria-labelledby="headingExpenses" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">

                <a class="collapse-item" href="#">{{__('translate.Daily')}}</a>
                <a class="collapse-item" href="#">{{__('translate.Monthly')}}</a>
                <a class="collapse-item" href="#">{{__('translate.Yearly')}}</a>

            </div>
        </div>
    </li>

    <hr class="sidebar-divider m-1 p-0 ">


    <!-- Divider -->
    <hr class="sidebar-divider m-1 p-0 ">
    <!-- Nav Item - Dashboard -->
    <li class="nav-item  ">
        <a class="nav-link p-3 " href="#">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>{{__('translate.Goal')}}</span></a>
    </li>

    <hr class="sidebar-divider m-1 p-0 ">
    <!-- Nav Item - Dashboard -->
    <li class="nav-item  ">
        <a class="nav-link p-3 " href="#">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>user</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider m-1 p-0 ">
    <!-- Nav Item - Dashboard -->

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center  d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>



</ul>
<!-- End of Sidebar -->