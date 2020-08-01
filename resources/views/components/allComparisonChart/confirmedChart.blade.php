

@push('footer-scripts')
<script>
$(function() {
    Morris.Line({
        element: 'morris-line-chart-confirmed-{{$idx}}',
        data: [
            @foreach($getMainHistoryData as $i => $mainData)
                { y: '{{$mainData['Label']}}', a: {{$mainData['Confirmed']}}, b: {{$getComparedHistoryData[$i]['Confirmed']}} },
            @endforeach
        ],
        xkey: 'y',
        parseTime: false,
        ykeys: ['a', 'b'],
        xLabels: "string",
        labels: ['{{$getMainHistoryData[0]['Country']}}', '{{$getComparedHistoryData[0]['Country']}}'],
        hideHover: 'auto',
        resize: true,
        lineColors: ['#ffdd33','#eda405'],
    });
});

</script>
@endpush