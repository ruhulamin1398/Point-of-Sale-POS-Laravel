@extends('includes.app')


@section('content')




<!-- Begin Page Content -->
<div style="display: none;" id="employeePaymentInputForm">
    <div class="card mb-4 shadow">

        <div class="card-header py-3  bg-abasas-dark ">
            <nav class="navbar navbar-dark">
                <a class="navbar-brand text-light">New Payment </a>
            </nav>
        </div>
        <div class="card-body">
            <form method="POST" action="{{route('employee_payments.store')}}">
                @csrf
                <div class="form-row align-items-center">

                    <div class="col-auto pr-4">
                        <label for="employee_id">Select Employee</label>
                        <select class="form-control form-control" value="1" name="employee_id" id="employee_id"
                            required>

                            @foreach ($employees as $employee)
                            @if($loop->first)

                            <option value="{{$employee->id}}" selected="selected"> {{$employee->name}}</option>
                            @else

                            <option value="{{$employee->id}}"> {{$employee->name}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="col-auto pr-4">
                        <label for="employee_payment_type_id">Select Payment Type</label>
                        <select class="form-control form-control" value="" name="employee_payment_type_id"
                            id="employeePaymentTypeId" required>
                            @foreach ($payment_types as $paymentType)
                            @if($loop->first)
                            <option value="{{$paymentType->id}}" selected="selected"> {{$paymentType->name}}</option>
                            @else
                            <option value="{{$paymentType->id}}"> {{$paymentType->name}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>


                    <div class="col-auto pr-4" id="employeePaymentStatus">
                        <label for="employee_payment_type_id"> Payment Status</label>
                        <select class="form-control form-control" value="" name="salary_status_id" required>
                            @foreach ($salary_status as $status)
                            @if($loop->last)
                            <option value="{{$status->id}}" selected="selected"> {{$status->name}}</option>
                            @else
                            <option value="{{$status->id}}"> {{$status->name}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>


                    <div class="col-auto pr-4">
                        <label for="amount">Amount</label>
                        <input type="number" step="any" name="amount" class="form-control mb-2" required>
                    </div>

                    <div class="col-auto pr-4">
                        <label for="month">Select Month</label>
                        <input type="month" name="month" class="form-control mb-2" required>
                    </div>


                    <div class="col-auto pr-4">

                        <label for="Comment">Comment</label>
                        <textarea class="form-control mb-2" name="Comment" rows="2"></textarea>
                    </div>



                    <div class="col-auto ">
                        <button type="submit" class="btn bg-abasas-dark mt-3">Submit</button>
                    </div>

                </div>

            </form>
        </div>
    </div>
</div>





<x-data-table :dataArray="$dataArray" />

<script>
    $(document).ready(function () {


        $('.dataDeleteItemClass').hide();

        $('#createNewForm').hide().removeClass("collapse");

        // $('body').on('click', '#AddNewFormButton', function () {
        //     $('#PlusButton').toggleClass('fa-plus').toggleClass('fa-minus');

        // });

        $('body').on('click', '#AddNewFormButton', function () {
            $('#employeePaymentInputForm').toggle();

        });


        $('#employeePaymentTypeId').on('input', function () {
            if ($(this).val() == 1) {
                $('#employeePaymentStatus').show();
            } else {
                $('#employeePaymentStatus').hide();
            }
        });










    });

</script>



@endsection
