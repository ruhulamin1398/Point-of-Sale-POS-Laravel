@extends('includes.app')


@section('content')




<!-- Begin Page Content -->
<div style="display: none;" id="employeePaymentInputForm">
    <div class="card mb-4 shadow">

        <div class="card-header py-3  bg-abasas-dark ">
            <nav class="navbar navbar-dark">
                <a class="navbar-brand text-light">{{ __('translate.New Payment') }} </a>
            </nav>
        </div>
        <div class="card-body">
            <form method="POST" action="{{route('employee_payments.store')}}">
                @csrf
                <div class="form-row align-items-center">

                    <div class="col-md-4 col-sm-12  pr-4">
                        <label for="employee_id">{{ __('translate.Select Employee') }}<span style="color: red"> *</span></label>
                        <select class="form-control form-control" value="1" name="employee_id" id="employee_id"
                            required>
                            <option disabled selected value> -- select an option -- </option>
                            @foreach ($employees as $employee)
                            

                            <option value="{{$employee->id}}"> {{$employee->name}}</option>
                           
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4 col-sm-12  pr-4">
                        <label for="employee_payment_type_id">{{ __('translate.Select Payment Type') }}<span style="color: red"> *</span></label>
                        <select class="form-control form-control" value="" name="employee_payment_type_id"
                            id="employeePaymentTypeId" required>

                            <option disabled selected value> -- select an option -- </option>
                            @foreach ($payment_types as $paymentType)
                            
                            <option value="{{$paymentType->id}}"> {{$paymentType->name}}</option>
                           
                            @endforeach
                        </select>
                    </div>


                    <div class="col-md-4 col-sm-12  pr-4" id="employeePaymentStatus">
                        <label for="employee_payment_type_id">{{ __('translate.Payment Status') }}<span style="color: red"> *</span> </label>
                        <select class="form-control form-control" value="" name="salary_status_id" required>

                            <option disabled selected value> -- select an option -- </option>
                            @foreach ($salary_status as $status)
                    

                            <option value="{{$status->id}}"> {{$status->name}}</option>
                            
                            @endforeach
                        </select>
                    </div>


                    <div class="col-md-4 col-sm-12  pr-4">
                        <label for="amount">{{ __('translate.Amount') }}<span style="color: red"> *</span></label>
                        <input type="number" step="any" name="amount" class="form-control mb-2" required>
                    </div>

                    <div class="col-md-4 col-sm-12  pr-4">
                        <label for="month">{{ __('translate.Select Month') }}<span style="color: red"> *</span></label>
                        <input type="month" name="month" class="form-control mb-2" required>
                    </div>


                    <div class="col-md-4 col-sm-12  pr-4">

                        <label for="Comment">{{ __('translate.Comment') }}</label>
                        <textarea class="form-control mb-2" name="Comment" rows="2"></textarea>
                    </div>



                    <div class="col-md-4 col-sm-12  ">
                        <button type="submit" class="btn bg-abasas-dark mt-3">{{ __('translate.Submit') }}</button>
                    </div>

                </div>

            </form>
        </div>
    </div>
</div>





<x-data-table :dataArray="$dataArray" />

<script>
    $(document).ready(function () {


      //  $('.dataDeleteItemClass').hide();

        $('#createNewForm').hide().removeClass("collapse");


        $('body').on('click', '#AddNewFormButton', function () {
            $('#employeePaymentInputForm').toggle();

        });

        // input hide and show
        $('#employeePaymentTypeId').on('input', function () {
            if ($(this).val() == 1) {
                $('#employeePaymentStatus').show();
            } else {
                $('#employeePaymentStatus').hide();
            }
        });



        //search bar 
       var html= '<div> <nav class="navbar  "><div class="navbar-brand"> {{ __("translate.Month") }} : {{ $month }}</div>  <div ><form method="get" ><div class="form-row align-items-center"><div class="col-auto">{{ __("translate.Select A Month") }}</div> <div class="col-auto"> <input type="month" name="month"  class="form-control mb-2" id="monthFormInput" required>  </div> <div class="col-auto">  <button type="submit" class="btn btn-primary mt-3"  >{{ __("translate.Submit") }}</button>   </div> </div></form></div></nav></div>';
        $('#AddNewFormButtonDiv').parent().parent().append(html);










    });

</script>



@endsection
