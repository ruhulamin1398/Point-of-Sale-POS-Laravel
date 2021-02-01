
@extends('includes.app')


@section('content')



@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

@if (session()->has('success'))
<div class="alert alert-success">
    @if(is_array(session('success')))
    <ul>
        @foreach (session('success') as $message)
        <li>{{ $message }}</li>
        @endforeach
    </ul>
    @else
    {{ session('success') }}
    @endif
</div>
@endif







<div class="container-fluid m-0 p-0">
    
    <!-- Begin Page Content -->
    <div class="" id="createNewForm"  style="display: none">
        <div class="card mb-4 shadow">
    
            <div class="card-header py-3  bg-abasas-dark ">
                <nav class="navbar navbar-dark">
                    <a class="navbar-brand text-light"> {{ __('translate.Assign Role to User') }} </a>
                </nav>
            </div>

           
            <div class="card-body">
                <form method="POST" id="createEventForm" action="{{ route('user-roles.store' ) }}" enctype="multipart/form-data">
                    @csrf
                    @method('post')

                    <div class="row">
                        

                    <div class="form-group col-md-6 col-sm-12 ">
                        <label for="name"> User <span style="color: red"> *</span></label>
                       <select name="user_id" id="" class="form-control" required>
                        <option selected disabled value="">Select User</option>


                
                    @foreach ($user_with_roles as $user)
              
       
                        <option value="{{ $user->id }}" >{{ $user->name }}</option>

                        @endforeach
                       </select>
                    </div>

                
                    
                    <div class="form-group col-md-6 col-sm-12 ">
                        <label for="permission">  <span style="color: red"> *</span></label>
                    
                            <label for="permission">Role</label>
                                <select name="role_id" id="" class="form-control" required>
                                    <option selected disabled value="">Select Role</option>
            
            
                            
                                @foreach ($roles as $role)
                          
                   
                                    <option value="{{ $role->id }}" >{{ $role->name }}</option>
            
                                    @endforeach
                                   </select>
                          </div> 
                    </div>


                 

                    <button type="submit"  class="btn bg-abasas-dark"> Submit</button>

                </form>
            </div>
        </div>
    </div>





   


    <div class="card shadow mb-4">

        <div class="card-header py-3 bg-abasas-dark">
            <nav class="navbar  ">
    
                <div class="navbar-brand"><span id="eventList"> User With Role  @can('Super Admin') <i class="fas fa-tools pl-2"
                    id="pageSetting" data-toggle="modal" data-target="#setting-modal"></i> @endcan
</span> </div>
                @can('User Role Create')
                <div id="AddNewFormButtonDiv"><button type="button" class="btn btn-success btn-lg" id="AddNewFormButton" ><i class="fas fa-plus"
                        id="PlusButton"></i></button></div> 
                @endcan
    
            </nav>
        </div>
        <div class="card-body">
    
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="bg-abasas-dark">
    
                        <tr>
    
                            <th> #</th>
                            <th>User Name</th>
                            <th>Role</th>
                            @can('User Role Delete')
                            <th>Action</th>
                            @endcan
    
                        </tr>
                    </thead>
                    <tfoot class="bg-abasas-dark">
                        <tr>
    
                            <th> #</th>
                            <th>User Name</th>
                            <th>Role</th>
                            
                            @can('User Role Delete')
                            <th>Action</th>
                            @endcan
    
                        </tr>
    
                    </tfoot>
    
                    <tbody>
                        @php
                        $itr=1;
                        @endphp
                        @foreach ($user_with_roles as $user)
                        @php
                        $allrole = $user->roles;
                        $id = $user->id;
                    @endphp
    
                        @if ($allrole->count()>0)
                            
                        <tr class="data-row" >
                            <td class="iteration">{{$itr++}}</td>
                            <td class="word-break name">{{ $user->name }}</td>
                            <td class="word-break role">
                                
                                @foreach ($allrole as $role)
                               
                       
                                {{ $role->name }}

                                {{-- <span class="text-danger text-xs-right" >
                                    <i class="fa fa-trash"></i>
                                </span> --}}


                                @endforeach

                               
                            
                            </td>

                           
    
                            @can('User Role Delete')
                            <td class="align-middle">

                              


                            <form method="POST" action="{{ route('user-roles.destroy',  $user->id )}}" id="delete-form-{{ $user->id }}" style="display:none; ">
                                {{csrf_field() }}
                                {{ method_field("delete") }}
                            </form>
  
 
                                <button title="Delete" id="permissionDeleteButton" class="dataDeleteItemClass btn btn-danger btn-sm" onclick="if(confirm('are you sure to Remove Role From user ?')){
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
                            @endcan
    
    
                        </tr>
                        
                        @endif
                        @endforeach
    
                    </tbody>
    
    
                </table>
                
            </div>
        </div>
    </div>
    
    
</div>


 <!-- Attachment Modal -->
 <div class="modal fade" id="level-edit-modal" tabindex="-1" role="dialog" aria-labelledby="edit-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark" id="edit-modal-label ">Edit Level</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="attachment-body-content">
                <form id="level-edit-form" class="form-horizontal" method="POST" action="">
                @csrf
                  
       
                    <!-- /id -->
                    <!-- name -->
                    <div class="form-group">
                        <label class="col-form-label" for="modal-input-firstname">firstname</label>
                        <input type="text" name="firstname" class="form-control" id="modal-input-firstname" required autofocus>
                    </div>

                   
                    <div class="form-group">
                        <input type="submit" value="Submit" class="form-control btn btn-success">
                    </div>
                    <!-- /description -->
                </form>
            </div>

        </div>
    </div>
</div>

     <!-- /Attachment Modal -->




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
            <input type="text" name="page_name" value="User Role" required hidden>
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
                        $permision_name = "User Role Page";
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


                        @php
                        $permision_name = "User Role Create";
                        @endphp
                        
                        <tr class="data-row">
                            <td class="iteration">{{ __('translate.Create Access') }}</td>
                            @for ($i=1 ; $i<5 ; $i++) <td
                                class="word-break name justify-content-center">
                                <label class="checkbox-inline"><input type="checkbox"
                                        name="create{{ $i }}"
                                        @if($roles[$i]->hasPermissionTo($permision_name)) checked
                                    @endif></label>
                                </td>
                                @endfor

                        </tr>


                        @php
                        $permision_name = "User Role Delete";
                        @endphp
                        
                        <tr class="data-row">
                            <td class="iteration">{{ __('translate.Delete Access') }}</td>
                            @for ($i=1 ; $i<5 ; $i++) <td
                                class="word-break name justify-content-center">
                                <label class="checkbox-inline"><input type="checkbox"
                                        name="delete{{ $i }}"
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
    $(document).ready(function(){
        
        $('body').on('click', '#AddNewFormButton', function () {
            $('#createNewForm').toggle();
            $('#PlusButton').toggleClass('fa-plus').toggleClass('fa-minus');
            

        });


 $('body').on('click', "#level-edit-item", function() {

   
          $(this).addClass('edit-item-trigger-clicked'); //useful for identifying which trigger was clicked and consequently grab data from the correct row and not the wrong one.

          var el = $(".edit-item-trigger-clicked"); // See how its usefull right here?
    var row = el.closest(".data-row");

    // get the data
    var id = el.data('item-id');
 
    var permissions = row.children(".permissions").text();




          var options = {
      'backdrop': 'static'
    };
    
    $('#level-edit-modal').modal(options)



  // on modal show
  $('#level-edit-modal').on('show.bs.modal', function() {
    var el = $(".edit-item-trigger-clicked"); // See how its usefull right here?
    var row = el.closest(".data-row");

    // get the data
    var id = el.data('item-id');
 
    var permissions = row.children(".permissions").text();




    var action= $("#indexLink").val()+'/update/'+id;
    $("#level-edit-form").attr('action',action);

    // fill the data in the input fields
    $("#modal-input-id").val(id);

  });
  //on modal hide
  $('#level-edit-modal').on('hide.bs.modal', function() {
    $('.edit-item-trigger-clicked').removeClass('edit-item-trigger-clicked')
    $("#level-edit-form").trigger("reset");
  });
 



  });



});   

   




</script>

 


 
@endsection