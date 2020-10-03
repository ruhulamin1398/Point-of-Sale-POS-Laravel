<div class="card shadow mb-4">

    <div class="card-header py-3 bg-abasas-dark">
        <nav class="navbar navbar-dark ">
            <a class="navbar-brand"> {{ __('translate.'.$componentDetails['title'])  }}</a>
            <button type="button" class="btn btn-success btn-lg" id="AddNewFormButton" data-toggle="collapse" data-target="#NewEmployorm" aria-expanded="false" aria-controls="collapseExample"><i class="fas fa-plus" id="PlusButton"></i></button>
        </nav>
    </div>
    <div class="card-body">

        <div class="table-responsive">
            <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead class="bg-abasas-dark">

                    <tr>

                        <th> #</th>
                        @foreach( $fieldList as $field)

                        @if($field['read'])

                        <th> {{ __('translate.'.$field['title'])  }}</th>

                        @endif
                        @endforeach

                        <th>{{__('translate.Action')}}</th>

                    </tr>
                </thead>
                <tfoot class="bg-abasas-dark">
                    <tr>


                        <th> #</th>
                        @foreach( $fieldList as $field)

                        @if($field['read'])
                        <th> {{ __('translate.'.$field['title'])  }}</th>
                        @endif
                        @endforeach

                        <th>{{__('translate.Action')}}</th>

                    </tr>

                </tfoot>
                <tbody>

                    <?php $itr = 1; ?>
                    @foreach ($items as $item)
                    <?php $itemId = $item->id; ?>

                    <tr class="data-row">
                        <td class="iteration">{{$itr++}}</td>

                        @foreach( $fieldList as $field)

                        @if($field['read'])

                        @if( $field['type'] == 'dropDown')
                        @php
                        $name= $field['name'];
                        $id= $field['field'];
                        $databaseName= $field['database_name'];
                        @endphp
                        <td class="  word-break  {{$field['database_name']}} " data-{{$field['database_name']}}="{{$item->$databaseName}}">

                            {{ $item->$name->$id}}
                        </td>

                        @else
                        @php
                        $name= $field['name'];
                        @endphp
                        <td class="  word-break  {{$field['database_name']}} ">

                            {{ $item->$name}}
                        </td>
                        @endif
                        @endif

                        @endforeach







                        <td class="align-middle">
                            <button type="button" class="btn btn-success" id="data-edit-button" data-item-id={{$itemId}}> <i class="fa fa-edit" aria-hidden="false"> </i></button>


                            <form method="POST" action="{{route($routes['delete']['name'],$itemId)}}" id="delete-form-{{ $item->id }}" style="display:none; ">
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














<!-- Attachment Modal -->
<div class="modal fade" id="data-edit-modal" tabindex="-1" role="dialog" aria-labelledby="edit-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark" id="edit-modal-label ">{{ __('translate.'.$componentDetails['editTitle'])}} </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
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

                    <div id="editOptions"></div>





                    <div class="form-group">

                        <input type="submit" id="submit-button" value=" {{__('translate.Submit')}}" class="form-control btn btn-success">
                    </div>




                </form>
            </div>

        </div>
    </div>
</div>
</div>
<!-- /Attachment Modal -->


<script>
    /**
     * for showing edit item popup
     */

    $(document).ready(function() {

        $(document).on('click', "#data-edit-button", function() {


            $(this).addClass('edit-item-trigger-clicked'); //useful for identifying which trigger was clicked and consequently grab data from the correct row and not the wrong one.

            var options = {
                'backdrop': 'static'
            };
            $('#data-edit-modal').modal(options)
        });

        // on modal show
        $('#data-edit-modal').on('show.bs.modal', function() {
            var el = $(".edit-item-trigger-clicked"); // See how its usefull right here? 
            var row = el.closest(".data-row");

            // get the data
            var itemId = el.data('item-id');
            $("#modal-update-hidden-id").val(itemId);


            var home = "{{route('home')}}";
            var link = "{{$routes['update']['link']}}"
            var action = home.trim() + '/' + link.trim() + '/' + itemId;

            $("#data-edit-form").attr('action', action);
            $("#editOptions").html('');



            @php $j = 1;
            @endphp
            @foreach($fieldList as $field)

            @if($field['update'])


            @if($field['type'] == 'dropDown')
            @php
            $name = $field['name'];
            $id = $field['field'];
            $tid = $field['database_name'];
            @endphp


            var databaseName = "{{$field['database_name']}}";

            var dropDownId = row.children("." + databaseName).data(databaseName);

            var dataArray = @json($field['data']);

            html = "";
            html += '<div class="form-group">';
            html += '<label class="col-form-label" >  {{$field["title"] }} </label>';
            html += '<select class="form-control form-control" name="' + databaseName + '"  required>';


            $.each(dataArray, function(key) {
                if (dataArray[key].id == dropDownId) {
                    html += '<option value="' + dataArray[key].id + ' "  selected="selected"   >' + dataArray[key].name + '</option>';
                } else {
                    html += '<option value="' + dataArray[key].id + '" >' + dataArray[key].name + '</option>';
                }

            });



            html += '</select>';
            html += '</div>';

            $("#editOptions").append(html);



            @else
            var text = row.children(".{{$field['database_name']}}").text();

            html = "";
            html += '<div class="form-group">';
            html += '<label class="col-form-label" >  {{$field["title"] }}  </label>';
            var databaseName = "{{$field['database_name']}}";
            html += '<input type="text" name="' + databaseName + '" value="' + text.trim() + '" class="form-control" required>';
            html += '</div>';

            $("#editOptions").append(html);

            @endif
            @endif

            @endforeach



        });

        // on modal hide
        $('#data-edit-modal').on('hide.bs.modal', function() {
            $('.edit-item-trigger-clicked').removeClass('edit-item-trigger-clicked')
            $("#edit-form").trigger("reset");
        });



        $('#dataTable').DataTable();
    });
</script>

{{ $slot }}