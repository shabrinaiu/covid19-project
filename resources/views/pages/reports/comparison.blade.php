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
            <a href="/reports/countries">Comparison</a>
        </li>
    @endcomponent
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-md-8 vertical-align-middle">
            <h3>Covid-19 Statistics data of {{(isset($currentData['Country_Region']) ? $currentData['Country_Region'] : 'a country')}}</h3>
        </div>
        <div class="col-md-3">
            <select class="select2_demo_2 form-control country" multiple="multiple">
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
    @push('footer-scripts')
    <!-- ChartJS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>        

    <script>
        
        $(document).ready(function () {

            $(".select2_demo_2").select2({
                theme: 'bootstrap4',
                placeholder: "Select a country",
            });

            $("#submitButton").click(function(){
                var selectedName = $("select.country").children("option:selected").html();
                var selectedSlug = $("select.country").children("option:selected").val();
                $('#countryTitle').html(selectedName + ' all data');
                var url = '/reports/countries/' + selectedSlug;
                document.location.href=url;
            });                

        });

    </script>
    @endpush
@endsection