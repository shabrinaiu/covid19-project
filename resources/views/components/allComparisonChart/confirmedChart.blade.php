

@push('footer-scripts')
<script>
$(function() {
    Morris.Line({
        element: 'morris-line-chart-confirmed-{{$idx}}',
        data: [
            @foreach($getMainHistoryData as $i => $mainData)
            { y: '{{$mainData['Label']}}', a: {{$mainData['confirmed']}}, b: {{$getComparedHistoryData[$i]['confirmed']}} },
            @endforeach
        ],
        xkey: 'y',
        parseTime: false,
        ykeys: ['a', 'b'],
        xLabels: "string",
        labels: ['{{$mainCountryName}}', '{{$comparedCountryName}}'],
        hideHover: 'auto',
        resize: true,
        lineColors: ['#ffdd33','#eda405'],
    });
});

</script>
@endpush