<div class="row" id="table-stats">
    <div class="col-lg-12">
        <div class="ibox ">
            <div class="ibox-title">
                <h4 class="text-center">Table Statistic Data</h4>

                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-footer">
                @isset($historyData)
                <div class="table-responsive">
                    <table id="" class="table table-hover text-center dataTables-example">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Confirmed</th>
                            <th>Death</th>
                            <th>Recovered</th>
                            <th>Active</th>
                            <th>Date</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $i = 0; @endphp
                        @foreach($historyData as $row)
                            @php $i++; @endphp
                            <tr>
                                <td>{{$i}}</td>
                                <td>{{$row['Confirmed']}}</td>
                                <td>{{$row['Deaths']}}</td>
                                <td>{{$row['Recovered']}}</td>
                                <td>{{$row['Active']}}</td>
                                @php
                                    $date = explode("T", $row['Date']);
                                    $date = date_create($date[0]);
                                @endphp
                                <td>{{date_format($date,"M d, Y")}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                @endisset

            </div>
        </div>
    </div>
</div>