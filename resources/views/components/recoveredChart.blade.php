<div class="row" id="chart2">
    <div class="col-lg-12">
        <div class="ibox ">
            <div class="ibox-title">
                <h3>Recovered data history</h3>
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
                <div>
                    {{-- <canvas id="recoveredChart" style="height:20%; width:80%"></canvas> --}}
                    <div id="morris-line-chart-recovered"></div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('footer-scripts')
<script>
@isset($historyData)
    $(function() {
        Morris.Line({
            element: 'morris-line-chart-recovered',
            data: [
                @foreach($historyData as $i => $datum)
                    { y: '{{$datum['date']}}', a: {{$datum['recovered']}} },
                @endforeach
            ],
            xkey: 'y',
            parseTime: false,
            ykeys: ['a'],
            xLabels: "string",
            labels: ['recovered'],
            hideHover: 'auto',
            resize: true,
            lineColors: ['#1654c7'],
        });
    });

    var historyData = {!! json_encode($historyData) !!}
    var data = {!! json_encode($data) !!}
    
    console.log(historyData);
@endisset
</script>
@endpush