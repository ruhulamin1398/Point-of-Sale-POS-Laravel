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
<div class="container-fluid  p-0">




    <!-- DataTales Example -->
    <div class="card shadow mb-4 ml-0 mr-0">
        <div class="card-header py-3 bg-abasas-dark">
            <nav class="navbar navbar-dark ">
                <a class="navbar-brand">{{ __("translate.Goal") }} @can('Super Admin') <i class="fas fa-tools pl-2"
                    id="pageSetting" data-toggle="modal" data-target="#setting-modal"></i> @endcan </a>

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
                <input type="text" name="page_name" value="Goal" required hidden>
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
                            $permision_name = "Goal Page";
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