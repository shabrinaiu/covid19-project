<div class="row" id="chart">
    <div class="col-lg-12">
        <div class="ibox ">
            <div class="ibox-title">
                <h5>Statistic data history last 30 days</h5>
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
                    <canvas id="confirmedChart" style="height:20%; width:80%"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row" id="chart">
    <div class="col-lg-12">
        <div class="ibox ">
            <div class="ibox-title">
                <h5>Statistic data history last 30 days</h5>
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
<div class="row" id="chart">
    <div class="col-lg-12">
        <div class="ibox ">
            <div class="ibox-title">
                <h5>Statistic data history last 30 days</h5>
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

<script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
<!-- select2 -->
<script src="{{URL::asset('theme/js/plugins/select2/select2.full.min.js')}}"></script>
<script>
@isset($historyData)
    var ctx = document.getElementById('confirmedChart').getContext('2d');
    const historyData = {!! json_encode($historyData) !!}
    const data = {!! json_encode($data) !!}
    
    console.log(historyData);
    console.log(historyData.map(item => {
                const d = new Date(item.Date)
                return `${d.day}-${d.month}`}))
    console.log(historyData.map(item => item.Confirmed))

    var chart = new Chart(ctx, {
        type: 'line',
        data: {
            datasets: [{
                label: 'Confirmed',
                borderColor: "#f82649",
                pointBorderColor: "#f82649",
                pointBackgroundColor: "#f82649",
                pointHoverBackgroundColor: "#f82649",
                pointHoverBorderColor: "#f82649",
                pointBorderWidth: 5,
                pointHoverRadius: 5,
                pointHoverBorderWidth: 1,
                pointRadius: 2,
                fill: false,
                borderWidth: 3,
                data: historyData.map(item => ({t: new Date(item.Date), y: item.Confirmed})),
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
    Chart.defaults.LineWithLine = Chart.defaults.line;
    Chart.controllers.LineWithLine = Chart.controllers.line.extend({
        draw: function(ease) {
            Chart.controllers.line.prototype.draw.call(this, ease);
    
            if (this.chart.tooltip._active && this.chart.tooltip._active.length) {
            var activePoint = this.chart.tooltip._active[0],
                ctx = this.chart.ctx,
                x = activePoint.tooltipPosition().x,
                topY = this.chart.scales['y-axis-0'].top,
                bottomY = this.chart.scales['y-axis-0'].bottom;
    
            // draw line
                ctx.save();
                ctx.beginPath();
                ctx.moveTo(x, topY);
                ctx.lineTo(x, bottomY);
                ctx.lineWidth = 2;
                ctx.strokeStyle = 'transparent';
                ctx.stroke();
                ctx.restore();
            }
        }
    });
@endisset
</script>
<!-- 
<script>
@isset($historyData)
    var ctx1 = document.getElementById('recoveredChart').getContext('2d');
    const historyData = {!! json_encode($historyData) !!}
    const data = {!! json_encode($data) !!}
    
    console.log(historyData);
    console.log(historyData.map(item => {
                const d = new Date(item.Date)
                return `${d.day}-${d.month}`}))
    console.log(historyData.map(item => item.Confirmed))

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
                pointBorderWidth: 5,
                pointHoverRadius: 5,
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
    Chart1.defaults.LineWithLine = Chart1.defaults.line;
    Chart1.controllers.LineWithLine = Chart1.controllers.line.extend({
        draw: function(ease) {
            Chart1.controllers.line.prototype.draw.call(this, ease);
    
            if (this.chart.tooltip._active && this.chart1.tooltip._active.length) {
            var activePoint = this.chart1.tooltip._active[0],
                ctx1 = this.chart1.ctx1,
                x = activePoint.tooltipPosition().x,
                topY = this.chart1.scales['y-axis-0'].top,
                bottomY = this.chart1.scales['y-axis-0'].bottom;
    
            // draw line
                ctx1.save();
                ctx1.beginPath();
                ctx1.moveTo(x, topY);
                ctx1.lineTo(x, bottomY);
                ctx1.lineWidth = 2;
                ctx1.strokeStyle = 'transparent';
                ctx1.stroke();
                ctx1.restore();
            }
        }
    });
@endisset
</script>

<script>
@isset($historyData)
    var ctx2 = document.getElementById('deathsChart').getContext('2d');
    const historyData = {!! json_encode($historyData) !!}
    const data = {!! json_encode($data) !!}
    
    console.log(historyData);
    console.log(historyData.map(item => {
                const d = new Date(item.Date)
                return `${d.day}-${d.month}`}))
    console.log(historyData.map(item => item.Confirmed))

    var chart = new Chart(ctx2, {
        type: 'line',
        data: {
            datasets: [{
                label: 'Deaths',
                borderColor: "#d43f8d",
                pointBorderColor: "#d43f8d",
                pointBackgroundColor: "#d43f8d",
                pointHoverBackgroundColor: "#d43f8d",
                pointHoverBorderColor: "#d43f8d",
                pointBorderWidth: 5,
                pointHoverRadius: 5,
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
    Chart.defaults.LineWithLine = Chart.defaults.line;
    Chart.controllers.LineWithLine = Chart.controllers.line.extend({
        draw: function(ease) {
            Chart.controllers.line.prototype.draw.call(this, ease);
    
            if (this.chart.tooltip._active && this.chart.tooltip._active.length) {
            var activePoint = this.chart.tooltip._active[0],
                ctx2 = this.chart.ctx2,
                x = activePoint.tooltipPosition().x,
                topY = this.chart.scales['y-axis-0'].top,
                bottomY = this.chart.scales['y-axis-0'].bottom;
    
            // draw line
                ctx2.save();
                ctx2.beginPath();
                ctx2.moveTo(x, topY);
                ctx2.lineTo(x, bottomY);
                ctx2.lineWidth = 2;
                ctx2.strokeStyle = 'transparent';
                ctx2.stroke();
                ctx2.restore();
            }
        }
    });
@endisset 
</script>-->
