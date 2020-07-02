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
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h4 class="text-center">Covid-19 Statistics data of a country</h4>

                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-footer">
                    <div class="row">
                            <div class="col-md-4">
                                <select class="select2_demo_3 form-control country">
                                    <option disabled selected>-- choose country --</option>
                                    @foreach ($data as $row)
                                        <option value="{{$row['Slug']}}">{{$row['Country']}}</option>
                                    @endforeach
                                    
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-primary" id="submitButton">Submit</button>
                            </div>
                    </div>
                </div>
                <div class="ibox-content">
                    <p id="tulis">nanti tampilkan chartnya disini (usahakan mirip di kawalcorona.com)</p>
                </div>
            </div>
        </div>
    </div>

    @push('footer-scripts')
        {{-- select2 --}}
        <script src="{{URL::asset('theme/js/plugins/select2/select2.full.min.js')}}"></script>

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
            
        </script>
    @endpush

@endsection