@extends('layout.app')
@section('content')





<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card mb-4 shadow">

        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Add New Supplier</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('suppliers.store') }}">
                @csrf
                <div class="form-row align-items-center">
                    <div class="col-auto">
                        <span class="text-dark pl-2"> Supplier's Name</span>
                        <input type="text" name="name" class="form-control mb-2">
                    </div>
                    <div class="col-auto">

                        <span class="text-dark pl-2"> Phone</span>
                        <input type="text" name="phone"  class="form-control mb-2" >
                    </div>
                    <div class="col-auto">

                        <span class="text-dark pl-2"> Address</span>
                        <input type="text" name="address"  class="form-control mb-2">
                    </div>
                    <div class="col-auto">

                        <span class="text-dark pl-2"> Company</span>
                        <input type="text" name="company"  class="form-control mb-2">
                    </div>

                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary mt-3">Submit</button>
                    </div>

                </div>

            </form>
        </div>
    </div>



    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Supplier's list</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="dataTable1" width="100%" cellspacing="0">
                    <thead class="thead-dark">


                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Company</th>
                            <th>Due</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot class="thead-dark">
                    <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Company</th>
                            <th>Due</th>
                            <th>Action</th>
                        </tr>

                    </tfoot>
                    <tbody>

                        <?php $i = 1; ?>
                        @foreach ($suppliers as $supplier)
                        <?php $id = $supplier->id; ?>
                        <tr class="data-row">
                            <td class="iteration">{{$i++}}</td>
                            <td id="supplierName">{{$supplier->name}}</td>
                            <td id="supplierPhone">{{$supplier->phone}}</td>
                            <td id="supplierAddress">{{$supplier->address}}</td>
                            <td id="supplierCompany">{{$supplier->company}}</td>
                            <td id="supplierDue">{{$supplier->due}}</td>




                            <td class="align-middle">
                                <button type="button" class="btn btn-success" id="edit-supplier-button" data-item-id={{$id}} value ={{$id}}> <i class="fa fa-edit" aria-hidden="false"> </i></button>


                                <form method="POST" action="{{ route('suppliers.destroy',  $supplier->id )}} " id="delete-form-{{ $supplier->id }}" style="display:none; ">
                                    {{csrf_field() }}
                                    {{ method_field("delete") }}
                                </form>




                                <button onclick="if(confirm('are you sure to delete this')){
				document.getElementById('delete-form-{{ $supplier->id }}').submit();
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
    </div>

</div>


<!-- Attachment Modal -->
<div class="modal fade" id="supplier-edit-modal" tabindex="-1" role="dialog" aria-labelledby="supplier-edit-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark" id="edit-modal-label ">Edit Supplier</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="attachment-body-content">
                <form id="edit-form" class="form-horizontal" method="POST" action="{{route('suppliersupdate')}}">
                    @csrf



                    <!-- id -->
                    <div class="form-group">
                        <label class="col-form-label" for="SupplierEditId">Id </label>
                        <input type="text" name="id" class="form-control" id="SupplierEditId" required readonly>
                    </div>
                    <!-- /id -->
                    <!-- name -->
                    <div class="form-group">
                        <label class="col-form-label" for="editModalSupplierName">Name</label>
                        <input type="text" name="name" class="form-control" id="editModalSupplierName" required >
                    </div>
                    <!-- /name -->


                
                    <!-- phone -->
                    <div class="form-group">
                        <label class="col-form-label" for="editModalSupplierPhone">Phone</label>
                        <input type="text" name="phone" class="form-control" id="editModalSupplierPhone" required >
                    </div>
                    <!-- /phone -->

                    <!-- Address -->
                    <div class="form-group">
                        <label class="col-form-label" for="editModalSupplierAddress">Address</label>
                        <input type="text" name="address" class="form-control" id="editModalSupplierAddress" required >
                    </div>
                    <!-- /Address -->

                    <!-- Company -->
                    <div class="form-group">
                        <label class="col-form-label" for="editModalSupplierCompany">Company</label>
                        <input type="text" name="company" class="form-control" id="editModalSupplierCompany" required >
                    </div>
                    <!-- /Company -->


                    <div class="form-group">

                        <input type="submit" value="submit" class="form-control btn btn-success">
                    </div>
                    <!-- /description -->
                



                </form>
            </div>

        </div>
    </div>
</div>
</div>
<!-- /Attachment Modal -->



@endsection