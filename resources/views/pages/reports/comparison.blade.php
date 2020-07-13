@extends('layouts.master')

@push('header-scripts')
    <link href="{{URL::asset('theme/css/plugins/select2/select2.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('theme/css/plugins/select2/select2-bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('theme/css/plugins/datapicker/datepicker3.css')}}" rel="stylesheet">
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
            <h3>Select main data of {{(isset($currentData['Country_Region']) ? $currentData['Country_Region'] : 'a country')}}</h3>
        </div>
        <div class="col-md-8">
            <select class="select2_country form-control country" name="mainCountry">
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
            <h3>Select Multiple Data for Comparison</h3>
        </div>
        <div class="col-md-8">
            <select class="select2_countries form-control" multiple="multiple" name="countries[]">
                @isset($data)
                    @foreach ($data as $row)
                        <option value="" disabled></option>
                        <option value="{{$row['Slug']}}">{{$row['Country']}}</option>
                    @endforeach
                @endisset
            </select>
        </div>
    </div>
    <div class="row wrapper page-heading">
        <div class="col-md-4 vertical-align-middle">
            <h3>Select Range Date</h3>
        </div>
        <div class="col-md-7">
            <div class="input-daterange input-group" id="datepicker">
                <input type="text" class="form-control-sm form-control" id="start-date" name="start" value="03/14/2020"/>
                <span class="ml-2 mr-2">to</span>
                <input type="text" class="form-control-sm form-control" id="end-date" name="end" value="03/22/2020" />
            </div>
        </div>
        <div class="col-md-1">
            <button type="button" class="btn btn-primary" id="submitButton">Submit</button>
        </div>
    </div>
@endsection

@section('content')
    <div id="contentWrapper">
        <div class="row" id="table-stats">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h3 class="text-center" id="TableTitle">Confirmed Comparison</h3>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-footer">
                        <div class="table-responsive">
                            @isset($results['confirmed'])
                                <table id="" class="table table-hover text-center dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Date</th>
                                            <th>Country A</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>#</td>
                                            <td>Date</td>
                                            <th>Country A</th>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td>#</td>
                                            <td>Date</td>
                                            <th>Country A</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            @endisset
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        
        <div class="row" id="table-stats">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h3 class="text-center" id="TableTitle">Recovered Comparison</h3>

                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-footer">
                        <div class="table-responsive">
                            @isset($results['recovered'])
                                <table id="" class="table table-hover text-center dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Date</th>
                                            <th>Country A</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>#</td>
                                            <td>Date</td>
                                            <th>Country A</th>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td>#</td>
                                            <td>Date</td>
                                            <th>Country A</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            @endisset
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="row" id="table-stats">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h3 class="text-center" id="TableTitle">Deaths Comparison</h3>

                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-footer">
                        <div class="table-responsive">
                            @isset($results['deaths'])
                                <table id="" class="table table-hover text-center dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Date</th>
                                            <th>Country A</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>#</td>
                                            <td>Date</td>
                                            <th>Country A</th>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td>#</td>
                                            <td>Date</td>
                                            <th>Country A</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            @endisset
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('footer-scripts')
    <!-- ChartJS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>        
    <script src="{{URL::asset('theme/js/plugins/datapicker/bootstrap-datepicker.js')}}"></script>

    <script>
        
        $(document).ready(function () {
            $('#contentWrapper').hide();

            @isset($results)
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