<div class="p-0 m-0">


    <canvas id={{ $dataArray['id'] }}></canvas>
    <script>
        var dataArray= @json( $dataArray );

    var ctx = document.getElementById(dataArray.id);
    var myChart = new Chart(ctx, {
        type: 'polarArea',
        data: {
            labels: dataArray.lebels,
            datasets:  dataArray.datasets,
           
        }
    });
    </script>




</div>