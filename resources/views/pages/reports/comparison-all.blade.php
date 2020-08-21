@extends('layouts.master')

@push('header-scripts')
    <link href="{{URL::asset('theme/css/plugins/select2/select2.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('theme/css/plugins/select2/select2-bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('theme/css/plugins/datapicker/datepicker3.css')}}" rel="stylesheet">
    <link href="{{URL::asset('theme/css/plugins/morris/morris-0.4.3.min.css')}}" rel="stylesheet">
@endpush

@section('page-heading')
    <form action="/reports/compare-all" method="post" id="compare-countries">
    @csrf
    <div class="row wrapper page-heading">
        <div class="col-md-12 vertical-align-middle">
            <h2>Mencari Relasi terdekat Suatu Negara</h2>
        </div>
    </div>
    <div class="row wrapper page-heading">
        <div class="col-md-2 vertical-align-middle">
            <h3>Pilih Negara</h3>
        </div>
        <div class="col-md-3 mr-1">
            <select class="select2_country form-control country @error('mainCountry') is-invalid @enderror" required name="mainCountry">
                @isset($data)
                    @foreach ($data as $row)
                        <option value="" disabled selected></option>
                        <option value="{{$row['Slug']}}">{{$row['Country']}}</option>
                    @endforeach
                @endisset
            </select>
            @error('mainCountry')
                <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>
        <div class="ml-1 col-md-2">
            <h3>Pilih Periode Data (hari)</h3>
        </div>
        <div class="col-md-3">
            <input type="number" min="15" required placeholder="" name="count" class="form-control @error('count') is-invalid @enderror">
            @error('count')
              <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>
        <div class="col-md-1">
            <button type="button" class="btn btn-primary" id="submitButton">Submit</button>
        </div>
    </div>
    </form>
@endsection

@section('content')

<div id="contentWrapper">
    @isset($maxCorrelation)
    <div class="row" id="table-stats">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h4 class="text-center font-weight-bold" id="TableTitle">Table of Maximum Correlations</h4>

                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-footer">
                    <div class="table-responsive">
                        <table id="" class="table table-hover text-center dataTables-example">
                            <thead>
                            <tr>
                                <th>Country Name</th>
                                <th>Day-n (date)</th>
                                <th>Coefficient of Correlation</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($datatableMaxCorr as $row)
                                    <tr
                                    @isset ($row['max_index'])
                                    class="font-weight-bold bg-success text-white"
                                    @endisset>
                                        <td>{{$row['country_name']}}</td>
                                        <td>day-{{$row['day']}} on {{$row['date']}}</td>
                                        <td>{{$row['max_correlation']}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tabs-container">
        <ul class="nav nav-tabs" role="tablist">
            @foreach ($getComparedHistoryData as $i => $countryData)
                <li><a class="nav-link" data-toggle="tab" href="#country-{{$i}}">{{$comparedCountryNames[$i]}}</a></li>
            @endforeach
        </ul>
        <div class="tab-content">
            @foreach ($getComparedHistoryData as $i => $countryData)
                <div role="tabpanel" id="country-{{$i}}" class="tab-pane">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h3 class="text-center font-weight-bold">
                                {{$comparedCountryNames[$i]}} with {{$mainCountryName}}
                            </h3>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-footer" id="ibox_ost">
                            <div class="mb-2">
                                <h5 class="font-weight-bold">*Highest correlation between
                                    {{$comparedCountryNames[$i]}} and {{$mainCountryName}} is {{$maxCorrelation[$i]}}
                                </h5>
                            </div>
                            <div class="mt-1 mb-1 p-1">
                                <div class="card">
                                    <div class="card-header text-center">
                                        Confirmed Data Chart
                                    </div>
                                    <div class="card-body">
                                        <div id="morris-line-chart-confirmed-{{$i}}"></div>
                                        @component('components.allComparisonChart.confirmedChart', ['getMainHistoryData' => $getMainHistoryData, 'getComparedHistoryData' => $countryData,
                                                    'idx' => $i, 'mainCountryName' => $mainCountryName, 'comparedCountryName' => $comparedCountryNames[$i]])
                                        @endcomponent
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            @endforeach
        </div>
    </div>
    @endisset



</div>

    @push('footer-scripts')
    <!-- ChartJS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
    <script src="{{URL::asset('theme/js/plugins/datapicker/bootstrap-datepicker.js')}}"></script>

    {{-- MorrisJS --}}
    <script src="{{URL::asset('theme/js/plugins/morris/raphael-2.1.0.min.js')}}"></script>
    <script src="{{URL::asset('theme/js/plugins/morris/morris.js')}}"></script>

    <script>

        $(document).ready(function () {
            $('#contentWrapper').hide();

            @isset($getComparedHistoryData)
                $('#contentWrapper').show();
            @endisset

            $(".select2_country").select2({
                theme: 'bootstrap4',
                placeholder: "Select a target country",
                // allowClear: true
            });

            $('.input-daterange').datepicker({
                keyboardNavigation: false,
                forceParse: false,
                autoclose: true
            });

            $(".select2_countries").select2({
                theme: 'bootstrap4',
                placeholder: "Select countries here",
            });

            $("#submitButton").click(function(){
                $('#compare-countries').submit();
            });

            $('div[id^="country-"]').hover(function(){
                $(window).trigger('resize');
            });

        });

    </script>
    @endpush
@endsection
