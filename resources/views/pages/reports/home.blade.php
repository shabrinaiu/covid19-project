@extends('layouts.master')

@section('titlehalaman')
    PREDIKSI PANDEMI COVID-19
@endsection

@section('content')
    <h2 class="card-text">Total Kasus per hari ini</h2>
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

    <h2 class="card-text">Berita Terbaru</h2>
    <div class="row mb-3">
        <div class="col-md-2">
            <a href="{{route('public-response.create')}}">
                <div class="card">
                    <div style="height:200px; text-align:center" class="card-body">
                        <i class="fa fa-smile-o"></i>
                        <h3 class="card-text">Tambahkan berita baru</h3>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-5">
                <div class="card">
                    <div style="height:200px" class="card-body">
                        <h3 class="card-text">Prediksi Global</h3>
                    </div>
                </div>
        </div>
        <div class="col-md-5">
                <div class="card">
                    <div style="height:200px" class="card-body">
                        <h3 class="card-text">Prediksi Indonesia</h3>
                    </div>
                </div>
        </div>
    </div>

    <h2 class="card-text">Menu</h2>
    <div class="row mb-3">
        <div class="col-md-6">
            <a href="{{route('reports.index')}}">
                <div class="card">
                    <div style="text-align:center" class="card-body">
                        <i class="fa fa-smile-o"></i>
                        <h3 class="card-text">Prediksi Global</h3>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-6">
            <a href="{{ route('predictions.indonesia.index') }}">
                <div class="card">
                    <div style="text-align:center" class="card-body">
                        <i class="fa fa-smile-o"></i>
                        <h3 class="card-text">Prediksi Indonesia</h3>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <a href="{{ route('compare-all.index')}}">
                <div class="card">
                    <div style="text-align:center" class="card-body">
                        <i class="fa fa-smile-o"></i>
                        <h3 class="card-text">Perhitungan Korelasi kasus 2 Negara</h3>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-6">
            <a href="{{ route('compare.index')}}">
                <div class="card">
                    <div style="text-align:center" class="card-body">
                        <i class="fa fa-smile-o"></i>
                        <h3 class="card-text">Perhitungan Komparasi kasus 2 Negara</h3>
                    </div>
                </div>
            </a>
        </div>
    </div>

    @push('footer-scripts')
    <script>
        <script src="{{URL::asset('theme/js/plugins/slick/slick.min.js')}}"></script>
        <script src="{{URL::asset('theme/js/plugins/metisMenu/jquery.metisMenu.js')}}"></script>
        <script src="{{URL::asset('theme/js/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>
        <script src="{{URL::asset('theme/js/inspinia.js')}}"></script>
        <script src="{{URL::asset('theme/js/plugins/pace/pace.min.js')}}"></script>
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

    </script>
    @endpush
@endsection
