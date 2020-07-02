@extends('layouts.master')

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
                    <h4 class="text-center">Covid-19 Latest Data All Countries</h4>

                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-footer">

                    @isset($modals)
                        {{$modals}}
                    @endisset

                    <div class="table-responsive">
                        <table id="" class="table table-hover text-center dataTables-example">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Country Name</th>
                                <th>Country Code</th>
                                <th>New Confirmed</th>
                                <th>Total Confirmed</th>
                                <th>New Deaths</th>
                                <th>Total Deaths</th>
                                <th>New Recovered</th>
                                <th>Total Recovered</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php $i = 0; @endphp
                            @foreach($data as $datum)
                                @php $i++; @endphp
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>{{$datum['Country']}}</td>
                                    <td>{{$datum['CountryCode']}}</td>
                                    <td>{{$datum['NewConfirmed']}}</td>
                                    <td>{{$datum['TotalConfirmed']}}</td>
                                    <td>{{$datum['NewDeaths']}}</td>
                                    <td>{{$datum['TotalDeaths']}}</td>
                                    <td>{{$datum['NewRecovered']}}</td>
                                    <td>{{$datum['TotalRecovered']}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection