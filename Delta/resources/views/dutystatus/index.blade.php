
@extends('includes.app')


@section('content')


{{$dutyStatus}}



<!-- Begin Page Content -->
<div class="collapse" id="NewEmployorm">
    <div class="card mb-4 shadow">

        <div class="card-header py-3  bg-abasas-dark ">
            <nav class="navbar navbar-dark">
                <a class="navbar-brand text-light">নতুন কর্মচারী</a>
            </nav>
        </div>
        <div class="card-body">
            <form method="POST" action="{{route('duty_status.store')}}">
                @csrf
                <div class="form-row align-items-center">
                    <div class="col-auto">
                        <span class="text-dark pl-4"> কর্মচারীর নাম</span>
                        <input type="text" name="name" class="form-control mb-2">
                    </div>
                    <div class="col-auto">

                        <span class="text-dark pl-4">নাম্বার</span>
                        <input type="number" name="phone" class="form-control mb-2">
                    </div>
                    <div class="col-auto">

                        <span class="text-dark pl-2"> ঠিকানা</span>
                        <input type="text" name="address" class="form-control mb-2">
                    </div>

                    <div class="col-auto">

                        <span class="text-dark pl-2"> বেতন</span>
                        <input type="number" name="salary" class="form-control mb-2">
                    </div>

                    <div class="col-auto">
                        <span class="text-dark pl-2"> Join</span>
                        <input type="date" name="joining_date" class="form-control mb-2">
                    </div>
                    <div class="col-auto">
                        <span class="text-dark pl-2"> Contract</span>
                        <input type="date" name="term_of_contract" class="form-control mb-2">
                    </div>
                    <div class="col-auto">
                        <span class="text-dark pl-2"> Reference</span>
                        <input type="text" name="reference" class="form-control mb-2">
                    </div>





                    <div class="col-auto">
                        <button type="submit" class="btn bg-abasas-dark mt-3">সাবমিট</button>
                    </div>

                </div>

            </form>
        </div>
    </div>
</div>



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