<div>    
    <canvas id={{ $id}}></canvas>
    <script>
        var dataArray= @json( $dataArray );
        var id= @json( $id );
        
    var ctx = document.getElementById(id);
    console.log(dataArray.datasets);
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: dataArray.lebels,
            datasets: dataArray.datasets,
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
    </script>

</div>