<div>
    
    <canvas id={{ $id }}></canvas>
    <script>
   var dataArray= @json($dataArray);
   var id= @json($id);
    var ctx = document.getElementById(id);
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: dataArray.lebels,
            datasets:dataArray.datasets,
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