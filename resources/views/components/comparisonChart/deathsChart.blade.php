<div class="row" id="chart1">
    <div class="col-lg-12">
        <div class="ibox ">
            <div class="ibox-title">
                <h3>Perbandingan Kasus Konfirmasi Meninggal COVID-19 Pada 2 Negara</h3>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                    
                    <a class="close-link">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-footer">
                    <canvas id="deathsChart" style="height:200px; width:80%"></canvas>
            </div>
        </div>
    </div>
</div>

@push('footer-scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
<script>
@isset($getMainHistoryData)
    var historyData = {!! json_encode($getMainHistoryData) !!}
    var comparedData = {!! json_encode($getComparedHistoryData) !!}
    var ctx = document.getElementById('deathsChart').getContext('2d');
    
    console.log(historyData);
    console.log(comparedData);
    console.log(historyData.map(item => {
                const d = new Date(item.Date)
                return `${d.getDay()}-${d.getMonth()}`}))
    console.log(comparedData.map(item => {
                const d = new Date(item.Date)
                return `${d.getDay()}-${d.getMonth()}`}))
    console.log(historyData.map(item => item.Deaths))
    console.log(comparedData.map(item => item.Deaths))

    var chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [...Array(historyData.length).keys()].map(index => `Day ${index}`),
            datasets: [{
                label: `${historyData[0].Country} Deaths`,
                borderColor: "#f82649",
                pointBorderColor: "#f82649",
                pointBackgroundColor: "#f82649",
                pointHoverBackgroundColor: "#f82649",
                pointHoverBorderColor: "#f82649",
                pointBorderWidth: 2,
                pointHoverRadius: 2,
                pointHoverBorderWidth: 1,
                pointRadius: 2,
                fill: false,
                borderWidth: 2,
                data: historyData.map(item => item.Deaths),
            },
            {
                label: `${comparedData[0].Country} Deaths`,
                borderColor: "#63121f",
                pointBorderColor: "#63121f",
                pointBackgroundColor: "#63121f",
                pointHoverBackgroundColor: "#63121f",
                pointHoverBorderColor: "#63121f",
                pointBorderWidth: 2,
                pointHoverRadius: 2,
                pointHoverBorderWidth: 1,
                pointRadius: 2,
                fill: false,
                borderWidth: 2,
                data: comparedData.map(item => item.Deaths),
            },
        ]
        },
        options: {
            tooltips: {
                intersect: false
            },
            legend: {
                display: true,
                position: "bottom"
            },
            scales: {
                yAxes: [{
                    ticks: {
                        fontColor: "rgba(0,0,0,0.5)",
                        fontStyle: "bold",
                        beginAtZero: true,
                        maxTicksLimit: 5,
                        padding: 20
                    },
                    gridLines: {
                        drawTicks: false,
                        display: false
                    }
                    }],
                xAxes: [{
                    gridLines: {
                        zeroLineColor: "transparent"},
                    ticks: {
                        padding: 20,
                        fontColor: "rgba(0,0,0,0.5)",
                        fontStyle: "bold",
                        beginAtZero: true,
                    },
                }]
            }
        }
    });
@endisset
</script>
@endpush