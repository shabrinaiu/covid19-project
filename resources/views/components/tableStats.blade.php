<div class="row" id="table-stats">
    <div class="col-lg-12">
        <div class="ibox ">
            <div class="ibox-title">
                <h4 class="text-center" id="TableTitle">Table Statistic Data</h4>

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
                            <th>Date</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $i = 0; @endphp
                        @foreach($historyData as $row)
                            @php $i++; @endphp
                            <tr>
                                <td>{{$i}}</td>
                                <td>{{$row['confirmed']}}</td>
                                <td>{{$row['deaths']}}</td>
                                <td>{{$row['recovered']}}</td>
                                @php
                                    $date = date_create($row['date']);
                                @endphp
                                <td>{{$row['date']}}</td>
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