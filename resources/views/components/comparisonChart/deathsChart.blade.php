<div class="row" id="chart1">
    <div class="col-lg-12">
        <div class="ibox ">
            <div class="ibox-title">
                <h3>Perbandingan Kasus Konfirmasi Meninggal COVID-19 Pada 2 Negara</h3>
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
                <div id="morris-line-chart-deaths"></div>
            </div>
        </div>
    </div>
</div>

@push('footer-scripts')
<script>
$(function() {
    Morris.Line({
        element: 'morris-line-chart-deaths',
        data: [
            @foreach($getMainHistoryData as $i => $mainData)
                { y: 'day {{$mainData['Index']}}', a: {{$mainData['Deaths']}}, b: {{$getComparedHistoryData[$i]['Deaths']}} },
            @endforeach
        ],
        xkey: 'y',
        parseTime: false,
        ykeys: ['a', 'b'],
        xLabels: "string",
        labels: ['{{$getMainHistoryData[0]['Country']}}', '{{$getComparedHistoryData[0]['Country']}}'],
        hideHover: 'auto',
        resize: true,
        lineColors: ['#ab050b','#ff3333'],
    });
});
    
</script>
@endpush