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
            <a href="/reports/global">Global</a>
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
<div class="row mb-4">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title text-success" id="recovered">Recovered</h2>
                <h6 class="card-subtitle mb-2 text-muted"></h6>
                <h4 class="card-text">patient recovered</h4>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title text-warning" id="confirmed">Confirmed</h2>
                <h6 class="card-subtitle mb-2 text-muted"></h6>
                <h4 class="card-text">patient confirmed</h4>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title text-danger" id="deaths">Deaths</h2>
                <h6 class="card-subtitle mb-2 text-muted"></h6>
                <h4 class="card-text">patient deaths</p>
            </div>
        </div>
    </div>
</div>
    @include('components.chart')

    @push('footer-scripts')
        {{-- select2 --}}
        <script src="{{URL::asset('theme/js/plugins/select2/select2.full.min.js')}}"></script>
        <!-- ChartJS-->
        <script src="{{URL::asset('theme/js/plugins/chartJs/Chart.min.js')}}"></script>
        <script src="{{URL::asset('theme/js/demo/chartjs-demo.js')}}"></script>

        <script>

            $(document).ready(function() {
                
                $("#submitButton").click(function(){
                    var selectedSlug = $("select.country").children("option:selected").val();
                    alert("You have selected the country - " + selectedSlug);
                });

                $(".select2_demo_3").select2({
                    theme: 'bootstrap4',
                    placeholder: "Select a country",
                    allowClear: true
                });
            })

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

                            $('#confirmed').html(kasus)
                            $('#deaths').html(meninggal)
                            $('#recovered').html(sembuh)
                        } catch {
                            alert('error!');
                        }
                    }

                });
            }
        
            });
    
    </script>
    @endpush

@endsection