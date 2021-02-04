
<canvas id={{ $id}} width="400" height="400"></canvas>
<script>
    var dataArray= @json( $dataArray );
    var id= @json( $id );
var ctx = document.getElementById(id).getContext('2d');
var myChart = new Chart(ctx, {
    type: 'polarArea',
    data: {
        labels: dataArray.lebels,
        datasets: dataArray.datasets,
    },
    options: {
        responsive:true,
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