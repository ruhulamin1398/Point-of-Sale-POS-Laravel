@extends('includes.app')


@section('content')



<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">

        <div class="card-header py-3  bg-abasas-dark ">
            <nav class="navbar navbar-dark">
                <a class="navbar-brand text-light">{{ __("translate.Purchase List") }}  ( {{ $month }} ) </a>

                <div>
                    <form method="get">
                        <div class="form-row align-items-center">
                            <div class="col-auto"> {{ __("translate.Select A Month") }}</div>
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
                <table class="table table-striped table-bordered" id="purchaseTable" width="100%" cellspacing="0">
                    <thead class="bg-abasas-dark">


                        <tr>
                            <th>#</th>
                            <th>{{ __("translate.Purchase No") }}  </th>
                            <th>{{ __("translate.Supplier") }}</th>
                            <th>{{ __("translate.Total") }}</th>
                            <th>{{ __("translate.Time") }}</th>
                            <th>{{ __("translate.Action") }} </th>
                        </tr>
                    </thead>
                    <tfoot class="bg-abasas-dark">
                        <tr>
                            <th>#</th>
                            <th>{{ __("translate.Purchase No") }}  </th>
                            <th>{{ __("translate.Supplier") }}</th>
                            <th>{{ __("translate.Total") }}</th>
                            <th>{{ __("translate.Time") }}</th>
                            <th>{{ __("translate.Action") }} </th>
                        </tr>

                    </tfoot>
                    <tbody>

                        <?php $i = 1; ?>
                        @foreach ($purchases as $purchase )

                        <tr class="data-row">
                            <td>{{$i++}}</td>
                            <td>{{$purchase->id}}</td>
                            <td>{{$purchase->supplier->name}}</td>
                            <td>{{$purchase->total}}</td>


                            <td>{{ $purchase->created_at->format('d M,Y h:i:a')}}</td>


                            <td class="align-middle"> {{-- {{ route('purchase-receipt-show', ['id' => $purchase->id] ) }} --}}
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


<script>
    $(document).ready(function () {

        $('#purchaseTable').DataTable({
            dom: 'lBfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });

    })

</script>




@endsection
