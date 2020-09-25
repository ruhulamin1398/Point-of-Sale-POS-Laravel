<div class="card shadow mb-4">

    <div class="card-header py-3 bg-abasas-dark">
        <nav class="navbar navbar-dark ">
            <a class="navbar-brand"> ক্যাটাগরি লিস্ট</a>

        </nav>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered" id="dataTable1" width="100%" cellspacing="0">
                <thead class="bg-abasas-dark">

                    <tr>

                        @for( $i = 0 ; $i < sizeof($fieldTitleList) ; $i++) <th>{{$fieldTitleList[$i]}}</th> @endfor
                    </tr>
                </thead>
                <tfoot class="bg-abasas-dark">
                    <tr>
                        @for( $i = 0 ; $i < sizeof($fieldTitleList) ; $i++) <th>{{$fieldTitleList[$i]}}</th> @endfor
                    </tr>

                </tfoot>
                <tbody>
                  
                        <?php $itr = 1; ?>
                        @foreach ($items as $item)
                        <?php $id = $item->id; ?>

                        <tr class="data-row">
                        <td class="iteration">{{$itr++}}</td>
                        @for( $i = 0 ; $i < sizeof($fieldList) ; $i++)
                        <td class="  word-break {{$fieldList[$i]}}">
                            
                   
                        {{$item[$fieldList[$i]]}}
                       

                        </td>
                        @endfor
                     
                  
           

        


                    <td class="align-middle">
                        <button type="button" class="btn btn-success" id="edit-item" data-item-id={{$id}}> <i class="fa fa-edit" aria-hidden="false"> </i></button>


                        <form method="POST" action="{{route($routes['delete'],$id)}}" id="delete-form-{{ $item->id }}" style="display:none; ">
                            {{csrf_field() }}
                            {{ method_field("delete") }}
                        </form>




                        <button onclick="if(confirm('are you sure to delete this')){
				document.getElementById('delete-form-{{ $item->id }}').submit();
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