@extends('layouts.master')

@section('navbarbreadcrumbs')
    Halaman apa ini
@endsection

@section('content')
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card card-confirmed">
                <div class="card-body">
                    <h2 class="card-title text-warning" id="confirmed">???</h2>
                    <h6 class="card-subtitle mb-2 text-muted"></h6>
                    <h4 class="card-text">patient confirmed</h4>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-recovered">
                <div class="card-body">
                    <h2 class="card-title text-success" id="recovered">???</h2>
                    <h6 class="card-subtitle mb-2 text-muted"></h6>
                    <h4 class="card-text">patient recovered</h4>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-deaths">
                <div class="card-body">
                    <h2 class="card-title text-danger" id="deaths">???</h2>
                    <h6 class="card-subtitle mb-2 text-muted"></h6>
                    <h4 class="card-text">patient deaths</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h3 class="text-center">Covid-19 Latest Data All Countries</h3>

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
                                    <td>{{$datum['Country_Region']}}</td>
                                    <td>{{$datum['NewConfirmed']}}</td>
                                    <td>{{$datum['Confirmed']}}</td>
                                    <td>{{$datum['NewDeaths']}}</td>
                                    <td>{{$datum['Deaths']}}</td>
                                    <td>{{$datum['NewRecovered']}}</td>
                                    <td>{{$datum['Recovered']}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Basic example</h5>
                </div>
            </div>
        </div>
    </div>

    @push('footer-scripts')
    <!-- DataMaps -->
    <script src="js/plugins/typehead/bootstrap3-typeahead.min.js"></script>
    <script src="js/plugins/d3/d3.min.js"></script>
    <script src="js/plugins/topojson/topojson.js"></script>
    <script src="js/plugins/datamaps/datamaps.all.min.js"></script>
    <script>
        $(document).ready(function () {
            semuaData();

            setInterval(function () {
                semuaData();
            }, 2000);

            function semuaData() {
                $.ajax({
                    url: 'https://coronavirus-19-api.herokuapp.com/all',
                    success: function (data) {
                        try {
                            var json = data;
                            var kasus = json.cases;
                            var meninggal = json.deaths;
                            var sembuh = json.recovered;

                            $('#confirmed').html(numeral(kasus).format('0,0'))
                            $('#deaths').html(numeral(meninggal).format('0,0'))
                            $('#recovered').html(numeral(sembuh).format('0,0'))
                        } catch {
                            alert('error!');
                        }
                    }

                });
            }

            var basic = new Datamap({
                element: document.getElementById("basic_map"),
                responsive: true,
                fills: {
                    defaultFill: "#DBDAD6"
                },
                geographyConfig: {
                    highlightFillColor: '#1C977A',
                    highlightBorderWidth: 0,
                },
            });

            // Resize map on window resize
            $(window).on('resize', function() {
                setTimeout(function(){
                    basic.resize();
                    selected_map.resize();
                },100)
            });


        });
    </script>
    @endpush

@endsection
