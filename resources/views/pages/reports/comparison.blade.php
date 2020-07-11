@extends('layouts.master')

@push('header-scripts')
    <link href="{{URL::asset('theme/css/plugins/select2/select2.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('theme/css/plugins/select2/select2-bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('theme/css/plugins/datapicker/datepicker3.css')}}" rel="stylesheet">
@endpush

@section('page-heading')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-md-8 vertical-align-middle">
            <h3>Covid-19 Statistics data of {{(isset($currentData['Country_Region']) ? $currentData['Country_Region'] : 'a country')}}</h3>
        </div>
        <div class="col-md-3">
            <select class="select2_demo_2 form-control countries" multiple="multiple">
                @isset($data)
                    @foreach ($data as $row)
                        <option value="" disabled></option>
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

    <div class="row" id="chart1">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Confirmed data history</h5>
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
                    <div class="form-group" id="data_5">
                        <label class="font-normal">Range select</label>
                        <div class="input-daterange input-group" id="datepicker">
                            <input type="text" class="form-control-sm form-control" id="start-date" name="start" value="05/14/2014"/>
                            <span class="input-group-addon">to</span>
                            <input type="text" class="form-control-sm form-control" id="end-date" name="end" value="05/22/2014" />
                        </div>
                    </div>
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
    <script src="{{URL::asset('theme/js/plugins/datapicker/bootstrap-datepicker.js')}}"></script>

    <script>
        
        $(document).ready(function () {
            $('#data_5 .input-daterange').datepicker({
                keyboardNavigation: false,
                forceParse: false,
                autoclose: true
            });

            $(".select2_demo_2").select2({
                placeholder: "Select a country",
            });

            $("#submitButton").click(function(){
                // var selectedCountries = $("select.countries").val();
                // console.log(selectedCountries)
                var selectedCountries = $("#start-date").val();
                var url = '/reports/compare/' + selectedCountries;
                document.location.href=url;
            });

        });

    </script>
    @endpush
@endsection