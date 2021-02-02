<!-- Sidebar -->
<ul class="navbar-nav    sidebar sidebar-dark accordion bg-abasas-dark " id="accordionSidebar">

    <!-- Divider -->




    <!-- Nav Item - Dashboard -->
    <li class="nav-item active ">
        <a class="nav-link p-3 " href="{{ route('home') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>{{__('translate.Home')}}</span></a>
    </li>


    
    @if( $GLOBALS['CurrentUser']->can('Product Page') || $GLOBALS['CurrentUser']->can('Product Create') ||  $GLOBALS['CurrentUser']->can('Category Page') || $GLOBALS['CurrentUser']->can('Brand Page') ||  $GLOBALS['CurrentUser']->can('Warrenty Page') || $GLOBALS['CurrentUser']->can('Unit Page') || $GLOBALS['CurrentUser']->can('Stock Alert Page') ||  $GLOBALS['CurrentUser']->can('Drop Product Create Page') ||   $GLOBALS['CurrentUser']->can('Drop Product Page')  ||  $GLOBALS['CurrentUser']->can('Product Print') )
    <hr class="sidebar-divider m-1 p-0 ">
    <!-- Product Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed  p-3 " href="#" data-toggle="collapse" data-target="#collapseProducts" aria-expanded="true" aria-controls="collapseProducts">
            <i class="fas fa-clipboard-check "></i>
            <span>{{__('translate.Product')}}</span>
        </a>
        <div id="collapseProducts" class="collapse" aria-labelledby="headingProducts" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">


                @can('Product Page')
                <a class="collapse-item" href="{{ route('products.index') }}">{{__('translate.All Products')}}</a>
                @endcan
                @can('Product Create')
                <a class="collapse-item" href="{{ route('products.create') }}">{{__('translate.Add New')}}</a>
                @endcan
                @can('Category Page')
                <a class="collapse-item" href="{{ route('categories.index') }}">{{__('translate.Category')}}</a>
                @endcan
                @can('Brand Page')
                <a class="collapse-item" href="{{ route('brands.index') }}">{{__('translate.Brands')}}</a>
                @endcan
                @can('Warrenty Page')
                <a class="collapse-item" href="{{ route('warrenties.index') }}">{{__('translate.Warrenty')}}</a>
                @endcan
                @can('Unit Page')
                <a class="collapse-item" href="{{ route('units.index') }}">{{__('translate.Units')}}</a>
                @endcan
                @can('Stock Alert Page')
                <a class="collapse-item" href="{{ route('stock_alert') }}">{{__('translate.Low Stock Products')}}</a>
                @endcan
                @can('Drop Product Create Page')
                <a class="collapse-item" href="{{ route('drop_products.create') }}">{{__('translate.Drop Product')}}</a>
                @endcan
                @can('Drop Product Page')
                <a class="collapse-item" href="{{ route('drop_products.index') }}">{{__('translate.Drop Product List')}}</a>
                @endcan
                @can('Product Print')
                <a class="collapse-item" href="{{ route('bar-codes.index') }}">{{__('translate.Code Print')}}</a>
                @endcan
            </div>
        </div>
    </li>
    @endif
    @if(  $GLOBALS['CurrentUser']->can('Order Create Page')  ||  $GLOBALS['CurrentUser']->can('Order Page') ||  $GLOBALS['CurrentUser']->can('Return From Customer Page') ||  $GLOBALS['CurrentUser']->can('Return From Customer Create Page') )
    <!-- Divider -->
    <hr class="sidebar-divider m-1 p-0 ">

    <!--sell -->

    <li class="nav-item">
        <a class="nav-link collapsed  p-3 " href="#" data-toggle="collapse" data-target="#collapseSell" aria-expanded="true" aria-controls="collapseSell">
            <i class="fas fa-fw fa-cog"></i>
            <span>{{__('translate.Product Sell')}}</span>
        </a>
        <div id="collapseSell" class="collapse" aria-labelledby="headingSell" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">

                @can('Order Create Page')
                <a class="collapse-item" href="{{ route('orders.create') }}">{{__('translate.Sell')}} </a>
                @endcan
                @can('Order Page')
                <a class="collapse-item" href="{{ route('orders.index') }}">{{__('translate.Sell List')}} </a>
                @endcan
                @can('Return From Customer Page')
                <a class="collapse-item" href="{{ route('return-from-customers.index') }}">{{__('translate.Return List')}} </a>
                @endcan
                @can('Return From Customer Create Page')
                <a class="collapse-item" href="{{ route('return-from-customers.create') }}">{{__('translate.Return Product')}}  </a>
                @endcan

            </div>
        </div>
    </li>
    @endif


    <!--sell -->
    <!-- Divider -->

    @if( $GLOBALS['CurrentUser']->can('Purchase Create Page') || $GLOBALS['CurrentUser']->can('Purchase Page') ||$GLOBALS['CurrentUser']->can('Return To Supplier Page') || $GLOBALS['CurrentUser']->can('Return To Supplier Create Page'))
    <hr class="sidebar-divider m-1 p-0 ">

    <!--purchase -->
    <li class="nav-item">
        <a class="nav-link collapsed  p-3 " href="#" data-toggle="collapse" data-target="#collapsePurchase" aria-expanded="true" aria-controls="collapsePurchase">
            <i class="fas fa-fw fa-cog"></i>
            <span>{{__('translate.Purchase')}}</span>
        </a>
        <div id="collapsePurchase" class="collapse" aria-labelledby="headingPurchase" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">

                @can('Purchase Create Page')
                <a class="collapse-item" href="{{ route('purchases.create') }}">{{__('translate.Buy')}} </a>
                @endcan
                @can('Purchase Page')
                <a class="collapse-item" href="{{ route('purchases.index') }}">{{__('translate.Perchase List')}}  </a>
                @endcan
                @can('Return To Supplier Page')
                <a class="collapse-item" href="{{ route('return-to-suppliers.index') }}">{{__('translate.Return List')}} </a>
                @endcan
                @can('Return To Supplier Create Page')
                <a class="collapse-item" href="{{ route('return-to-suppliers.create') }}">{{__('translate.Return Product')}}  </a>
                @endcan

            </div>
        </div>
    </li>
    @endif


    <!--purchase -->

    <!--purchase -->


   
    
        <!-- Divider -->

        @if( $GLOBALS['CurrentUser']->can('Customer Page') || ( $GLOBALS['CurrentUser']->can('Customer Due Receive Create Page') && $GLOBALS['CurrentUser']->can('Allow Customer Due')) || ( $GLOBALS['CurrentUser']->can('Customer Due Receive Page') && $GLOBALS['CurrentUser']->can('Allow Customer Due')))
        <hr class="sidebar-divider m-1 p-0 ">

        <!--purchase -->
        <li class="nav-item">
            <a class="nav-link collapsed  p-3 " href="#" data-toggle="collapse" data-target="#collapseCustomer" aria-expanded="true" aria-controls="collapseCustomer">
                <i class="fas fa-fw fa-cog"></i>
                <span>{{__('translate.Customer')}}</span>
            </a>
            <div id="collapseCustomer" class="collapse" aria-labelledby="headingPurchase" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
    
                    @can('Customer Page')
                    <a class="collapse-item" href="{{ route('customers.index') }}">{{__('translate.Customer')}} </a>
                    @endcan
                    @if( $GLOBALS['CurrentUser']->can('Customer Due Receive Page') && $GLOBALS['CurrentUser']->can('Allow Customer Due'))
                    <a class="collapse-item" href="{{ route('customer-due-receives.index') }}">{{__('translate.Due Receive List')}} </a>
                    @endif
                    
                    @if( $GLOBALS['CurrentUser']->can('Customer Due Receive Create Page') && $GLOBALS['CurrentUser']->can('Allow Customer Due'))
                    <a class="collapse-item" href="{{ route('customer-due-receives.create') }}">{{__('translate.Due Receive')}}  </a>
                    @endif
    
                </div>
            </div>
        </li>
        <!-- Divider -->
        @endif

        @if(  $GLOBALS['CurrentUser']->can('Supplier Page')  ||  ( $GLOBALS['CurrentUser']->can('Supplier Due Pay Page') && $GLOBALS['CurrentUser']->can('Allow Supplier Due'))  ||  ( $GLOBALS['CurrentUser']->can('Supplier Due Pay Create Page') && $GLOBALS['CurrentUser']->can('Allow Supplier Due')) )

        <hr class="sidebar-divider m-1 p-0 ">

        <!--purchase -->
        <li class="nav-item">
            <a class="nav-link collapsed  p-3 " href="#" data-toggle="collapse" data-target="#collapseSupplier" aria-expanded="true" aria-controls="collapseSupplier">
                <i class="fas fa-fw fa-cog"></i>
                <span>{{__('translate.Supplier')}}</span>
            </a>
            <div id="collapseSupplier" class="collapse" aria-labelledby="headingPurchase" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    @can('Supplier Page')
                    <a class="collapse-item" href="{{ route('suppliers.index') }}">{{__('translate.Supplier')}} </a>
                    @endcan

                    @if( $GLOBALS['CurrentUser']->can('Supplier Due Pay Page') && $GLOBALS['CurrentUser']->can('Allow Supplier Due'))
                    <a class="collapse-item" href="{{ route('supplier-due-pays.index') }}">{{__('translate.Due Pay List')}} </a>
                    @endif

                    @if( $GLOBALS['CurrentUser']->can('Supplier Due Pay Create Page') && $GLOBALS['CurrentUser']->can('Allow Supplier Due'))
                    
                    <a class="collapse-item" href="{{ route('supplier-due-pays.create') }}">{{__('translate.Due Pay')}}  </a>
                    @endif
    
                </div>
            </div>
        </li>
        @endif
    

    



    @if( $GLOBALS['CurrentUser']->can('Employee Page') || $GLOBALS['CurrentUser']->can('Designation Page') || $GLOBALS['CurrentUser']->can('Employee Salary Page') || $GLOBALS['CurrentUser']->can('Employee Payments Page') || $GLOBALS['CurrentUser']->can('Employee Payment Type Page') || $GLOBALS['CurrentUser']->can('Duty Create Page') || $GLOBALS['CurrentUser']->can('Duty Weekly Page') || $GLOBALS['CurrentUser']->can('Duty Monthly Page') || $GLOBALS['CurrentUser']->can('Duty Status Page') )
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
                @can('Employee Page')
                <a class="collapse-item" href="{{ route('employees.index') }}"> {{__('translate.All Employee')}}</a>
                @endcan
                @can('Designation Page')
                <a class="collapse-item" href="{{ route('designations.index') }}">{{__('translate.Designations')}}</a>
                @endcan
                @can('Employee Salary Page')
                <a class="collapse-item" href="{{ route('employee_salaries.index') }}">{{__('translate.Salary')}}</a>
                @endcan
                @can('Employee Payments Page')
                <a class="collapse-item" href="{{ route('employee_payments.index') }}">{{__('translate.Payments')}}</a>
                @endcan
                @can('Employee Payment Type Page')
                <a class="collapse-item" href="{{ route('employee_payment_types.index') }}">{{__('translate.Payment Type')}}</a>
                @endcan
                @can('Duty Create Page')
                <a class="collapse-item" href="{{ route('employee_duties.create') }}">{{__('translate.New Duty')}}</a>
                @endcan
                @can('Duty Weekly Page')
                <a class="collapse-item" href="{{ route('employee_duties.index') }}">{{__('translate.Weekly Duty')}}</a>
                @endcan
                @can('Duty Monthly Page')
                <a class="collapse-item" href="{{ route('employee_duties_monthly') }}">{{__('translate.Monthly Duty')}}</a>
                @endcan
                @can('Duty Status Page')
                <a class="collapse-item" href="{{ route('duty-statuses.index') }}">{{__('translate.Duty Status')}}</a>
                @endcan

            </div>
        </div>
    </li>
    @endif
    @can('Payment System Page')
    <!-- Divider -->
    <hr class="sidebar-divider m-1 p-0 ">

    <li class="nav-item">
        <a class="nav-link collapsed  p-3 " href="{{ route('payment_systems.index') }}"   aria-expanded="true" aria-controls="collapseStaff">
            <i class="fas fa-dollar-sign"></i>
            <span> {{__('translate.Payement Systems')}} </span>
        </a>

    </li>
    @endcan



    <!-- ///////////////////////////////////////////////////////////////////////////////////// -->
    @can('Analysis Page')
    <hr class="sidebar-divider m-1 p-0 ">

    <!-- Nav Item - Dashboard -->

    <li class="nav-item">
        <a class="nav-link collapsed  p-3 " href="#" data-toggle="collapse" data-target="#collapseAnalysis" aria-expanded="true" aria-controls="collapseExpenses">
            <i class="fas fa-chart-line"></i>
            <span>{{__('translate.Analysis')}} </span>
        </a>
        <div id="collapseAnalysis" class="collapse" aria-labelledby="headingExpenses" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">

                <a class="collapse-item" href="{{ route('analysis') }}">{{ __('translate.Analysis') }} </a>

            </div>
        </div>
    </li>
    @endcan

    @if( $GLOBALS['CurrentUser']->can('Expense Page') || $GLOBALS['CurrentUser']->can('Expense Monthly Page') || $GLOBALS['CurrentUser']->can('Expense Type Page') )

    <hr class="sidebar-divider m-1 p-0 ">

    <!-- Nav Item - Dashboard -->

    <li class="nav-item">
        <a class="nav-link collapsed  p-3 " href="#" data-toggle="collapse" data-target="#collapseExpenses" aria-expanded="true" aria-controls="collapseExpenses">
            <i class="fas fa-clipboard-list"></i>
            <span>{{__('translate.Expense')}} </span>
        </a>
        <div id="collapseExpenses" class="collapse" aria-labelledby="headingExpenses" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">


                @can('Expense Page')
                <a class="collapse-item" href="{{ route('expenses.index') }}">{{__('translate.Daily')}}</a>
                @endcan
                @can('Expense Monthly Page')
                <a class="collapse-item" href="{{ route('expense-monthlies.index') }}">{{__('translate.Monthly')}}</a>
                @endcan
                @can('Expense Type Page')
                <a class="collapse-item" href="{{ route('expense-types.index') }}">{{__('translate.Expense Type')}}</a>
                @endcan

            </div>
        </div>
    </li>
    @endif 

    {{-- <hr class="sidebar-divider m-1 p-0 ">
    <li class="nav-item">
        <a class="nav-link collapsed  p-3 " href="#" data-toggle="collapse" data-target="#collapseRating" aria-expanded="true" aria-controls="collapseSell">
            <i class="fas fa-chart-bar"></i>
            <span>{{__('translate.Rating') }}</span>
        </a>
        <div id="collapseRating" class="collapse" aria-labelledby="headingSell" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">

                <a class="collapse-item" href="{{ route('customer_ratings.index') }}">{{__('translate.Customer Ratings')}} </a></a>
          
            </div> 
        </div>
    </li> --}}

    @can('Goal Page')
    <!-- Divider -->
    <hr class="sidebar-divider m-1 p-0 ">
    <!-- Nav Item - Dashboard -->
    <li class="nav-item  ">
        <a class="nav-link p-3 " href="{{ route('goals.index') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>{{__('translate.Goal')}}</span></a>
    </li>
    @endcan

    @if( $GLOBALS['CurrentUser']->can('User Page') || $GLOBALS['CurrentUser']->can('User Role Page'))
       <!-- Divider -->
       <hr class="sidebar-divider m-1 p-0 ">
       <!-- Nav Item - Dashboard -->
   
   
       <li class="nav-item">
           <a class="nav-link collapsed  p-3 " href="#" data-toggle="collapse" data-target="#collapsepermission" aria-expanded="true" aria-controls="collapseExpenses">
               <i class="fas fa-clipboard-list"></i>
               <span>{{__('translate.User Management')}} </span>
           </a>
           <div id="collapsepermission" class="collapse" aria-labelledby="headingExpenses" data-parent="#accordionSidebar">
               <div class="bg-white py-2 collapse-inner rounded">
   
                    @can('User Page')
                   <a class="collapse-item" href="{{ route('users.index') }}">{{__('translate.Users')}}</a>
                   @endcan
                   @can('User Role Page')
                   <a class="collapse-item" href="{{ route('user-roles.index') }}">{{__('translate.Role')}}</a>
                   {{-- <a class="collapse-item" href="{{ route('permission-role.index') }}">{{__('translate.Role')}}</a> --}}
                    @endcan
               </div>
           </div>
       </li>
       @endif 
   
       @can('Pos Setting Page')
       

    <hr class="sidebar-divider m-1 p-0 ">

    <li class="nav-item">
        <a class="nav-link collapsed  p-3 " href="{{ route('pos-setting.index') }}"   aria-expanded="true" aria-controls="collapseStaff">
            <i class="fas fa-dollar-sign"></i>
            <span> {{__('translate.Setting')}} </span>
        </a>

    </li>
    @endcan









    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center  d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>



</ul>
<!-- End of Sidebar -->