@extends('includes.app')

@section('content')


@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{  __('translate.'.$error) }}</li>
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
    <div class="card shadow mb-4 ml-0 mr-0">
        <div class="card-header py-3 bg-abasas-dark">
            <nav class="navbar navbar-dark ">
                <a class="navbar-brand">{{ __("translate.Goal") }}</a>

            </nav>
        </div>
        <div class="card-body">
            
            <form method="POST" id="goal-update-form" action="{{ route('goals.update',1) }}">
                @csrf
                @method('put')
                <div class="row">
                    <div class="form-group col-12 col-md-3 ">
                        <label for="daily">{{ __("translate.Daily Target") }}</label>
                        <input type="number" step="any" name="daily" id="daily" class="form-control" min=0  value="{{ $goal->daily }}">

                    </div>
                    <div class="form-group col-12 col-md-3 ">
                        <label for="weekly">{{ __("translate.Weekly Target") }}</label>
                        <input type="number" step="any" name="weekly" id="weekly" class="form-control " min=0 value="{{ $goal->weekly }}" >

                    </div>
                    <div class="form-group col-12 col-md-3 ">
                        <label for="monthly">{{ __("translate.Monthly Target") }}</label>
                        <input type="number" step="any" name="monthly" id="monthly" class="form-control" min=0 value="{{ $goal->monthly }}" >

                    </div>
                    <div class="form-group col-12 col-md-3 ">
                        <label for="yearly">{{ __("translate.Yearly Target") }}</label>
                        <input type="number" step="any" name="yearly" id="yearly" class="form-control" min=0 value="{{ $goal->yearly }}" >

                    </div>
                    <div class="form-group col-12 col-md-3 ">             
                               <button type="submit" id="submit" class="btn bg-abasas-dark btn-block"> {{ __("translate.Submit") }}</button>


                    </div>

                </div>


            </form>



        </div>




    </div>
</div>




@endsection