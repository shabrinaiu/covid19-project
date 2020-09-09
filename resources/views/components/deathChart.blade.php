<div class="row" id="chart3">
    <div class="col-lg-12">
        <div class="ibox ">
            <div class="ibox-title">
                <h3>Deaths data history</h3>
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
                    {{-- <canvas id="deathsChart" style="height:20%; width:80%"></canvas> --}}
                    <div id="morris-line-chart-deaths"></div>
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
            element: 'morris-line-chart-deaths',
            data: [
                @foreach($historyData as $i => $datum)
                    { y: '{{$datum['date']}}', a: {{$datum['deaths']}} },
                @endforeach
            ],
            xkey: 'y',
            parseTime: false,
            ykeys: ['a'],
            xLabels: "string",
            labels: ['deaths'],
            hideHover: 'auto',
            resize: true,
            lineColors: ['#ed0505'],
        });
    });
    @endisset
</script>
@endpush