
@extends('includes.app')


@section('content')




<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

  <!-- Main Content -->
  <div id="content">


    <!-- Begin Page Content -->
    <div class="container-fluid">

      <!-- Page Heading -->
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
      </div>

      <!-- Content Row -->
      <div class="row">

        <!-- Growth Card Example -->
        <div class="col-xl-3 col-md-6 mb-4 text-center topCard">
          <div class="card border-left-primary shadow  py-4">
            <div class="card-img-top ">
              <i class="fas fa-calendar fa-2x text-info"></i>
            </div>
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">{{ __('translate.Customer') }}</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $customers }}</div>
                </div>

              </div>
            </div>
          </div>
        </div>

        <!--Today order  Card Example -->
        <div class="col-xl-3 col-md-6 mb-4 text-center vtopCard">
          <div class="card border-left-success shadow  py-4">
            <div class="card-img-top ">
              <i class="fas fa-calendar fa-2x text-info"></i>
            </div>
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">{{ __('translate.Supplier') }}</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $suppliers }}</div>
                </div>

              </div>
            </div>
          </div>
        </div>

        <!-- Today item selll Card Example -->
        <div class="col-xl-3 col-md-6 mb-4 text-center topCard">
          <div class="card border-left-info shadow  py-4">
            <div class="card-img-top ">
              <i class="fas fa-calendar fa-2x text-info"></i>
            </div>
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">{{ __('translate.Orders') }}  </div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $orders }}</div>
                </div>

              </div>
            </div>
          </div>
        </div>

        <!-- Today sell Amount Card Example -->
        <div class="col-xl-3 col-md-6 mb-4 text-center topCard">
          <div class="card border-left-info shadow  py-4">
            <div class="card-img-top ">
              <i class="fas fa-calendar fa-2x text-info"></i>
            </div>
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"> {{ __('translate.Products') }}</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $products }}</div>
                </div>

              </div>
            </div>
          </div>
        </div>

        <!-- Content Row -->

        <div class="row ">
          <div class="col-xl-8 col-lg-7 ">
            <!-- 1111111111111111111111111111111111111111111111111111 -->
            <div class="row ">
              <!-- Growth Card Example -->
              <div class="col-xl-4 col-md-6 mb-4  text-center  ">
                <div class="card border-none   p-4">
                  <div class="card-img-top ">
                    <a href="{{ route('orders.create') }}"> <i class="fas fa-hand-pointer fa-2x  text-info "></i></a>
                  </div>
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"> <a href="{{ route('orders.create') }}">{{ __('translate.Order') }} </a> </div>
                      </div>


                    </div>
                  </div>
                </div>
              </div>


              
              <!-- Growth Card Example -->
              <div class="col-xl-4 col-md-6 mb-4  text-center  ">
                <div class="card border-none   p-4">
                  <div class="card-img-top ">
                    <a href="{{ route('purchases.index') }}"> <i class="fas fa-shopping-cart fa-2x  text-info "></i></a>
                  </div>
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"> <a href="{{ route('purchases.index') }}">{{ __('translate.Purchase') }} </a> </div>
                      </div>


                    </div>
                  </div>
                </div>
              </div>


              

              <!-- Growth Card Example -->
              <div class="col-xl-4 col-md-6 mb-4  text-center  ">
                <div class="card border-none   p-4">
                  <div class="card-img-top ">
                    <a href="{{ route('products.index') }}"> <i class="fas fa-shopping-bag fa-2x  text-info "></i></a>
                  </div>
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"> <a href="{{ route('products.index') }}"> {{ __('translate.Products') }}</a> </div>
                      </div>


                    </div>
                  </div>
                </div>
              </div>


              <!-- Growth Card Example -->
              <div class="col-xl-4 col-md-6 mb-4  text-center  ">
                <div class="card border-none   p-4">
                  <div class="card-img-top ">
                    <a href="{{ route('return-from-customers.create') }}"> <i class="fas fa-dollar-sign fa-2x  text-info "></i></a>
                  </div>
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"> <a href="{{ route('return-from-customers.create') }}"> {{ __('translate.Return Product (Customer)') }} </a> </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Growth Card Example -->
              <div class="col-xl-4 col-md-6 mb-4  text-center  ">
                <div class="card border-none   p-4">
                  <div class="card-img-top ">
                    <a href="{{ route('return-to-suppliers.create') }}"> <i class="fas fa-dollar-sign fa-2x  text-info "></i></a>
                  </div>
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"> <a href="{{ route('return-to-suppliers.create') }}">{{ __('translate.Return Product (Supplier)') }}  </a> </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>


              <!-- Growth Card Example -->
              <div class="col-xl-4 col-md-6 mb-4  text-center  ">
                <div class="card border-none   p-4">
                  <div class="card-img-top ">
                    <a href="{{ route('drop_products.create') }}"> <i class="fas fa-calendar fa-2x  text-info "></i></a>
                  </div>
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"> <a href="{{ route('drop_products.create') }}">{{ __('translate.Drop Product') }} </a> </div>
                      </div>


                    </div>
                  </div>
                </div>
              </div>
              




              
              <!-- Growth Card Example -->
              <div class="col-xl-4 col-md-6 mb-4  text-center  ">
                <div class="card border-none   p-4">
                  <div class="card-img-top ">
                    <a href="{{ route('suppliers.index') }}"> <i class="fas fa-people-carry fa-2x  text-info "></i></a>
                  </div>
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"> <a href="{{ route('suppliers.index') }}">{{ __('translate.Suppliers') }} </a> </div>
                      </div>


                    </div>
                  </div>
                </div>
              </div>
              

              
               <!-- Growth Card Example -->
               <div class="col-xl-4 col-md-6 mb-4  text-center  ">
                <div class="card border-none   p-4">
                  <div class="card-img-top ">
                    <a href="{{ route('customers.index') }}"> <i class="fas fa-user fa-2x  text-info "></i></a>
                  </div>
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"> <a href="{{ route('customers.index') }}">{{ __('translate.Customers') }} </a> </div>
                      </div>


                    </div>
                  </div>
                </div>
              </div>


              <!-- Growth Card Example -->
              <div class="col-xl-4 col-md-6 mb-4  text-center  ">
                <div class="card border-none   p-4">
                  <div class="card-img-top ">
                    <a href="{{ route('expenses.index') }}"> <i class="fas fa-hand-holding-usd fa-2x  text-info "></i></a>
                  </div>
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"> <a href="{{ route('expenses.index') }}">{{ __('translate.Expense') }} </a> </div>
                      </div>


                    </div>
                  </div>
                </div>
              </div>









            </div>

          </div>



          <!-- Pie Chart -->
          <div class="col-xl-4 col-lg-5">





            <!-- Project Card Example -->
            <div class="card shadow mb-4">

               <div class="card-body">

                <h4 class="small font-weight-bold">{{ __('translate.Daily Target') }}<span class="float-right">{{(int)$goal->daily}}%</span></h4>
                <div class="progress mb-4">
                  <div class="progress-bar bg-secondary" role="progressbar" style="width: {{$goal->daily}}%" aria-valuenow="{{$goal->daily}}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <h4 class="small font-weight-bold">{{ __('translate.Weekly Target') }} <span class="float-right">{{(int)$goal->weekly}}%</span></h4>
                <div class="progress mb-4">
                  <div class="progress-bar" role="progressbar" style="width: {{$goal->weekly}}%" aria-valuenow="{{$goal->weekly}}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <h4 class="small font-weight-bold">{{ __('translate.Monthly Target') }} <span class="float-right">{{(int)$goal->monthly}}%</span></h4>
                <div class="progress mb-4">
                  <div class="progress-bar bg-info" role="progressbar" style="width: {{$goal->monthly}}%" aria-valuenow="{{$goal->monthly}}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <h4 class="small font-weight-bold">{{ __('translate.Yearly Target') }} <span class="float-right"> {{(int)$goal->yearly}}%</span></h4>
                <div class="progress">
                  <div class="progress-bar bg-success" role="progressbar" style="width: {{$goal->yearly}}%" aria-valuenow=" {{$goal->yearly}}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div> 




            </div>


            <!-- It firm info -->
              <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-abasas-dark">
                <h6 class="m-0 font-weight-bold ">Developed By</h6>
              </div>
              <div class="card-body text-center">
                <img src="{{asset('image/abasas-logo.png')}}" height="50px" alt="Abasas Logo">
                <div class="text-dark font-weight-bold "> <i class="fas fa-phone fa-sm fa-fw mr-2 text-success-400  "></i> 01798142111</div>
               <a href="http://abasas.tech" target="_blank"> <div class="text-dark font-weight-bold ">http://abasas.tech</div> </a>
              </div>
            </div>
          </div>
        </div>

        <!-- Content Row -->



      </div>

    </div>
    <!-- /.container-fluid -->

  </div>
  <!-- End of Main Content -->


</div>
<!-- End of Content Wrapper -->


<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
  <i class="fas fa-angle-up"></i>
</a>







@endsection



