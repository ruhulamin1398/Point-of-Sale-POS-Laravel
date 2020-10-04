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

                <div class="col-auto">
                <span class="text-dark pl-4"> Name</span>
                        <select class="form-control form-control" value="" name="employee_id" id="designation" required>
                            <option selected="selected">Select Employee </option>
                            @foreach ($employees as $employee)
                            <option value="{{$employee->id}}"> {{$employee->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-auto">
                    <span class="text-dark pl-4"> Payment Type</span>
                        <select class="form-control form-control" value="" name="employee_payment_type_id" id="designation" required>
                            <option selected="selected">Select Payment Type </option>
                            @foreach ($paymentTypes as $paymentType)
                            <option value="{{$paymentType->id}}"> {{$paymentType->name}}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="col-auto">
                        <span class="text-dark pl-4"> Amount</span>
                        <input type="number" step="any" name="amount" class="form-control mb-2">
                    </div>


                    <div class="col-auto">

                        <span class="text-dark pl-4">Comment</span>
                        <input type="text" name="Comment" class="form-control mb-2">
                    </div>



                    <div class="col-auto">
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