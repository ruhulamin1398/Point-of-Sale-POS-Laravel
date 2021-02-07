@extends('includes.app')


@section('content')



<div class="container-fluid  p-0">
    <div class="card mb-4 shadow">

        <div class="card-header py-3 bg-abasas-dark">
            <nav class="navbar navbar-dark ">
                <a class="navbar-brand">{{ __('translate.Analysis') }}@can('Super Admin') <i class="fas fa-tools pl-2"
                    id="pageSetting" data-toggle="modal" data-target="#setting-modal"></i> @endcan</a>
            </nav>
        </div>
        <div class="card-body">
            <div class="row">


                <!-- Growth Card Example -->
                <div class="col-xl-3 col-md-6 mb-4 text-center topCard">
                    <div class="card border-left-primary shadow h-100 py-4">

                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        {{ __('translate.Todays Sell') }}
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $data['sell'] }}</div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>


                <!-- Growth Card Example -->
                <div class="col-xl-3 col-md-6 mb-4 text-center topCard">
                    <div class="card border-left-primary shadow h-100 py-4">

                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        {{ __('translate.Todays Buy') }}
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $data['buy'] }}</div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>


                <!-- Growth Card Example -->
                <div class="col-xl-3 col-md-6 mb-4 text-center topCard">
                    <div class="card border-left-primary shadow h-100 py-4">

                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        {{ __('translate.Todays Sell Profit') }}
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $data['sellProfit'] }}</div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>


                <!-- Growth Card Example -->
                <div class="col-xl-3 col-md-6 mb-4 text-center topCard">
                    <div class="card border-left-primary shadow h-100 py-4">

                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        {{ __('translate.Todays Profit') }}
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $data['profit'] }}</div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>





                <!-- Growth Card Example -->
                <div class="col-xl-3 col-md-6 mb-4 text-center topCard">
                    <div class="card border-left-primary shadow h-100 py-4">

                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        {{ __('translate.Todays Expese') }}
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $data['expense'] }}</div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>


                <!-- Growth Card Example -->
                <div class="col-xl-3 col-md-6 mb-4 text-center topCard">
                    <div class="card border-left-primary shadow h-100 py-4">

                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        {{ __('translate.Todays Payment') }}
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $data['payment'] }}</div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>



                <!-- Growth Card Example -->
                <div class="col-xl-3 col-md-6 mb-4 text-center topCard">
                    <div class="card border-left-primary shadow h-100 py-4">

                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        {{ __('translate.Todays Sell Count') }}
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $data['sellCount'] }}</div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>


                <!-- Growth Card Example -->
                <div class="col-xl-3 col-md-6 mb-4 text-center topCard">
                    <div class="card border-left-primary shadow h-100 py-4">

                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        {{ __('translate.Todays Buy Count') }}
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $data['buyCount'] }}</div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>






            </div>

            <div class="row">
                <div class="col-12 col-md-6">
                    <x-bar-chart :dataArray="$data['sellAnalysisDaily']" id='sellAnalysisDailyBar' />
                </div>
                <div class="col-12 col-md-6">
                    <x-line-chart :dataArray="$data['sellAnalysisDaily']" id='sellAnalysisDailyLine' />

                </div>
                <div class="col-12 col-md-6">
                    <x-bar-chart :dataArray="$data['sellAnalysisMonthly']" id='sellAnalysisMonthlyBar' />

                </div>
                <div class="col-12 col-md-6">
                    <x-line-chart :dataArray="$data['sellAnalysisMonthly']" id='sellAnalysisMonthlyLine' />

                </div>
                <div class="col-12 col-md-6">
                    <x-bar-chart :dataArray="$data['amountAnalysisDaily']" id='amountAnalysisDailyBar' />

                </div>
                <div class="col-12 col-md-6">

                    <x-line-chart :dataArray="$data['amountAnalysisDaily']" id='amountAnalysisDailyLine' />

                </div>
                <div class="col-12 col-md-6">
                    <x-bar-chart :dataArray="$data['amountAnalysisMonthly']" id='amountAnalysisMonthlyBar' />


                </div>
                <div class="col-12 col-md-6">
                    <x-line-chart :dataArray="$data['amountAnalysisMonthly']" id='amountAnalysisMonthlyLine' />

                </div>
            </div>

        </div>

    </div>

</div>







@can('Super Admin')

 <!-- Attachment Modal -->
 <div class="modal fade" id="setting-modal" tabindex="-1" role="dialog" aria-labelledby="setting-modal-label"
     aria-hidden="true">
     <div class="modal-dialog modal-lg" role="document">
         <div class="modal-content">
             <div class="modal-header bg-abasas-dark">

                <nav class="navbar navbar-light  ">
                    <a class="navbar-brand">{{__('translate.Permission')}}</a>
    
                </nav>
                
            <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;</span>
            </button>

             </div>
             <form action="{{ route('rolepermissionstore') }}" method="post">
                @csrf
                <input type="text" name="page_name" value="Analysis" required hidden>
             <div class="modal-body" >


                
                <div class="table-responsive">
                    <table class="table table-striped table-bordered"  width="100%"
                        cellspacing="0">
                        <thead class="bg-abasas-dark">

                            <tr>

                                <th>{{ __('translate.Permission') }} </th>

                                @for ($i=1 ; $i<5 ; $i++) <th>{{ $roles[$i]->name }}</th>
                                    @endfor
                            </tr>
                        </thead>


                        <tbody>


                            @php
                            $permision_name = "Analysis Page";
                            @endphp
                            
                            <tr class="data-row">
                                <td class="iteration">{{ __('translate.Page Access') }}</td>
                                @for ($i=1 ; $i<5 ; $i++) <td
                                    class="word-break name justify-content-center">
                                    <label class="checkbox-inline"><input type="checkbox"
                                            name="page{{ $i }}"
                                            @if($roles[$i]->hasPermissionTo($permision_name)) checked
                                        @endif></label>
                                    </td>
                                    @endfor

                            </tr>

                        </tbody>



                    </table>
                </div>

             </div>

             <div class="modal-footer">
                <button type="submit"
                                 class="btn bg-abasas-dark btn-block form-control  ">{{ __('translate.Save')  }}</button>
            </div>
             </form>
         </div>
     </div>
 </div>


@endcan




@endsection
