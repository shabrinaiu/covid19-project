

@push('footer-scripts')
<script>
$(function() {
    Morris.Line({
        element: 'morris-line-chart-deaths-{{$idx}}',
        data: [
            @foreach($getMainHistoryData as $i => $mainData)
                { y: '{{$mainData['Label']}}', a: {{$mainData['Deaths']}}, b: {{$getComparedHistoryData[$i]['Deaths']}} },
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