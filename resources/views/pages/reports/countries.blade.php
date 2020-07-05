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
            <h4 class="text-left">Covid-19 Statistics data of {{(isset($currentData['Country']) ? $currentData['Country'] : 'a country')}}</h4>
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
        <div class="ibox">
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
                <h5>Confirmed data history last 30 days</h5>
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
                <h5>Recovered data history last 30 days</h5>
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
                <h5>Deaths data history last 30 days</h5>
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

<div class="row">
    <div class="col-lg-12">
        <div class="ibox ">
            <div class="ibox-title">
                <h4 class="text-center">Covid-19 Latest Data All Countries</h4>

                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-footer">

                @isset($modals)
                    {{$modals}}
                @endisset

                <div class="table-responsive">
                    <table id="" class="table table-hover text-center dataTables-example">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Country Name</th>
                            <th>Country Code</th>
                            <th>New Confirmed</th>
                            <th>Total Confirmed</th>
                            <th>New Deaths</th>
                            <th>Total Deaths</th>
                            <th>New Recovered</th>
                            <th>Total Recovered</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $i = 0; @endphp
                        @foreach($data as $datum)
                            @php $i++; @endphp
                            <tr>
                                <td>{{$i}}</td>
                                <td>{{$datum['Country']}}</td>
                                <td>{{$datum['CountryCode']}}</td>
                                <td>{{$datum['NewConfirmed']}}</td>
                                <td>{{$datum['TotalConfirmed']}}</td>
                                <td>{{$datum['NewDeaths']}}</td>
                                <td>{{$datum['TotalDeaths']}}</td>
                                <td>{{$datum['NewRecovered']}}</td>
                                <td>{{$datum['TotalRecovered']}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>

    @push('footer-scripts')
        <!-- Numeral JS -->
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
                        pointBorderWidth: 3,
                        pointHoverRadius: 3,
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