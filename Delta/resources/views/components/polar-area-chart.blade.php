<div>


    <canvas id="polarAreaChart"></canvas>
    <script>
        var dataArray= @json(json_decode ( $dataArray , true));

        console.log(dataArray.lebels);
    var ctx = document.getElementById('polarAreaChart');
    var myChart = new Chart(ctx, {
        type: 'polarArea',
        data: {
            labels: dataArray.lebels,
            datasets: [{
                label: dataArray.label,
                data: dataArray.data,
                backgroundColor: [
                    "#" + Math.floor(Math.random()*16777215).toString(16),
                    "#" + Math.floor(Math.random()*16777215).toString(16),
                    "#" + Math.floor(Math.random()*16777215).toString(16),
                    "#" + Math.floor(Math.random()*16777215).toString(16),
                    "#" + Math.floor(Math.random()*16777215).toString(16),
                    "#" + Math.floor(Math.random()*16777215).toString(16)
                ],
                borderColor: [
                    "#" + Math.floor(Math.random()*16777215).toString(16),
                    "#" + Math.floor(Math.random()*16777215).toString(16),
                    "#" + Math.floor(Math.random()*16777215).toString(16),
                    "#" + Math.floor(Math.random()*16777215).toString(16),
                    "#" + Math.floor(Math.random()*16777215).toString(16),
                    "#" + Math.floor(Math.random()*16777215).toString(16)
                ],
                borderWidth: 1
            }]
        }
    });
    </script>




</div>