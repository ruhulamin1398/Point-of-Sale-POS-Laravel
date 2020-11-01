<div>


    <canvas id="barChart"></canvas>
    <script>
    var dataArray= @json(json_decode ( $dataArray , true));
    var bgColor=  new Array();
    var bdColor=  new Array();
    for(var i=0;i<dataArray.lebels.length;i++){
        bgColor.push("#" + Math.floor(Math.random()*16777215).toString(16));
        bdColor.push("#" + Math.floor(Math.random()*16777215).toString(16));
    }
    console.log(dataArray)
    var ctx = document.getElementById('barChart');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: dataArray.lebels,
            datasets: [{
                label: dataArray.label,
                data: dataArray.data,
                backgroundColor: bgColor,
                borderColor: bdColor,
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