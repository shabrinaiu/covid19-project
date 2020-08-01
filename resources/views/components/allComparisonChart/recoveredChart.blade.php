

@push('footer-scripts')
<script>
$(function() {
    Morris.Line({
        element: 'morris-line-chart-recovered-{{$idx}}',
        data: [
            @foreach($getMainHistoryData as $i => $mainData)
                { y: '{{$mainData['Label']}}', a: {{$mainData['Recovered']}}, b: {{$getComparedHistoryData[$i]['Recovered']}} },
            @endforeach
        ],
        xkey: 'y',
        parseTime: false,
        ykeys: ['a', 'b'],
        xLabels: "string",
        labels: ['{{$getMainHistoryData[0]['Country']}}', '{{$getComparedHistoryData[0]['Country']}}'],
        hideHover: 'auto',
        resize: true,
        lineColors: ['#07e6c4','#04c2c2'],
    });
});
    
</script>
@endpush