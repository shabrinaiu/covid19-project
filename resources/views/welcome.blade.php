@extends('layouts.master')

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
            <div class="card">
                <div class="card-header">
                    <h2>Berita Seputar COVID-19</h2>
                </div>
                <div class="card-body text-justify">
                    
                </div>
            </div>
        </div>
        <div class="col-md-5 vertical-align-middle d-flex justify-content-end">
            <button type="button" class="btn btn-primary" id="submitButton"><strong>Input Berita</strong></button>
        </div>
    </div>

    <div class="col-md-4 vertical-align-middle">
            <h3>Prediksi COVID-19</h3>
        </div>
    <div class="row mb-6">
        <div class="col-md-6">
            <div class="card card-confirmed">
                <div class="card-body">
                    <h2 class="card-title text-warning" id="confirmed"> Indonesia</h2>
                   
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card card-recovered">
                <div class="card-body">
                    <h2 class="card-title text-success" id="recovered"> Global</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-6">
        <div class="col-md-6">
            <div class="card card-confirmed">
                <div class="card-body">
                    <h2 class="card-title text-warning" id="confirmed">Comparsion</h2>
                   
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card card-recovered">
                <div class="card-body">
                    <h2 class="card-title text-success" id="recovered">Correlation</h2>
                </div>
            </div>
        </div>
    </div>

    @push('footer-scripts')
    <script src="{{URL::asset('theme/js/plugins/metisMenu/jquery.metisMenu.js')}}"></script>
    <script src="{{URL::asset('theme/js/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>
    <script src="{{URL::asset('theme/js/inspinia.js')}}"></script>
    <script src="{{URL::asset('theme/js/plugins/pace/pace.min.js')}}"></script>
    @endpush

@endsection
