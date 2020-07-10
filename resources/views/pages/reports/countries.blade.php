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
        <div class="col-md-8 vertical-align-middle">
            <h3>Covid-19 Statistics data of {{(isset($currentData['Country_Region']) ? $currentData['Country_Region'] : 'a country')}}</h3>
        </div>
        <div class="col-md-3">
            <select class="select2_demo_3 form-control country">
                @isset($data)
                    @foreach ($data as $row)
                        <option value="" disabled selected></option>
                        <option value="{{$row['Slug']}}">{{$row['Country']}}</option>
                    @endforeach                    
                @endisset
            </select>
        </div>
        <div class="col-md-1">
            <button type="button" class="btn btn-primary" id="submitButton">Submit</button>
        </div>
    </div>
@endsection

@section('content')
<div class="row mb-2" id="currentData">
    <div class="col-md-4">
        <div class="card card-confirmed">
            <div class="card-body">
                <h2 class="card-title text-success" id="recovered">{{
                    (isset($currentData['Recovered']) ? $currentData['Recovered'] : 'no data exists')
                    }}</h2>
                <h6 class="card-subtitle mb-2 text-muted"></h6>
                <h4 class="card-text">patient recovered</h4>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-recovered">
            <div class="card-body">
                <h2 class="card-title text-warning" id="confirmed">{{
                    (isset($currentData['Confirmed']) ? $currentData['Confirmed'] : 'no data exists')
                    }}</h2>
                <h6 class="card-subtitle mb-2 text-muted"></h6>
                <h4 class="card-text">patient confirmed</h4>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-deaths">
            <div class="card-body">
                <h2 class="card-title text-danger" id="deaths">{{
                    (isset($currentData['Deaths']) ? $currentData['Deaths'] : 'no data exists')
                    }}</h2>
                <h6 class="card-subtitle mb-2 text-muted"></h6>
                <h4 class="card-text">patient deaths</h4>
            </div>
        </div>
    </div>    
</div>

@isset($historyData)
    @component('components.confirmedChart', ['historyData' => $historyData, 'data' => $data])
    @endcomponent

    @component('components.recoveredChart', ['historyData' => $historyData, 'data' => $data])
    @endcomponent

    @component('components.deathChart', ['historyData' => $historyData, 'data' => $data])
    @endcomponent

    @component('components.tableStats', ['historyData' => $historyData])
    @endcomponent

@endisset

    @push('footer-scripts')
        <!-- ChartJS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>        

        <script>
            
            $(document).ready(function () {

                $(".select2_demo_3").select2({
                    theme: 'bootstrap4',
                    placeholder: "Select a country",
                    // allowClear: true
                });

                $("#submitButton").click(function(){
                    var selectedName = $("select.country").children("option:selected").html();
                    var selectedSlug = $("select.country").children("option:selected").val();
                    $('#countryTitle').html(selectedName + ' all data');
                    var url = '/reports/countries/' + selectedSlug;
                    document.location.href=url;
                });          

                // menampilkan chart ketika data sudah masuk
                if( ($('#recovered').html() && $('#confirmed').html() && $('#deaths').html() ) == 'no data exists'){
                    $('#table-stats').hide();
                    $('#chart1').hide();
                    $('#chart2').hide();
                    $('#chart3').hide();
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