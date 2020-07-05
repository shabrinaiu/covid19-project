<div class="row" id="chart3">
    <div class="col-lg-12">
        <div class="ibox ">
            <div class="ibox-title">
                <h5>Deaths data history</h5>
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
                    <canvas id="deathsChart" style="height:20%; width:80%"></canvas>
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
        console.log(historyData);

        var ctx2 = document.getElementById('deathsChart').getContext('2d');

        var chart2 = new Chart(ctx2, {
            type: 'line',
            data: {
                datasets: [{
                    label: 'Deaths',
                    borderColor: "#d43f8d",
                    pointBorderColor: "#d43f8d",
                    pointBackgroundColor: "#d43f8d",
                    pointHoverBackgroundColor: "#d43f8d",
                    pointHoverBorderColor: "#d43f8d",
                    pointBorderWidth: 3,
                    pointHoverRadius: 3,
                    pointHoverBorderWidth: 1,
                    pointRadius: 2,
                    fill: false,
                    borderWidth: 3,
                    data: historyData.map(item => ({t: new Date(item.Date), y: item.Deaths})),
                }]
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