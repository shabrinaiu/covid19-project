@extends('layouts.master')

@push('header-scripts')
    <link href="{{URL::asset('theme/css/plugins/select2/select2.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('theme/css/plugins/select2/select2-bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('theme/css/plugins/datapicker/datepicker3.css')}}" rel="stylesheet">
    <link href="{{URL::asset('theme/css/plugins/morris/morris-0.4.3.min.css')}}" rel="stylesheet">
@endpush

@section('content')
    <div class="row wrapper page-heading">
        <div class="col-md-12 vertical-align-middle">
            <h2>Jumlah Kasus COVID-19 di Indonesia</h2>
        </div>
    </div>
    <form action="{{ route('predictions.indonesia.date-filter') }}" method="POST">
        @csrf
        @method('POST')
        <div class="row wrapper page-heading">
            <div class="col-md-4 vertical-align-middle">
                <h3>Input Tanggal</h3>
            </div>
            <div class="col-md-6">
                <input type="date" required placeholder="" name="date" class="form-control @error('date') is-invalid @enderror">
                @error('date')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
            <div class="col-md-1">
                <button type="submit" class="btn btn-primary" id="submitButton">Submit</button>
            </div>
        </div>
    </form>
    <div class="row mb-8 wrapper page-heading">
        <div class="col-md-4">
            <div class="card card-confirmed">
                <div class="card-body">
                    <h2 class="card-title text-warning" id="confirmed">{{ $data->details->sum('confirmed') ?? 'data belum diterima' }}</h2>
                    <h6 class="card-subtitle mb-2 text-muted"></h6>
                    <h4 class="card-text">Patient Confirmed</h4>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-recovered">
                <div class="card-body">
                    <h2 class="card-title text-success" id="recovered">{{ $data->details->sum('recovered') ?? 'data belum diterima' }}</h2>
                    <h6 class="card-subtitle mb-2 text-muted"></h6>
                    <h4 class="card-text">Patient Recovered</h4>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-deaths">
                <div class="card-body">
                    <h2 class="card-title text-danger" id="deaths">{{ $data->details->sum('deaths') ?? 'data belum diterima' }}</h2>
                    <h6 class="card-subtitle mb-2 text-muted"></h6>
                    <h4 class="card-text">Patient Deaths</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="row wrapper page-heading">
        <div class="col-md-12 vertical-align-center">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>Nilai Parameter</h5>
                </div>
                <div class="ibox-footer">
                    <p><b>Parameter Betha   :</b> {{ $betha }}</p>
                    <p><b>Parameter Gamma   :</b> {{ $gamma }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row wrapper page-heading">
        <div class="col-md-12 vertical-align-middle">
            <h2>Hitung Prediksi Jumlah Kasus COVID-19 di Indonesia</h2>
        </div>
    </div>
    <div class="row wrapper page-heading">
            <div class="col-md-4 vertical-align-middle">
                <h3>Input Periode Tanggal</h3>
            </div>
            <div class="col-md-4">
                <input type="date" required placeholder="" name="date" class="form-control @error('date') is-invalid @enderror">
                @error('date')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
            <div class="col-md-4">
                <input type="date" required placeholder="" name="date" class="form-control @error('date') is-invalid @enderror">
                @error('date')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
    </div>
    <div class="row wrapper page-heading">
        <div class="col-md-4 vertical-align-middle">
            <h3> Jumlah Populasi (N)</h3>
        </div>
        <div class="col-md-8">
            <input type="number" placeholder="" name="response_value" class="form-control @error('response_value') is-invalid @enderror">
            @error('response_value')
              <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>
    </div>

    <div class="row wrapper page-heading">
        <div class="col-md-4 vertical-align-middle">
            <h3> Jumlah Suspected (S)</h3>
        </div>
        <div class="col-md-8">
            <input type="number" placeholder="" name="response_value" class="form-control @error('response_value') is-invalid @enderror">
            @error('response_value')
              <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>
    </div>

    <div class="row wrapper page-heading">
        <div class="col-md-4 vertical-align-middle">
            <h3> Jumlah Infected (I)</h3>
        </div>
        <div class="col-md-8">
            <input type="number" placeholder="" name="response_value" class="form-control @error('response_value') is-invalid @enderror">
            @error('response_value')
              <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>
    </div>

    <div class="row wrapper page-heading">
        <div class="col-md-4 vertical-align-middle">
            <h3> Jumlah Recovered (R)</h3>
        </div>
        <div class="col-md-8">
            <input type="number" placeholder="" name="response_value" class="form-control @error('response_value') is-invalid @enderror">
            @error('response_value')
              <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>
    </div>
    <div class="row wrapper page-heading">
        <div class="col-md-12 vertical-align-middle">
            <button type="submit" class="btn btn-primary" id="submitButton">Hitung Prediksi</button>
        </div>
    </div>
    
    @push('footer-scripts')
    <!-- DataMaps -->
    <script src="js/plugins/typehead/bootstrap3-typeahead.min.js"></script>
    <script src="js/plugins/d3/d3.min.js"></script>
    <script src="js/plugins/topojson/topojson.js"></script>
    <script src="js/plugins/datamaps/datamaps.all.min.js"></script>
    @endpush

@endsection

@section('content')

<div id="contentWrapper">   
    @isset($predictions)
        <div class="row" id="table-stats">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h4 class="text-center font-weight-bold" id="TableTitle">Tabel Prediksi</h4>
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
                                    <th>Hari ke-</th>
                                    <th>Prediksi</th>
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

        });

    </script>
    @endpush
@endsection