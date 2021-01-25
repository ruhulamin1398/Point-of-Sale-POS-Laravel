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
<div class="collapse" id="createNewUser">
    <div class="card mb-4 shadow">

        <div class="card-header py-3  bg-abasas-dark ">
            <nav class="navbar navbar-dark">
                <a class="navbar-brand text-light"> {{ __('translate.Add new')  }}</a>
            </nav>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('users.store') }}">
                @csrf
                <div class="row">
                    
                    <div class="col-12 col-md-4 p-md-4 p-0">
                        <label for="employee_id">{{ __('translate.Employee')  }} <span style="color: red">*</span></label>
                        <select class="form-control" value="" name="employee_id" id="employee_id" required>
                        <option selected disabled>Select Employee </option>
                        @foreach ($employees as $employee)
                        
                        <option value="{{$employee->id}}"> {{$employee->name}}</option>
                        
                        
                        @endforeach
                    </select>
                    </div>
                    <div class="col-12 col-md-4 p-md-4 p-1">
                        <label for="name">{{ __('translate.Username')  }}<span style="color: red">*</span></label>
                        <input type="text"  onkeypress="return event.charCode != 32"  name="name" class="form-control" id="name" required >
                    </div>
                    <div class="col-12 col-md-4 p-md-4 p-1">
                        <label for="email">{{ __('translate.Email')  }}<span style="color: red">*</span></label>
                        <input type="email"   name="email" class="form-control" id="email" required >

                    </div>
                    <div class="col-12 col-md-4 p-md-4 p-1">
                        <label for="password">{{ __('translate.Password')  }}<span style="color: red">*</span></label>
                        <input type="text"   name="password" class="form-control" id="password" minlength="6" required >

                    </div>


                    <div class=" col-12 col-md-4 p-md-4 p-1">
                        <button type="submit" class="btn bg-abasas-dark mt-3">{{ __('translate.Submit')  }}</button>
                    </div>
                </div>


            </form>
        </div>
    </div>
</div>


<div class="card shadow mb-4">

    <div class="card-header py-3 bg-abasas-dark">
        <nav class="navbar  ">

            <div class="navbar-brand"><span >
                    {{ __('translate.User List')  }}</span> </div>


            <div ><button type="button" class="btn btn-success btn-lg" id="AddNewFormButton"
                    data-toggle="collapse" data-target="#createNewUser" aria-expanded="false"
                    aria-controls="collapseExample"><i class="fas fa-plus" id="PlusButton"></i></button></div>


        </nav>
    </div>



    
<div class="card-body">

    <div class="table-responsive">
        <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead class="bg-abasas-dark">

                <tr>

                    <th> #</th>
                    <th>{{__('translate.Employee Name')}}</th>
                    <th>{{__('translate.Username')}}</th>
                    <th>{{__('translate.Email')}}</th>
                    <th>{{__('translate.Action')}}</th>

                </tr>
            </thead>
            <tfoot class="bg-abasas-dark">

                <tr>

                    <th> #</th>
                    <th>{{__('translate.Employee Name')}}</th>
                    <th>{{__('translate.Username')}}</th>
                    <th>{{__('translate.Email')}}</th>
                    <th>{{__('translate.Action')}}</th>

                </tr>
            </tfoot>
            <tbody>
                @php
                    $itr=1;
                @endphp
                @foreach ($users as $user)
                <tr>
                    <td>{{ $itr++ }}</td>
                    <td>{{ $user->employee->name }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    




                    

                    <td class="align-middle">
                        <button title="Edit" type="button" class="dataEditItemClass btn btn-success btn-sm" id="data-edit-button" data-item-id={{$user->id}} > <i
                                class="fa fa-edit" aria-hidden="false"> </i></button>


                        <form method="POST" action="{{route('users.destroy',$user->id)}}"
                            id="delete-form-{{ $user->id }}" style="display:none; ">
                            {{csrf_field() }}
                            {{ method_field("delete") }}
                        </form>




                        <button title="Delete" class="dataDeleteItemClass btn btn-danger btn-sm" onclick="if(confirm('are you sure to delete this')){
				document.getElementById('delete-form-{{ $user->id }}').submit();
			}
			else{
				event.preventDefault();
			}
			" class="btn btn-danger btn-sm btn-raised">
                            <i class="fa fa-trash" aria-hidden="false">

                            </i>
                        </button>
                    </td>



                </tr>
                    
                @endforeach
                

            </tbody>
        </table>
    </div>


</div>





<!-- Attachment Modal -->
<div class="modal fade" id="data-edit-modal" tabindex="-1" role="dialog" aria-labelledby="edit-modal-label"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-abasas-dark">
                <h5 class="modal-title " id="edit-modal-label ">
                    {{ __('translate.Edit Password')}} </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="attachment-body-content">
                <form id="data-edit-form" class="form-horizontal" method="POST" action="">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label class="col-form-label" for="modal-update-hidden-id">{{__('translate.Id')}} </label>
                        <input type="text" name="id" class="form-control" id="modal-update-hidden-id" required readonly>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="modal-update-hidden-id">{{__('translate.New Password')}} </label>
                        <input type="text" name="password" class="form-control" id="modal-update-password" minlength="6" required>
                    </div>


                    <input type="submit" id="submit-button" value=" {{__('translate.Submit')}}"
                        class="form-control btn btn-success">
                </div>
                




                </form>
            </div>

        </div>
    </div>
</div>
<!-- /Attachment Modal --> 







<script>
    $(document).ready(function(){


        
        $('body').on('click', '#AddNewFormButton', function () {
            $('#PlusButton').toggleClass('fa-plus').toggleClass('fa-minus');

        });



        
        $(document).on('click', "#data-edit-button", function () {


            $(this).addClass(
            'edit-item-trigger-clicked'); //useful for identifying which trigger was clicked and consequently grab data from the correct row and not the wrong one.

            var options = {
                'backdrop': 'static'
            };
            $('#data-edit-modal').modal(options)
        });

                        // on modal show
        $('#data-edit-modal').on('show.bs.modal', function () {


            var el = $(".edit-item-trigger-clicked"); // See how its usefull right here? 
            var row = el.closest(".data-row");

            // get the data
            var itemId = el.data('item-id');
            $("#modal-update-hidden-id").val(itemId);


            var home = "{{route('home')}}";
            var action = home.trim() + '/users/' + itemId;
            $("#data-edit-form").attr('action', action);


        });

        
        // on modal hide
        $('#data-edit-modal').on('hide.bs.modal', function () {
            $('.edit-item-trigger-clicked').removeClass('edit-item-trigger-clicked')
            $("#edit-form").trigger("reset");
        });



        $('#dataTable').DataTable({   
            dom: 'lBfrtip',
            buttons: [
                'copy', 'csv', 'excel' , 'pdf' , 'print'
            ]
        });



    })
</script>




@endsection
