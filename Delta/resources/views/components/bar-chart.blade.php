<div>
    
    <canvas id={{ $dataArray['id'] }}></canvas>
    <script>
   var dataArray= @json($dataArray);
    var ctx = document.getElementById(dataArray.id);
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: dataArray.lebels,
            datasets: [{
                label: dataArray.label,
                data: dataArray.data,
                backgroundColor: dataArray.color	,
                borderWidth: 1
            }
            ]
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