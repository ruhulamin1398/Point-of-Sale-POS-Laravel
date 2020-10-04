@extends('includes.app')


@section('content')




<!-- Begin Page Content -->
<div class="collapse" id="NewEmployorm">
    <div class="card mb-4 shadow">

        <div class="card-header py-3  bg-abasas-dark ">
            <nav class="navbar navbar-dark">
                <a class="navbar-brand text-light">নতুন পেমেন্ট </a>
            </nav>
        </div>
        <div class="card-body">
            <form method="POST" action="{{route('employee_payments.store')}}">
                @csrf
                <div class="form-row align-items-center">

                    <div class="col-auto pr-4">
                    <label for="employee_id">Name</label>
                        <select class="form-control form-control" value="" name="employee_id" id="designation" required>
                            <option selected="selected">Select Employee </option>
                            @foreach ($employees as $employee)
                            <option value="{{$employee->id}}"> {{$employee->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-auto pr-4">
                    <label for="employee_payment_type_id">Payment Type</label>
                        <select class="form-control form-control" value="" name="employee_payment_type_id" id="designation" required>
                            <option selected="selected">Select Payment Type </option>
                            @foreach ($payment_types as $paymentType)
                            <option value="{{$paymentType->id}}"> {{$paymentType->name}}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="col-auto pr-4">
                    <label for="employee_payment_type_id"> Payment Status</label>
                        <select class="form-control form-control" value="" name="salary_status_id" required>
                            <option selected="selected">Select Payment Status </option>
                            @foreach ($salary_status as $status)
                            <option value="{{$status->id}}"> {{$status->name}}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="col-auto pr-4">
                    <label for="amount">Amount</label>
                        <input type="number" step="any" name="amount" class="form-control mb-2">
                    </div>


                    <div class="col-auto pr-4">

                    <label for="Comment">Comment</label>
                        <textarea class="form-control mb-2" name="Comment" rows="2"></textarea>
                    </div>



                    <div class="col-auto ">
                        <button type="submit" class="btn bg-abasas-dark mt-3">সাবমিট</button>
                    </div>

                </div>

            </form>
        </div>
    </div>
</div>





<x-data-table :fieldList="$fieldList" :items="$items" :routes="$routes" :componentDetails="$componentDetails" />



<script>
    $(document).ready(function() {

        $('body').on('click', '#PlusButton', function() {



            if ($(this).hasClass('fa-plus')) {
                $(this).removeClass('fa-plus');
                $(this).addClass('fa-minus');


            } else {
                $(this).removeClass('fa-minus');
                $(this).addClass('fa-plus');

            }



        });

    });
</script>



@endsection