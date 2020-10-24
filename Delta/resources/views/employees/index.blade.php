@extends('includes.app')

@section('content')




<!-- Begin Page Content -->
<div style="display: none;" id="employeeInputForm">
    <div class="card mb-4 shadow">

        <div class="card-header py-3  bg-abasas-dark ">
            <nav class="navbar navbar-dark">
                <a class="navbar-brand text-light">New Employee</a>
            </nav>
        </div>
        <div class="card-body">
            <form method="POST" action="{{route('employees.store')}}">
                @csrf
                <div class="form-row align-items-center">


                    <div class="col-md-4 col-sm-12  p-4">
                        <label for="name">Name<span style="color: red"> *</span></label>
                        <input type="text" name="name" class="form-control mb-2" placeholder="Name" required>
                    </div>

                    <div class="col-md-4 col-sm-12  p-4">
                        <label for="designation_id">Select Designation<span style="color: red"> *</span></label>
                        <select class="form-control form-control" value="1" name="designation_id" id="designation_id" required>
                            <option disabled selected value> -- select an option -- </option>
                            @foreach ($designations as $designation)
                            <option value="{{$designation->id}}"> {{$designation->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4 col-sm-12  p-4">
                        <label for="phone">Phone<span style="color: red"> *</span></label>
                        <input type="tel" id="phoneInput" name="phone" class="form-control mb-2"  placeholder="Phone"required>
                        <span style="color: red"  id="phoneFieldWarning"> </span>

                    </div>
                    <div class="col-md-4 col-sm-12  p-4">
                        <label for="address">Address<span style="color: red"> *</span></label>
                        <input type="text" name="address" class="form-control mb-2"  placeholder="Address" required>
                    </div>
                    <div class="col-md-4 col-sm-12  p-4">
                        <label for="fixed_duty_hour">Fixed Duty (Hour)<span style="color: red"> *</span></label>
                        <input type="number" name="fixed_duty_hour" class="form-control mb-2"  placeholder="Fixed Duty(Hour)" required>
                    </div>
                    <div class="col-md-4 col-sm-12  p-4">
                        <label for="salary ">Salary<span style="color: red"> *</span> </label>
                        <input type="number" step="any" name="salary" class="form-control mb-2"placeholder="Salary" required>
                    </div>
                    <div class="col-md-4 col-sm-12  p-4">
                        <label for="joining_date">Joining Date</label>
                        <input type="date" name="joining_date" class="form-control mb-2">
                    </div>
                    <div class="col-md-4 col-sm-12  p-4">
                        <label for="term_of_contract">Term of Contract</label>
                        <input type="date" name="term_of_contract" class="form-control mb-2">
                    </div>
                    <div class="col-md-4 col-sm-12  p-4">
                        <label for="reference ">Reference </label>
                        <input type="text" name="reference" class="form-control mb-2"placeholder="Reference">
                    </div>
                    <div class="col-12  p-4 ml-4" id="checkBoxDiv">
                        <input class="form-check-input " name="add_user" type="checkbox" id="userAddCheck" value="1">
                        <label class="form-check-label" for="userAddCheck">Add User data</label>
                    </div>
                    <div id="emptySpace1"class="col-md-4 col-sm-12  p-4" ></div>
                    <div id="emptySpace2"class="col-md-4 col-sm-12  p-4"></div>
                    <div id="emptySpace3"class="col-md-4 col-sm-12  p-4"></div>

                    <div class="col-auto ">
                        <button type="submit" id="employeeSubmit" class="form-control btn bg-abasas-dark ml-4">Submit</button>
                    </div>
                   

                </div>

            </form>
        </div>
    </div>
</div>




<x-data-table :dataArray="$dataArray" />

<script>
    $(document).ready(function () {
        // employee form hide
        $('#createNewForm').hide().removeClass("collapse");
        $('body').on('click', '#AddNewFormButton', function () {
            $('#employeeInputForm').toggle();

        });

        // user section add
        var html1 = '', html2= '', html3= '';
        
        html1+='<div class="col-12">';
        html1+='        <label for="userName">Username<span style="color: red"> *</span></label>';
        html1+='        <input type="text" onkeypress="return event.charCode != 32"  id="userNameInput" name="userName" class="form-control mb-2"placeholder="Username" required>';
        html1+=' <span  style="color: red;" id="userNameFieldWarning"></span> </div>';

        html2+='<div class="col-12">';
        html2+='    <label for="email">Email<span style="color: red"> *</span></label>';
        html2+='    <input type="email" name="email"  id="emailInput" class="form-control mb-2"placeholder="Email" required>';
        html2+='  <span  style="color: red;" id="emailFieldWarning"></span>  </div>';

        html3+='<div class="col-12">';
        html3+='    <label for="password">Password<span style="color: red"> *</span></label><div class="input-group">';
        html3+='    <input type="Password" name="password" id="password"class="form-control mb-2 "minlength="6" placeholder="Password"required>';
        html3+='    <div class="p-3"><i class="fa fa-eye" id="togglePassword"></i></div>';
        html3+='</div></div>';

        
       
        $('body').on('click', '#userAddCheck', function () {
                
            if ($(this).is(":checked")) {
                $('#emptySpace1').html(html1);
                $('#emptySpace2').html(html2);
                $('#emptySpace3').html(html3);
                }
                else{
                $('#emptySpace1').html('');
                $('#emptySpace2').html('');
                $('#emptySpace3').html('');
                
                }
            
        });
        // password toggle

        $('body').on('click','#togglePassword',function(){
            
            if(  $('#password').attr("type") == 'password' ){
                 $('#password').attr("type", "text");
            }
            else{
                 $('#password').attr("type", "password");
            } 
        });
        // unique check 
        $("#phoneInput").on('input', function () {
            phoneFunction();
        });

        $(document).on('input','#userNameInput', function () {
            userNameFunction();
        });

        $(document).on('input','#emailInput', function () {
            emailFunction();
        });


        //phone unique check
        function phoneFunction() {
            var phoneFieldLength = $("#phoneInput").val().trim().length;
            
            var text = 'Please Enter a Valid phone number';
            if (phoneFieldLength != 11) {
                $("#phoneFieldWarning").text(text);
                $("#employeeSubmit").attr("disabled", true);

            }
            else{

                $("#phoneFieldWarning").text('');
                $("#employeeSubmit").attr("disabled", false);
                var number = $("#phoneInput").val().trim();

                var allEmployees= @json($employees);

                $.each(allEmployees, function (key){

                    if(number==allEmployees[key]['phone']){
                        var text1= 'This Number is already taken';
                        $("#phoneFieldWarning").text(text1);
                        $("#employeeSubmit").attr("disabled", true);
                        return false;
                    }
                });
            }
        } 

        function userNameFunction(){
            var userName = $("#userNameInput").val().trim();
                var allUser= @json($users);
                $.each(allUser, function (key){

                    if(userName==allUser[key]['name']){
                        var text1= 'This Username is already taken';
                        $("#userNameFieldWarning").text(text1);
                        $("#employeeSubmit").attr("disabled", true);
                        return false;
                    }else{
                        
                        $("#userNameFieldWarning").text('');
                        $("#employeeSubmit").attr("disabled", false);
                    }
                });

        }
        function emailFunction(){
            var email = $("#emailInput").val().trim();
                var allUser= @json($users);
                $.each(allUser, function (key){

                    if(email==allUser[key]['email']){
                        var text1= 'This email is already taken';
                        $("#emailFieldWarning").text(text1);
                        $("#employeeSubmit").attr("disabled", true);
                        return false;
                    }else{
                        
                        $("#emailFieldWarning").text('');
                        $("#employeeSubmit").attr("disabled", false);
                    }
                });

        }
        
      



    });

</script>




@endsection
