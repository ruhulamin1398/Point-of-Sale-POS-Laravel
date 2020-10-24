
@extends('includes.app')

@section('content')


<x-data-table
:dataArray="$dataArray"

/>

<script>
    $(document).ready(function(){
        
        $('#createNewForm').hide().removeClass("collapse");
        $('#AddNewFormButtonDiv').hide();

        var table = $('#dataTable').DataTable({   
                    dom: 'lBfrtip',
                    buttons: [
                        'copy', 'csv', 'excel' , 'pdf' , 'print'
                    ]
                });
        table.columns( [-1] ).visible( false );
    });
</script>


@endsection



