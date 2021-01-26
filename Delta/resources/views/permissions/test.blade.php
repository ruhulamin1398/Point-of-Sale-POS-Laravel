@extends('includes.app')


@section('content')


<div class="card shadow mb-4">

    <div class="card-header py-3 bg-abasas-dark">
        <nav class="navbar  ">

            <div class="navbar-brand"><span id="eventList">Permission Test</span> </div>


        </nav>
    </div>
    <div class="card-body">

        <div class="table-responsive">
            
<form action="{{ route('rolepermissionstore') }}" method="post">
    @csrf
            <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead class="bg-abasas-dark">

                    <tr>

                        <th>Permissions </th>
                        <th> Super Admin</th>
                        <th>Admin</th>
                        <th>Staff</th>

                    </tr>
                </thead>


                <tbody>

                    @php
                    $itr = 1;
                    @endphp

                    <tr class="data-row">
                        <td class="iteration">Create </td>
                        <td class="word-break name justify-content-center"> 
                              <label class="checkbox-inline"><input type="checkbox" name="create" value="1" checked></label></td>
                        <td class="word-break name">
                                <label class="checkbox-inline"><input type="checkbox" value="" checked></label>
                           
                        </td>
                        
                        <td class="word-break name"><label class="checkbox-inline"><input type="checkbox" value="" checked></label> </td>

                    </tr>
                    <tr class="data-row">
                        <td class="iteration"> Read </td>
                        <td class="word-break name"></td>
                        <td class="word-break name"></td>
                        <td class="word-break name"> </td>

                    </tr>
                    <tr class="data-row">
                        <td class="iteration"> Edit</td>
                        <td class="word-break name"></td>
                        <td class="word-break name"></td>
                        <td class="word-break name"> </td>

                    </tr>
                    <tr class="data-row">
                        <td class="iteration"> Delete</td>
                        <td class="word-break name"></td>
                        <td class="word-break name"></td>
                        <td class="word-break name"> </td>

                    </tr>


                </tbody>

                

            </table>

          <div  style="float: right">

            <button type="submit" class="btn btn-md form-control bg-abasas-dark ">Save</button>

          </div>
        </form>
        </div>



        @endsection
