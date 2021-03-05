@extends('layouts.master')

@push('header-scripts')
    <link href="{{URL::asset('theme/css/plugins/select2/select2.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('theme/css/plugins/select2/select2-bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('theme/css/plugins/datapicker/datepicker3.css')}}" rel="stylesheet">
    <link href="{{URL::asset('theme/css/plugins/morris/morris-0.4.3.min.css')}}" rel="stylesheet">
@endpush

@section('page-heading')
    <form action=" " method="post" id=" ">
    @csrf
    <div class="row wrapper page-heading">
        <div class="col-md-12 vertical-align-middle">
            <h2>Prediksi Jumlah Kasus COVID-19 di Indonesia</h2>
        </div>
    </div>
    <div class="row wrapper page-heading">
        <div class="col-md-4 vertical-align-middle">
            <h3>Pilih Periode Tanggal</h3>
        </div>
        <div class="col-md-4">
            <input type="date"  placeholder="" name="sart_date" class="form-control @error('sart_date') is-invalid @enderror">
            @error('start_date')
            <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>
        <div class="col-md-4">
        <div class="col-md-4">
            <input type="date"  placeholder="" name="end_date" class="form-control @error('end_date') is-invalid @enderror">
            @error('end_date')
            <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>
        </div>
    </div>
    <div class="row wrapper page-heading">
        <div class="col-md-4 vertical-align-middle">
            <h3>Suspected (S)</h3>
        </div>
        <div class="col-md-7">
            <input type="number" min="100" required placeholder="" name="count" class="form-control @error('count') is-invalid @enderror">
            @error('count')
              <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>
        <div class="col-md-4 vertical-align-middle">
            <h3>Infected (I)</h3>
        </div>
        <div class="col-md-7">
            <input type="number" min="100" required placeholder="" name="count" class="form-control @error('count') is-invalid @enderror">
            @error('count')
              <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>
        <div class="col-md-4 vertical-align-middle">
            <h3>Recovered (R)</h3>
        </div>
        <div class="col-md-7">
            <input type="number" min="100" required placeholder="" name="count" class="form-control @error('count') is-invalid @enderror">
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