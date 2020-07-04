@extends('layouts.master')

@push('header-scripts')
    <link href="{{URL::asset('theme/css/plugins/select2/select2.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('theme/css/plugins/select2/select2-bootstrap4.min.css')}}" rel="stylesheet">
@endpush

@section('page-heading')
    @component('components.breadcrumb', ['name' => 'Reports'])
        <li class="breadcrumb-item active">
            <a href="/reports/">Reports</a>
        </li>
        <li class="breadcrumb-item active">
            <a href="/reports/countries">Countries</a>
        </li>
    @endcomponent
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-md-8">
            <h4 class="text-left">Covid-19 Statistics data of a country</h4>
        </div>
        <div class="col-md-3">
            <select class="select2_demo_3 form-control country">
                <option disabled selected>-- choose country --</option>
                @foreach ($data as $row)
                    <option value="{{$row['Slug']}}">{{$row['Country']}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-1">
            <button type="button" class="btn btn-primary" id="submitButton">Submit</button>
        </div>
    </div>
@endsection

@section('content')
<div class="row mb-2" id="currentData">
    <div class="col-lg-12">
        <div class="ibox ">
            <div class="ibox-title">
                <h4 class="text-center" id="countryTitle"><strong> Data in {{(isset($currentData['Country']) ? $currentData['Country'] : 'a country')}}</strong></h4>

                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title text-success" id="recovered">{{
                    (isset($currentData['TotalRecovered']) ? $currentData['TotalRecovered'] : 'no data exists')
                    }}</h2>
                <h6 class="card-subtitle mb-2 text-muted"></h6>
                <h4 class="card-text">patient recovered</h4>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title text-warning" id="confirmed">{{
                    (isset($currentData['TotalConfirmed']) ? $currentData['TotalConfirmed'] : 'no data exists')
                    }}</h2>
                <h6 class="card-subtitle mb-2 text-muted"></h6>
                <h4 class="card-text">patient confirmed</h4>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title text-danger" id="deaths">{{
                    (isset($currentData['TotalDeaths']) ? $currentData['TotalDeaths'] : 'no data exists')
                    }}</h2>
                <h6 class="card-subtitle mb-2 text-muted"></h6>
                <h4 class="card-text">patient deaths</h4>
            </div>
        </div>
    </div>    
</div>
<div class="row" id="chart">
    <div class="col-lg-12">
        <div class="ibox ">
            <div class="ibox-title">
                <h5>Statistic data history </h5>
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
                    <canvas id="ctx" style="height:40vh; width:70vw"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

    @push('footer-scripts')
        {{-- Numeral JS --}}
        <script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
        {{-- select2 --}}
        <script src="{{URL::asset('theme/js/plugins/select2/select2.full.min.js')}}"></script>
        <!-- ChartJS-->
        <!-- <script src="{{URL::asset('theme/js/plugins/chartJs/Chart.min.js')}}"></script> -->
        <!-- <script src="{{URL::asset('theme/js/demo/chartjs-demo.js')}}"></script> -->
        <script>
        @isset($historyData)
            var ctx = document.getElementById('ctx').getContext('2d');
            const historyData = {!! json_encode($historyData) !!}
            // const currentData = {!! json_encode($currentData) !!}
            const data = {!! json_encode($data) !!}
            
            console.log(historyData);
            // console.log(currentData);
            console.log(data);
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
                        pointBorderWidth: 10,
                        pointHoverRadius: 10,
                        pointHoverBorderWidth: 1,
                        pointRadius: 3,
                        fill: false,
                        borderWidth: 4,
                        data: historyData.map(item => ({t: new Date(item.Date), y: item.Confirmed})),
                    },
                    {
                        label: 'Recovered',
                        borderColor: "#09ad95",
                        pointBorderColor: "#09ad95",
                        pointBackgroundColor: "#09ad95",
                        pointHoverBackgroundColor: "#09ad95",
                        pointHoverBorderColor: "#09ad95",
                        pointBorderWidth: 10,
                        pointHoverRadius: 10,
                        pointHoverBorderWidth: 1,
                        pointRadius: 3,
                        fill: false,
                        borderWidth: 4,
                        data: historyData.map(item => ({t: new Date(item.Date), y: item.Recovered})),
                    },
                    {
                        label: 'Deaths',
                        borderColor: "#d43f8d",
                        pointBorderColor: "#d43f8d",
                        pointBackgroundColor: "#d43f8d",
                        pointHoverBackgroundColor: "#d43f8d",
                        pointHoverBorderColor: "#d43f8d",
                        pointBorderWidth: 10,
                        pointHoverRadius: 10,
                        pointHoverBorderWidth: 1,
                        pointRadius: 3,
                        fill: false,
                        borderWidth: 4,
                        data: historyData.map(item => ({t: new Date(item.Date), y: item.Deaths})),
                    }
                ]
                },
                options: {
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
                        }
                        {
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
                            }
                        }
                    ]
                    }
                }
            });

            // let draw = Chart.controllers.line.prototype.draw;
            // Chart.controllers.line = Chart.controllers.line.extend({
            //     draw: function() {
            //         draw.apply(this, arguments);
            //         let ctx = this.chart.chart.ctx;
            //         let _stroke = ctx.stroke;
            //         ctx.stroke = function() {
            //             ctx.save();
            //             ctx.shadowColor = "#D3E3FF";
            //             ctx.shadowBlur = 8;
            //             ctx.shadowOffsetX = 2;
            //             ctx.shadowOffsetY = 2;
            //             _stroke.apply(this, arguments)
            //             ctx.restore();
            //         }
            //     }
            // });
            
            // Chart.defaults.LineWithLine = Chart.defaults.line;
            // Chart.controllers.LineWithLine = Chart.controllers.line.extend({
            //     draw: function(ease) {
            //         Chart.controllers.line.prototype.draw.call(this, ease);
            
            //         if (this.chart.tooltip._active && this.chart.tooltip._active.length) {
            //         var activePoint = this.chart.tooltip._active[0],
            //             ctx = this.chart.ctx,
            //             x = activePoint.tooltipPosition().x,
            //             topY = this.chart.scales['y-axis-0'].top,
            //             bottomY = this.chart.scales['y-axis-0'].bottom;
            
            //         // draw line
            //             ctx.save();
            //             ctx.beginPath();
            //             ctx.moveTo(x, topY);
            //             ctx.lineTo(x, bottomY);
            //             ctx.strokeStyle = 'transparent';
            //             ctx.stroke();
            //             ctx.restore();
            //         }
            //     }
            // });
        @endisset
        </script>

        <script>
            $(document).ready(function () {

                $(".select2_demo_3").select2({
                    theme: 'bootstrap4',
                    placeholder: "Select a country",
                    allowClear: true
                });

                $('#chart').hide();
                $("#submitButton").click(function(){
                    var selectedName = $("select.country").children("option:selected").html();
                    var selectedSlug = $("select.country").children("option:selected").val();
                    $('#countryTitle').html(selectedName + ' all data');
                    var url = '/reports/countries/' + selectedSlug;
                    document.location.href=url;
                });                

                function loops(){
                    setInterval(function () {
                        semuaData();
                    }, 2000);
                }

                // menampilkan chart ketika data sudah masuk
                if( ($('#recovered').html() && $('#confirmed').html() && $('#deaths').html() ) != 'no data exists'){
                    $('#chart').show();
                }

                // number formatting
                if($('#recovered').html() != 'no data exists'){
                    let recovered = numeral($('#recovered').html()).format('0,0');
                    $('#recovered').html(recovered);
                }
                if($('#confirmed').html() != 'no data exists'){
                    let confirmed = numeral($('#confirmed').html()).format('0,0');
                    $('#confirmed').html(confirmed);
                }
                if($('#deaths').html() != 'no data exists'){
                    let deaths = numeral($('#deaths').html()).format('0,0');
                    $('#deaths').html(deaths);
                }
        
            });
    
    </script>
    @endpush

@endsection