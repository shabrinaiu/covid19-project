@extends('layouts.master')

@push('header-scripts')
    <link href="{{URL::asset('theme/css/plugins/select2/select2.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('theme/css/plugins/select2/select2-bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('theme/css/plugins/datapicker/datepicker3.css')}}" rel="stylesheet">
    <link href="{{URL::asset('theme/css/plugins/morris/morris-0.4.3.min.css')}}" rel="stylesheet">
@endpush

<form action="/reports/compare" method="post" id="compare-countries">
@csrf
@section('page-heading')
    <div class="row wrapper page-heading">
        <div class="col-md-12 vertical-align-middle">
            <h2>Perbandingan Data Banyak Negara</h2>
        </div>
    </div>
    <div class="row wrapper page-heading">
        <div class="col-md-4 vertical-align-middle">
            <h3>Pilih 2 Negara untuk perbandingan</h3>
        </div>
        <div class="col-md-4">
            <select class="select2_country form-control country" required name="mainCountry">
                @isset($data)
                    @foreach ($data as $row)
                        <option value="" disabled selected></option>
                        <option value="{{$row['Slug']}}">{{$row['Country']}}</option>
                    @endforeach                    
                @endisset
            </select>
        </div>
        <div class="col-md-4">
            <select class="select2_country form-control country" required name="comparedCountry">
                @isset($data)
                    @foreach ($data as $row)
                        <option value="" disabled selected></option>
                        <option value="{{$row['Slug']}}">{{$row['Country']}}</option>
                    @endforeach                    
                @endisset
            </select>
        </div>
    </div>
    <div class="row wrapper page-heading">
        <div class="col-md-4 vertical-align-middle">
            <h3>Pilih Periode Data</h3>
        </div>
        <div class="col-md-7">
            <input type="number" required placeholder="" name="count" class="form-control">
        </div>
        <div class="col-md-1">
            <button type="button" class="btn btn-primary" id="submitButton">Submit</button>
        </div>
    </div>
@endsection

@section('content')

<div id="contentWrapper">   
    @isset($correlations)
        <div class="row" id="table-stats">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h4 class="text-center font-weight-bold" id="TableTitle">Table of Correlations</h4>
        
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
                                    <th>Time Shift</th>
                                    <th>Coefficient of Correlation</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php $i = 0; @endphp
                                @foreach($correlations as $i => $corr)
                                    @php $i++; @endphp
                                    <tr 
                                    @if ($i == ($maxIndex+1))
                                        class="font-weight-bold bg-success text-white"
                                    @endif>
                                        <td>{{$i}}</td>
                                        <td>{{$corr}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset

    @isset($getComparedHistoryData)
        @component('components.comparisonChart.confirmedChart', ['getMainHistoryData' => $getMainHistoryData, 'getComparedHistoryData' => $getComparedHistoryData])
        @endcomponent

        @component('components.comparisonChart.recoveredChart', ['getMainHistoryData' => $getMainHistoryData, 'getComparedHistoryData' => $getComparedHistoryData])
        @endcomponent

        @component('components.comparisonChart.deathsChart', ['getMainHistoryData' => $getMainHistoryData, 'getComparedHistoryData' => $getComparedHistoryData])
        @endcomponent
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
                // var selectedCountries = $("select.countries").val();
                // console.log(selectedCountries)
                $('#compare-countries').submit();
            });

        });

    </script>
    @endpush
@endsection