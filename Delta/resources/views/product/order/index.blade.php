@extends('includes.app')


@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ __('translate.'.$error) }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session()->has('success'))
<div class="alert alert-success">
    @if(is_array(session('success')))
        <ul>
            @foreach (session('success') as $message)
                <li>{{  __('translate.'.$message) }}</li>
            @endforeach
        </ul>
    @else
        {{ session('success') }}
    @endif
</div>
@endif


<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">

        <div class="card-header py-3  bg-abasas-dark ">
            <nav class="navbar navbar-dark">
                <a class="navbar-brand text-light"> {{ __("translate.Sell List") }} ( {{ $month }} ) @can('Super Admin') <i class="fas fa-tools pl-2"
                    id="pageSetting" data-toggle="modal" data-target="#setting-modal"></i> @endcan </a>

                <div>
                    <form method="get">
                        <div class="form-row align-items-center">
                            <div class="col-auto"> {{ __("translate.Select A Month") }} </div>
                            <div class="col-auto"> <input type="month" name="month" class="form-control mb-2"
                                    id="inlineFormInput" required>
                            </div>
                            <div class="col-auto"> <button type="submit" class="btn btn-primary mt-3">{{ __("translate.Submit") }}</button>
                            </div>
                        </div>
                    </form>
                </div>

            </nav>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="orderTable" width="100%" cellspacing="0">
                    <thead class="bg-abasas-dark">


                        <tr>
                            <th>#</th>
                            <th> {{ __("translate.Sell No") }} </th>
                            <th>{{ __("translate.Customer") }}</th>
                            <th>{{ __("translate.Total") }}</th>
                            <th>{{ __("translate.Time") }}</th>
                            <th> {{ __("translate.Action") }}</th>
                        </tr>
                    </thead>
                    <tfoot class="bg-abasas-dark">
                        <tr>
                            <th>#</th>
                            <th> {{ __("translate.Sell No") }} </th>
                            <th>{{ __("translate.Customer") }}</th>
                            <th>{{ __("translate.Total") }}</th>
                            <th>{{ __("translate.Time") }}</th>
                            <th> {{ __("translate.Action") }}</th>
                        </tr>

                    </tfoot>
                    <tbody>

                        <?php $i = 1; ?>
                        @foreach ($orders as $order )

                        <tr class="data-row">
                            <td>{{$i++}}</td>
                            <td>{{$order->id}}</td>
                            <td>{{$order->customer->name}}</td>
                            <td>{{$order->total}}</td>


                            <td>{{ $order->created_at->format('d M,Y h:i:a')}}</td>


                            <td class="align-middle"> {{-- {{ route('order-receipt-show', ['id' => $order->id] ) }} --}}
                                <a href="#"> <button type="button" class="btn btn-success" id="edit-item"> <i
                                            class="fa fa-eye" aria-hidden="false"> </i></button></a>
                            </td>

                        </tr>
                        @endforeach

                    </tbody>
                </table>
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
                <input type="text" name="page_name" value="Order" required hidden>
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
                            $permision_name = "Order Page";
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


<script>
    $(document).ready(function () {

        $('#orderTable').DataTable({
            dom: 'lBfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });

    })

</script>




@endsection
