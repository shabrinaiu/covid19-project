<div class="row" id="chart1">
    <div class="col-lg-12">
        <div class="ibox ">
            <div class="ibox-title">
                <h3>Correlation Chart </h3>
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
                    {{-- <canvas id="confirmedChart" style="height:200px; width:80%"></canvas> --}}
                    <div id="morris-line-chart-correlations"></div>
            </div>
        </div>
    </div>
</div>

@push('footer-scripts')
<script>
$(function() {
    Morris.Line({
        element: 'morris-line-chart-correlations',
        data: [
            @foreach($correlations as $i => $corr)
                @php $i++; @endphp
                { y: '{{$i}}', a: {{$corr}}},
            @endforeach
        ],
        xkey: 'y',
        parseTime: false,
        ykeys: ['a'],
        xLabels: "string",
        labels: ['Correlations'],
        hideHover: 'auto',
        resize: true,
        lineColors: ['#ffdd33'],
    });
});

</script>
@endpush