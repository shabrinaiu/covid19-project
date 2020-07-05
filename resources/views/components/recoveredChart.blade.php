<div class="row" id="chart2">
    <div class="col-lg-12">
        <div class="ibox ">
            <div class="ibox-title">
                <h5>Recovered data history</h5>
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
                <div>
                    <canvas id="recoveredChart" style="height:20%; width:80%"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

@push('footer-scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
<script>
    @isset($historyData)
        var historyData = {!! json_encode($historyData) !!}
        var data = {!! json_encode($data) !!}
        
        var ctx1 = document.getElementById('recoveredChart').getContext('2d');

        var chart1 = new Chart(ctx1, {
            type: 'line',
            data: {
                datasets: [{
                    label: 'Recovered',
                    borderColor: "#09ad95",
                    pointBorderColor: "#09ad95",
                    pointBackgroundColor: "#09ad95",
                    pointHoverBackgroundColor: "#09ad95",
                    pointHoverBorderColor: "#09ad95",
                    pointBorderWidth: 3,
                    pointHoverRadius: 3,
                    pointHoverBorderWidth: 1,
                    pointRadius: 2,
                    fill: false,
                    borderWidth: 3,
                    data: historyData.map(item => ({t: new Date(item.Date), y: item.Recovered})),
                },
            ]
            },
            options: {
                tooltips: {
                    intersect: false
                },
                legend: {
                    display: false,
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
                        type: "time",
                        time: {
                            unit: "day"
                        },
                        gridLines: {
                            zeroLineColor: "transparent"},
                        ticks: {
                            padding: 20,
                            fontColor: "rgba(0,0,0,0.5)",
                            fontStyle: "bold",
                        },
                    }]
                }
            }
        });

    @endisset
</script>
@endpush